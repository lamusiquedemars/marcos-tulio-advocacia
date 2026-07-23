<?php

namespace App\Modules\Appointments\Models;

use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AppointmentSetting extends Model
{
    protected $fillable = [
        'is_enabled',
        'provider',
        'mode',
        'booking_url',
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
            if ($setting->is_enabled && blank($setting->booking_url)) {
                throw ValidationException::withMessages([
                    'booking_url' => 'Informe o link da página de agendamento.',
                ]);
            }

            if (config('maracuja.law_firm.demo') && $setting->provider === AppointmentProvider::Brevo) {
                throw ValidationException::withMessages([
                    'provider' => 'O provedor Brevo não pode ser ativado enquanto o site estiver em modo demonstração.',
                ]);
            }
        });
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'is_enabled' => true,
            'provider' => AppointmentProvider::Fake,
            'mode' => AppointmentMode::AfterReview,
            'booking_url' => 'https://example.test/agendamento-demo',
            'timezone' => 'America/Cuiaba',
        ]);
    }

    public function canBookDirectly(): bool
    {
        return $this->is_enabled
            && $this->mode === AppointmentMode::Direct
            && filled($this->booking_url);
    }
}
