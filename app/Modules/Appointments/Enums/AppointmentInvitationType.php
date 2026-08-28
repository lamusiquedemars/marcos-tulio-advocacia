<?php

namespace App\Modules\Appointments\Enums;

enum AppointmentInvitationType: string
{
    case Online = 'online';
    case InPerson = 'in_person';

    public function label(): string
    {
        return match ($this) {
            self::Online => 'Consulta online',
            self::InPerson => 'Consulta presencial',
        };
    }
}
