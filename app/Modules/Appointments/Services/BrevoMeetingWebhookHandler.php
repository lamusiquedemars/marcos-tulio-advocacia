<?php

namespace App\Modules\Appointments\Services;

use App\Modules\Appointments\Enums\AppointmentStatus;
use App\Modules\Appointments\Models\AppointmentInvitation;
use App\Modules\Inquiries\Enums\InquiryStatus;
use Carbon\CarbonImmutable;

class BrevoMeetingWebhookHandler
{
    /** @param array<string, mixed> $payload */
    public function handle(string $event, array $payload): bool
    {
        $reference = $this->reference($payload);

        if ($event === 'cancelled') {
            $inquiry = AppointmentInvitation::query()
                ->whereHas('inquiry', fn ($query) => $query->where('appointment_external_reference', $reference))
                ->with('inquiry')
                ->latest('sent_at')
                ->first()
                ?->inquiry;

            if ($inquiry === null) {
                return false;
            }

            $inquiry->update(['appointment_status' => AppointmentStatus::Cancelled]);
            $inquiry->moveTo(InquiryStatus::ToHandle);

            return true;
        }

        $participantEmail = collect($payload['event_participants'])
            ->pluck('EMAIL')
            ->filter()
            ->map(fn (string $email): string => mb_strtolower(trim($email)))
            ->first();

        if ($participantEmail === null) {
            return false;
        }

        $matches = AppointmentInvitation::query()
            ->with('inquiry')
            ->get()
            ->filter(fn (AppointmentInvitation $invitation): bool => mb_strtolower((string) $invitation->inquiry?->email) === $participantEmail)
            ->filter(fn (AppointmentInvitation $invitation): bool => $invitation->inquiry?->appointment_external_reference === null)
            ->values();

        if ($matches->count() !== 1) {
            return false;
        }

        $inquiry = $matches->first()->inquiry;
        $inquiry->update([
            'appointment_status' => AppointmentStatus::Booked,
            'scheduled_start_at' => CarbonImmutable::parse($payload['meeting_start_timestamp'])->utc(),
            'scheduled_end_at' => CarbonImmutable::parse($payload['meeting_end_timestamp'])->utc(),
            'appointment_external_reference' => $reference,
        ]);
        $inquiry->moveTo(InquiryStatus::Handled);

        return true;
    }

    /** @param array<string, mixed> $payload */
    private function reference(array $payload): string
    {
        return hash('sha256', json_encode([
            'account_email' => mb_strtolower(trim((string) $payload['account_email'])),
            'participants' => collect($payload['event_participants'])->pluck('EMAIL')->map(fn (string $email): string => mb_strtolower(trim($email)))->sort()->values()->all(),
            'name' => trim((string) $payload['meeting_name']),
            'starts_at' => CarbonImmutable::parse($payload['meeting_start_timestamp'])->utc()->toIso8601String(),
            'ends_at' => CarbonImmutable::parse($payload['meeting_end_timestamp'])->utc()->toIso8601String(),
        ], JSON_THROW_ON_ERROR));
    }
}
