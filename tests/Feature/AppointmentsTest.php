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

    public function test_booking_is_disabled_and_uses_brevo_after_review_by_default(): void
    {
        $setting = AppointmentSetting::current();

        $this->assertFalse($setting->is_enabled);
        $this->assertSame(AppointmentProvider::Brevo, $setting->provider);
        $this->assertSame(AppointmentMode::AfterReview, $setting->mode);
        $this->assertNull($setting->booking_url);
        $this->assertSame('America/Cuiaba', $setting->timezone);

        $this->get('/contact')
            ->assertOk()
            ->assertDontSee('Ver horários disponíveis');
    }

    public function test_direct_mode_displays_the_configured_booking_link_without_prefilled_case_data(): void
    {
        AppointmentSetting::current()->update([
            'is_enabled' => true,
            'provider' => AppointmentProvider::Fake,
            'mode' => AppointmentMode::Direct,
            'booking_url' => 'https://example.test/agendamento',
        ]);

        $response = $this->get('/contact')
            ->assertOk()
            ->assertSee('Ver horários')
            ->assertSee('http://marcos-tulio-advocacia.test/agendamento', false);

        $this->assertStringNotContainsString('summary=', $response->getContent());
        $this->assertStringNotContainsString('message=', $response->getContent());

        $this->get('/agendamento')
            ->assertOk()
            ->assertSee('O agendamento depende de confirmação.')
            ->assertSee('não confirma automaticamente a data ou o horário');
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

    public function test_brevo_provider_can_be_configured_with_a_booking_url(): void
    {
        $setting = AppointmentSetting::query()->create([
            'is_enabled' => true,
            'provider' => AppointmentProvider::Brevo,
            'mode' => AppointmentMode::Direct,
            'booking_url' => 'https://meet.brevo.com/marcos-tulio',
            'timezone' => 'America/Cuiaba',
        ]);

        $this->assertSame(AppointmentProvider::Brevo, $setting->provider);
    }

    public function test_admin_can_open_appointment_configuration(): void
    {
        AppointmentSetting::current();
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get('/admin/appointment-settings')
            ->assertOk()
            ->assertSee('Configuração De Agendamento')
            ->assertSee('Brevo Meetings');
    }
}
