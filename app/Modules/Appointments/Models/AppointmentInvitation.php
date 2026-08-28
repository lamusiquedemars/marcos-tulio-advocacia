<?php

namespace App\Modules\Appointments\Models;

use App\Modules\Appointments\Enums\AppointmentInvitationType;
use App\Modules\Inquiries\Models\Inquiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AppointmentInvitation extends Model
{
    protected $fillable = [
        'inquiry_id',
        'type',
        'booking_url',
        'token_hash',
        'expires_at',
        'sent_at',
        'opened_at',
    ];

    protected $hidden = ['token_hash'];

    protected function casts(): array
    {
        return [
            'type' => AppointmentInvitationType::class,
            'expires_at' => 'datetime',
            'sent_at' => 'datetime',
            'opened_at' => 'datetime',
        ];
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    /** @return array{0: self, 1: string} */
    public static function issue(Inquiry $inquiry, AppointmentInvitationType $type, string $bookingUrl): array
    {
        $token = Str::random(64);

        $invitation = static::query()->create([
            'inquiry_id' => $inquiry->getKey(),
            'type' => $type,
            'booking_url' => $bookingUrl,
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->addDays(7),
            'sent_at' => now(),
        ]);

        return [$invitation, $token];
    }

    public function isUsable(): bool
    {
        return $this->expires_at?->isFuture() ?? false;
    }
}
