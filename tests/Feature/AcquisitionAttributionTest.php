<?php

namespace Tests\Feature;

use App\Modules\Acquisition\Filament\Widgets\AcquisitionCampaignPerformance;
use App\Modules\Acquisition\Filament\Widgets\AcquisitionOverview;
use App\Modules\Acquisition\Jobs\SendAcquisitionDelivery;
use App\Modules\Acquisition\Models\AcquisitionDelivery;
use App\Modules\Acquisition\Models\AcquisitionReportingSnapshot;
use App\Modules\Acquisition\Models\AcquisitionSetting;
use App\Modules\Acquisition\Services\CremonaClient;
use App\Modules\Inquiries\Models\Inquiry;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AcquisitionAttributionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Mail::fake();
        SiteSetting::current()->update(['contact_email' => null]);
    }

    public function test_marcos_has_an_installed_acquisition_module_with_brazilian_defaults(): void
    {
        $settings = AcquisitionSetting::current();

        $this->assertTrue(Modules::installed('acquisition'));
        $this->assertTrue(Modules::enabled('acquisition'));
        $this->assertFalse($settings->is_enabled);
        $this->assertSame('America/Cuiaba', $settings->timezone);
        $this->assertSame('BRL', $settings->currency);
    }

    public function test_tracking_consent_is_presented_in_portuguese_only_when_tracking_is_enabled(): void
    {
        AcquisitionSetting::current()->update([
            'is_enabled' => true,
            'gtm_container_id' => 'GTM-TEST123',
            'consent_enabled' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Cookies de medição')
            ->assertSee('Aceitar')
            ->assertSee('Recusar')
            ->assertSee('maracujaSetConsent', false)
            ->assertSee("'gtm.start': new Date().getTime()", false)
            ->assertSee("event: 'gtm.js'", false)
            ->assertSee('marketing: false', false);
    }

    public function test_successful_contact_queues_an_anonymous_google_lead_event_for_the_next_page(): void
    {
        AcquisitionSetting::current()->update([
            'is_enabled' => true,
            'gtm_container_id' => 'GTM-TEST123',
            'consent_enabled' => true,
        ]);

        $this->post('/contact', [
            'name' => 'Contato de teste',
            'email' => 'contato@example.test',
            'request_type' => 'consulta',
            'modality' => 'remoto',
            'message' => 'Solicitação de teste sem dados reais.',
            'consent' => '1',
        ])->assertRedirect('/contact');

        $this->get('/contact')
            ->assertOk()
            ->assertSee("event: 'generate_lead'", false)
            ->assertSee("parameters: { form: 'contact' }", false)
            ->assertDontSee('contato@example.test');
    }

    public function test_contact_form_keeps_safe_first_and_last_touch_attribution(): void
    {
        $attribution = [
            'first_touch' => [
                'utm_source' => 'google',
                'utm_medium' => 'cpc',
                'utm_campaign' => 'criminal-cuiaba',
                'gclid' => 'first-click',
                'landing_page' => '/atuacao-penal',
                'email' => 'must-not-be-copied@example.test',
            ],
            'last_touch' => [
                'gclid' => 'last-click',
                'landing_page' => '/contact?gclid=last-click',
                'referrer' => 'https://www.google.com/',
            ],
        ];

        $this->post('/contact', [
            'name' => 'Contato de teste',
            'email' => 'contato@example.test',
            'request_type' => 'analise',
            'message' => 'Resumo inicial sem dados reais.',
            'consent' => '1',
            'acquisition_attribution' => json_encode($attribution, JSON_THROW_ON_ERROR),
        ])->assertRedirect('/contact');

        $inquiry = Inquiry::query()->sole();

        $this->assertSame('google', $inquiry->attribution_source);
        $this->assertSame('cpc', $inquiry->attribution_medium);
        $this->assertSame('criminal-cuiaba', $inquiry->attribution_campaign);
        $this->assertSame('first-click', $inquiry->attribution_first_touch['gclid']);
        $this->assertSame('last-click', $inquiry->attribution_last_touch['gclid']);
        $this->assertArrayNotHasKey('email', $inquiry->attribution_first_touch);
        $this->assertSame('first_party', $inquiry->attribution_method);
        $this->assertSame('1.00', $inquiry->attribution_confidence);
    }

    public function test_contact_is_safely_queued_for_cremona_when_connector_is_configured(): void
    {
        Queue::fake();
        config()->set('maracuja.acquisition.cremona', [
            'enabled' => true,
            'endpoint' => 'https://cremona.example.test/api/v1/incoming-requests',
            'token' => 'key.secret',
            'site_reference' => 'marcos-tulio-advocacia',
        ]);

        $this->post('/contact', [
            'name' => 'Contato integrado',
            'email' => 'integrado@example.test',
            'request_type' => 'consulta',
            'modality' => 'presencial',
            'urgency' => 'prazo_proximo',
            'deadline' => '2026-09-01',
            'message' => 'Mensagem armazenada localmente antes do envio.',
            'consent' => '1',
        ])->assertRedirect('/contact');

        $delivery = AcquisitionDelivery::query()->sole();

        $this->assertSame('pending', $delivery->status);
        $this->assertSame('high', $delivery->payload['request']['urgency']);
        $this->assertSame('2026-09-01', $delivery->payload['request']['important_date']);
        $this->assertSame('marcos-tulio-advocacia', $delivery->payload['source']['site_reference']);
        $this->assertArrayNotHasKey('payload', $delivery->toArray());
        $this->assertStringNotContainsString(
            'Mensagem armazenada localmente',
            (string) DB::table('acquisition_deliveries')->value('payload'),
        );
        Queue::assertPushed(
            SendAcquisitionDelivery::class,
            fn (SendAcquisitionDelivery $job): bool => $job->deliveryId === $delivery->getKey(),
        );
    }

    public function test_delivery_job_uses_authentication_and_idempotency_then_marks_delivery_sent(): void
    {
        Queue::fake();
        Http::fake([
            'cremona.example.test/*' => Http::response([
                'data' => ['id' => 'request-123', 'status' => 'new'],
            ], 201),
        ]);
        config()->set('maracuja.acquisition.cremona', [
            'enabled' => true,
            'endpoint' => 'https://cremona.example.test/api/v1/incoming-requests',
            'token' => 'key.secret',
            'site_reference' => 'marcos-tulio-advocacia',
        ]);

        $this->post('/contact', [
            'name' => 'Contato enviado',
            'email' => 'enviado@example.test',
            'message' => 'Pedido de contato integrado.',
            'consent' => '1',
        ]);

        $delivery = AcquisitionDelivery::query()->sole();
        (new SendAcquisitionDelivery($delivery->getKey()))->handle(app(CremonaClient::class));

        $delivery->refresh();
        $this->assertSame('sent', $delivery->status);
        $this->assertSame(1, $delivery->attempts);
        $this->assertSame(201, $delivery->response_status);
        $this->assertNotNull($delivery->sent_at);

        Http::assertSent(fn ($request): bool => $request->url() === 'https://cremona.example.test/api/v1/incoming-requests'
            && $request->hasHeader('Authorization', 'Bearer key.secret')
            && $request->hasHeader('Idempotency-Key', $delivery->idempotency_key)
            && $request['contact']['email'] === 'enviado@example.test'
            && $request['consent']['status'] === 'granted');
    }

    public function test_local_acquisition_dashboard_summarizes_recent_leads_and_priorities(): void
    {
        $this->postContact('google@example.test', [
            'urgency' => 'urgente',
            'acquisition_attribution' => json_encode([
                'first_touch' => ['utm_source' => 'google', 'utm_medium' => 'cpc'],
            ], JSON_THROW_ON_ERROR),
        ]);
        $this->postContact('direct@example.test');
        $this->postContact('organic@example.test', [
            'acquisition_attribution' => json_encode([
                'first_touch' => ['utm_source' => 'linkedin', 'utm_medium' => 'organic'],
            ], JSON_THROW_ON_ERROR),
        ]);

        $method = new \ReflectionMethod(AcquisitionOverview::class, 'getStats');
        $stats = $method->invoke(new AcquisitionOverview);
        $values = collect($stats)->mapWithKeys(fn ($stat): array => [$stat->getLabel() => $stat->getValue()]);

        $this->assertSame(3, $values['Demandes reçues']);
        $this->assertSame(2, $values['Origine identifiée']);
        $this->assertSame(1, $values['Issues de Google']);
        $this->assertSame(1, $values['À répondre en priorité']);
    }

    public function test_campaign_summary_is_safely_synchronized_from_cremona_for_the_dashboard(): void
    {
        Http::fake([
            'cremona.example.test/*' => Http::response([
                'data' => [
                    'site_reference' => 'marcos-tulio-advocacia',
                    'period_days' => 30,
                    'currency' => 'BRL',
                    'spend' => 420.50,
                    'leads' => 7,
                    'converted_leads' => 2,
                    'campaigns' => [[
                        'name' => 'Defesa penal Cuiabá',
                        'tracking_key' => 'criminal-cuiaba',
                        'channel' => 'google_ads',
                        'status' => 'active',
                        'spend' => 420.50,
                        'leads' => 7,
                        'converted_leads' => 2,
                    ]],
                ],
            ]),
        ]);
        config()->set('maracuja.acquisition.cremona', [
            'enabled' => true,
            'endpoint' => 'https://cremona.example.test/api/v1/incoming-requests',
            'reporting_endpoint' => 'https://cremona.example.test/api/v1/acquisition/summary',
            'token' => 'key.secret',
            'site_reference' => 'marcos-tulio-advocacia',
        ]);

        $this->artisan('acquisition:sync-summary')->assertSuccessful();

        $snapshot = AcquisitionReportingSnapshot::query()->sole();
        $this->assertSame(420.50, $snapshot->payload['spend']);
        $this->assertSame(7, $snapshot->payload['leads']);
        Http::assertSent(fn ($request): bool => $request->hasHeader('Authorization', 'Bearer key.secret')
            && str_contains($request->url(), 'site_reference=marcos-tulio-advocacia'));

        $method = new \ReflectionMethod(AcquisitionOverview::class, 'getStats');
        $stats = $method->invoke(new AcquisitionOverview);
        $values = collect($stats)->mapWithKeys(fn ($stat): array => [$stat->getLabel() => $stat->getValue()]);
        $this->assertSame('R$ 420,50', $values['Dépense campagnes']);
        $this->assertSame(7, $values['Demandes liées aux campagnes']);

        $campaignMethod = new \ReflectionMethod(AcquisitionCampaignPerformance::class, 'getViewData');
        $campaignData = $campaignMethod->invoke(new AcquisitionCampaignPerformance);
        $this->assertSame('Defesa penal Cuiabá', $campaignData['campaigns'][0]['name']);
        $this->assertEqualsWithDelta(60.07, $campaignData['campaigns'][0]['cost_per_lead'], 0.01);
    }

    /** @param array<string, mixed> $overrides */
    private function postContact(string $email, array $overrides = []): void
    {
        $this->post('/contact', [
            'name' => 'Contato de painel',
            'email' => $email,
            'message' => 'Pedido registrado para o painel de aquisição.',
            'consent' => '1',
            ...$overrides,
        ])->assertRedirect('/contact');
    }
}
