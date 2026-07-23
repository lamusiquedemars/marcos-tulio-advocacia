<?php

namespace App\Modules\Inquiries\Enums;

enum InquiryModality: string
{
    case InPerson = 'presencial';
    case Remote = 'remoto';
    case Undecided = 'indiferente';

    public function label(): string
    {
        return match ($this) {
            self::InPerson => 'Presencial',
            self::Remote => 'Remoto',
            self::Undecided => 'A definir',
        };
    }
}
