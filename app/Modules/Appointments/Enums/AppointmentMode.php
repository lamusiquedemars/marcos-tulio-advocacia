<?php

namespace App\Modules\Appointments\Enums;

enum AppointmentMode: string
{
    case AfterReview = 'after_review';
    case Direct = 'direct';

    public function label(): string
    {
        return match ($this) {
            self::AfterReview => 'Após análise da solicitação',
            self::Direct => 'Reserva direta pelo visitante',
        };
    }
}
