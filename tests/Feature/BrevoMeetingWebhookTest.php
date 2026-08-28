<?php

namespace Tests\Feature;

use App\Modules\Appointments\Enums\AppointmentInvitationType;
use App\Modules\Appointments\Enums\AppointmentStatus;
use App\Modules\Appointments\Models\AppointmentInvitation;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrevoMeetingWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_booked_and_cancelled_events_update_the_matching_inquiry(): void
    {
        $setting = AppointmentSetting::current();
        $setting->update(['brevo_meeting_webhook_secret' => 'meeting-webhook-test-secret']);

        $inquiry = Inquiry::query()->create([
            'name' => 'Pessoa interessada',
            'email' => 'pessoa@example.test',
            'message' => 'Resumo inicial.',
            'status' => InquiryStatus::WaitingCustomer,
        ]);
        AppointmentInvitation::issue(
            $inquiry,
            AppointmentInvitationType::Online,
            'https://meet.brevo.com/marcos/borderless?l=consulta-online',
        );

        $this->postJson(route('webhooks.brevo.meetings', [
            'secret' => 'meeting-webhook-test-secret',
            'event' => 'booked',
        ]), $this->payload())
            ->assertOk()
            ->assertJson(['ok' => true]);

        $inquiry->refresh();
        $this->assertSame(AppointmentStatus::Booked, $inquiry->appointment_status);
        $this->assertSame(InquiryStatus::Handled, $inquiry->status);
        $this->assertNotNull($inquiry->scheduled_start_at);
        $this->assertNotNull($inquiry->appointment_external_reference);

        $this->postJson(route('webhooks.brevo.meetings', [
            'secret' => 'meeting-webhook-test-secret',
            'event' => 'cancelled',
        ]), $this->payload())
            ->assertOk();

        $inquiry->refresh();
        $this->assertSame(AppointmentStatus::Cancelled, $inquiry->appointment_status);
        $this->assertSame(InquiryStatus::ToHandle, $inquiry->status);
    }

    public function test_meeting_webhook_requires_its_private_secret(): void
    {
        AppointmentSetting::current()->update(['brevo_meeting_webhook_secret' => 'known-secret']);

        $this->postJson(route('webhooks.brevo.meetings', [
            'secret' => 'wrong-secret',
            'event' => 'booked',
        ]), $this->payload())->assertNotFound();
    }

    /** @return array<string, mixed> */
    private function payload(): array
    {
        return [
            'account_email' => 'contato@marcostulioadvocacia.com.br',
            'event_participants' => [
                ['EMAIL' => 'pessoa@example.test'],
            ],
            'meeting_name' => 'Consulta inicial online',
            'meeting_start_timestamp' => '2026-09-01T14:00:00-04:00',
            'meeting_end_timestamp' => '2026-09-01T14:20:00-04:00',
        ];
    }
}
