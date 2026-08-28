<?php

namespace App\Modules\Acquisition\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AcquisitionSetting extends Model
{
    protected $fillable = [
        'is_enabled',
        'gtm_container_id',
        'consent_enabled',
        'consent_mode',
        'privacy_policy_url',
        'timezone',
        'currency',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'consent_enabled' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $setting): void {
            $setting->gtm_container_id = filled($setting->gtm_container_id)
                ? strtoupper(trim((string) $setting->gtm_container_id))
                : null;
            $setting->currency = strtoupper(trim((string) $setting->currency));

            if ($setting->is_enabled && ! preg_match('/^GTM-[A-Z0-9]+$/', (string) $setting->gtm_container_id)) {
                throw ValidationException::withMessages([
                    'gtm_container_id' => 'Informe um identificador Google Tag Manager válido, por exemplo GTM-ABC1234.',
                ]);
            }

            if (! in_array($setting->consent_mode, ['basic', 'advanced'], true)) {
                throw ValidationException::withMessages([
                    'consent_mode' => 'Escolha um modo de consentimento reconhecido.',
                ]);
            }

            if (! preg_match('/^[A-Z]{3}$/', $setting->currency)) {
                throw ValidationException::withMessages([
                    'currency' => 'Use um código de moeda ISO com três letras, por exemplo BRL.',
                ]);
            }
        });
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'is_enabled' => false,
            'gtm_container_id' => null,
            'consent_enabled' => true,
            'consent_mode' => 'basic',
            'privacy_policy_url' => null,
            'timezone' => 'America/Cuiaba',
            'currency' => 'BRL',
        ]);
    }

    public function hasValidContainer(): bool
    {
        return preg_match('/^GTM-[A-Z0-9]+$/', (string) $this->gtm_container_id) === 1;
    }

    public function canTrack(): bool
    {
        return $this->is_enabled && $this->hasValidContainer();
    }

    public function loadsContainerBeforeConsent(): bool
    {
        return $this->canTrack()
            && (! $this->consent_enabled || $this->consent_mode === 'advanced');
    }
}
