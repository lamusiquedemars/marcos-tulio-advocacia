<?php

namespace App\Modules\Appointments\Enums;

enum AppointmentProvider: string
{
    case Fake = 'fake';
    case Brevo = 'brevo';

    public function label(): string
    {
        return match ($this) {
            self::Fake => 'Demonstração fictícia',
            self::Brevo => 'Brevo Meetings',
        };
    }
}
