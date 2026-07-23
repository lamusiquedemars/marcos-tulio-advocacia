<?php

namespace Tests\Feature;

use App\Modules\Inquiries\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AssistantInquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_assistant_is_available_on_public_pages_with_legal_guardrails(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Assistente de demonstração')
            ->assertSee('não fornece aconselhamento jurídico')
            ->assertSee('Em uma urgência, fale diretamente pelo WhatsApp.');
    }

    public function test_fake_assistant_stores_a_structured_inquiry_without_sending_email(): void
    {
        Mail::fake();

        $this->postJson('/assistant/solicitacao', $this->validPayload())
            ->assertCreated()
            ->assertJsonPath('message', 'Solicitação fictícia registrada. Nenhuma mensagem externa foi enviada.');

        $this->assertDatabaseHas(Inquiry::class, [
            'email' => 'pessoa-ficticia@example.test',
            'request_type' => 'analise',
            'urgency' => 'prazo_proximo',
            'phase' => 'investigacao',
            'modality' => 'remoto',
            'message' => 'Resumo fictício e mínimo para testar o assistente.',
            'source' => 'assistant_fake',
            'status' => 'nova',
        ]);
        $this->assertNotNull(Inquiry::query()->value('consent_at'));
        Mail::assertNothingSent();
    }

    public function test_assistant_requires_explicit_consent(): void
    {
        $payload = $this->validPayload();
        unset($payload['consent']);

        $this->postJson('/assistant/solicitacao', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors('consent');

        $this->assertDatabaseCount(Inquiry::class, 0);
    }

    public function test_assistant_rejects_an_excessively_detailed_summary(): void
    {
        $this->postJson('/assistant/solicitacao', [
            ...$this->validPayload(),
            'summary' => str_repeat('a', 1501),
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('summary');

        $this->assertDatabaseCount(Inquiry::class, 0);
    }

    public function test_assistant_endpoint_is_unavailable_when_module_is_disabled(): void
    {
        config(['maracuja.modules.assistant' => false]);

        $this->postJson('/assistant/solicitacao', $this->validPayload())
            ->assertNotFound();
    }

    private function validPayload(): array
    {
        return [
            'request_type' => 'analise',
            'urgency' => 'prazo_proximo',
            'phase' => 'investigacao',
            'modality' => 'remoto',
            'name' => 'Pessoa Fictícia',
            'email' => 'pessoa-ficticia@example.test',
            'phone' => '+55 (65) 00000-0000',
            'location' => 'Cuiabá, MT',
            'summary' => 'Resumo fictício e mínimo para testar o assistente.',
            'consent' => '1',
        ];
    }
}
