<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Models\AppointmentSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AppointmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_uses_a_fake_booking_page_after_review_by_default(): void
    {
        $setting = AppointmentSetting::current();

        $this->assertTrue($setting->is_enabled);
        $this->assertSame(AppointmentProvider::Fake, $setting->provider);
        $this->assertSame(AppointmentMode::AfterReview, $setting->mode);
        $this->assertSame('America/Cuiaba', $setting->timezone);

        $this->get('/contact')
            ->assertOk()
            ->assertSee('Agendamento após análise.')
            ->assertDontSee('Ver horários disponíveis');
    }

    public function test_direct_mode_displays_the_configured_booking_link_without_prefilled_case_data(): void
    {
        AppointmentSetting::current()->update([
            'mode' => AppointmentMode::Direct,
            'booking_url' => 'https://example.test/agendamento-demo',
        ]);

        $response = $this->get('/contact')
            ->assertOk()
            ->assertSee('Ver horários disponíveis')
            ->assertSee('http://marcos-tulio-advocacia.test/agendamento', false);

        $this->assertStringNotContainsString('summary=', $response->getContent());
        $this->assertStringNotContainsString('message=', $response->getContent());

        $this->get('/agendamento')
            ->assertOk()
            ->assertSee('Nenhum agendamento real será realizado.')
            ->assertSee('sem login Brevo e sem mudança de aba');
    }

    public function test_enabled_booking_requires_a_booking_page_url(): void
    {
        $this->expectException(ValidationException::class);

        AppointmentSetting::query()->create([
            'is_enabled' => true,
            'provider' => AppointmentProvider::Fake,
            'mode' => AppointmentMode::Direct,
            'booking_url' => null,
            'timezone' => 'America/Cuiaba',
        ]);
    }

    public function test_brevo_provider_cannot_be_enabled_in_demo_mode(): void
    {
        $this->expectException(ValidationException::class);

        AppointmentSetting::query()->create([
            'is_enabled' => true,
            'provider' => AppointmentProvider::Brevo,
            'mode' => AppointmentMode::Direct,
            'booking_url' => 'https://meet.brevo.com/demo',
            'timezone' => 'America/Cuiaba',
        ]);
    }

    public function test_admin_can_open_appointment_configuration(): void
    {
        AppointmentSetting::current();
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get('/admin/appointment-settings')
            ->assertOk()
            ->assertSee('Configuração De Agendamento')
            ->assertSee('Demonstração fictícia');
    }
}
