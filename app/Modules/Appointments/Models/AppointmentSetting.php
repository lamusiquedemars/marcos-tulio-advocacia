<?php

namespace App\Modules\Appointments\Models;

use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Enums\AppointmentInvitationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AppointmentSetting extends Model
{
    protected $fillable = [
        'is_enabled',
        'provider',
        'mode',
        'booking_url',
        'online_booking_url',
        'in_person_booking_url',
        'timezone',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'provider' => AppointmentProvider::class,
            'mode' => AppointmentMode::class,
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $setting): void {
            if ($setting->is_enabled && blank($setting->booking_url)
                && blank($setting->online_booking_url) && blank($setting->in_person_booking_url)) {
                throw ValidationException::withMessages([
                    'booking_url' => 'Informe o link da página de agendamento.',
                ]);
            }

        });
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'is_enabled' => false,
            'provider' => AppointmentProvider::Brevo,
            'mode' => AppointmentMode::AfterReview,
            'booking_url' => null,
            'timezone' => 'America/Cuiaba',
        ]);
    }

    public function canBookDirectly(): bool
    {
        return $this->is_enabled
            && $this->mode === AppointmentMode::Direct
            && filled($this->booking_url);
    }

    public function bookingUrlFor(AppointmentInvitationType $type): ?string
    {
        return match ($type) {
            AppointmentInvitationType::Online => $this->online_booking_url ?: $this->booking_url,
            AppointmentInvitationType::InPerson => $this->in_person_booking_url ?: $this->booking_url,
        };
    }
}
