<?php

namespace App\Modules\Inquiries\Models;

use App\Modules\Appointments\Enums\AppointmentStatus;
use App\Modules\Inquiries\Enums\InquiryModality;
use App\Modules\Inquiries\Enums\InquiryPhase;
use App\Modules\Inquiries\Enums\InquiryRequestType;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Enums\InquiryUrgency;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'request_type',
        'urgency',
        'phase',
        'deadline',
        'location',
        'modality',
        'message',
        'consent_at',
        'source',
        'status',
        'appointment_status',
        'booking_opened_at',
        'scheduled_start_at',
        'scheduled_end_at',
        'appointment_timezone',
        'appointment_external_reference',
        'internal_notes',
        'read_at',
        'handled_at',
        'archived_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => InquiryStatus::class,
            'appointment_status' => AppointmentStatus::class,
            'booking_opened_at' => 'datetime',
            'scheduled_start_at' => 'datetime',
            'scheduled_end_at' => 'datetime',
            'request_type' => InquiryRequestType::class,
            'urgency' => InquiryUrgency::class,
            'phase' => InquiryPhase::class,
            'deadline' => 'date',
            'modality' => InquiryModality::class,
            'consent_at' => 'datetime',
            'read_at' => 'datetime',
            'handled_at' => 'datetime',
            'archived_at' => 'datetime',
        ];
    }

    public function markRead(): void
    {
        if ($this->read_at === null) {
            $this->forceFill([
                'read_at' => now(),
            ])->save();
        }
    }

    public function moveTo(InquiryStatus $status): void
    {
        $updates = [
            'status' => $status,
        ];

        if ($this->read_at === null) {
            $updates['read_at'] = now();
        }

        if ($status === InquiryStatus::Handled) {
            $updates['handled_at'] = now();
        }

        if ($status === InquiryStatus::Archived) {
            $updates['archived_at'] = now();
        }

        $this->update($updates);
    }

    public function markWaitingCustomer(): void
    {
        $this->moveTo(InquiryStatus::WaitingCustomer);
    }
}
