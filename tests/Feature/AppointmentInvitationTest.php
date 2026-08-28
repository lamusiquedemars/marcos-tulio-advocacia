<?php

namespace Tests\Feature;

use App\Modules\Appointments\Enums\AppointmentInvitationType;
use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Models\AppointmentInvitation;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentInvitationTest extends TestCase
{
    use RefreshDatabase;

    public function test_private_invitation_displays_only_its_booking_page_and_marks_the_invitation_opened(): void
    {
        $inquiry = $this->inquiry();
        [$invitation, $token] = AppointmentInvitation::issue(
            $inquiry,
            AppointmentInvitationType::Online,
            'https://meet.brevo.com/marcos/borderless?l=consulta-online',
        );

        $response = $this->get(route('appointments.invitation.show', ['token' => $token]));

        $response
            ->assertOk()
            ->assertSee('https://meet.brevo.com/marcos/borderless?l=consulta-online', false)
            ->assertDontSee($inquiry->email)
            ->assertDontSee($inquiry->message);

        $this->assertNotNull($invitation->refresh()->opened_at);
        $this->assertSame(hash('sha256', $token), $invitation->token_hash);
    }

    public function test_expired_private_invitation_is_gone(): void
    {
        $token = 'expired-private-invitation-token';

        AppointmentInvitation::query()->create([
            'inquiry_id' => $this->inquiry()->getKey(),
            'type' => AppointmentInvitationType::InPerson,
            'booking_url' => 'https://meet.brevo.com/marcos/borderless?l=consulta-presencial',
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->subMinute(),
            'sent_at' => now()->subDays(8),
        ]);

        $this->get(route('appointments.invitation.show', ['token' => $token]))->assertGone();
    }

    public function test_specific_booking_links_override_the_legacy_fallback(): void
    {
        $setting = AppointmentSetting::current();
        $setting->update([
            'is_enabled' => true,
            'provider' => AppointmentProvider::Brevo,
            'mode' => AppointmentMode::AfterReview,
            'booking_url' => 'https://meet.brevo.com/marcos/borderless?l=fallback',
            'online_booking_url' => 'https://meet.brevo.com/marcos/borderless?l=online',
            'in_person_booking_url' => 'https://meet.brevo.com/marcos/borderless?l=presencial',
        ]);

        $this->assertSame(
            'https://meet.brevo.com/marcos/borderless?l=online',
            $setting->bookingUrlFor(AppointmentInvitationType::Online),
        );
        $this->assertSame(
            'https://meet.brevo.com/marcos/borderless?l=presencial',
            $setting->bookingUrlFor(AppointmentInvitationType::InPerson),
        );
    }

    private function inquiry(): Inquiry
    {
        return Inquiry::query()->create([
            'name' => 'Pessoa interessada',
            'email' => 'pessoa@example.test',
            'phone' => '+55 65 99999-9999',
            'message' => 'Resumo que não deve aparecer na página de reserva.',
            'status' => InquiryStatus::New,
        ]);
    }
}
