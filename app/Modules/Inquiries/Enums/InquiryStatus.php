<?php

namespace App\Modules\Inquiries\Enums;

enum InquiryStatus: string
{
    case New = 'nova';
    case ToHandle = 'em_contato';
    case WaitingCustomer = 'consulta_solicitada';
    case Handled = 'agendada';
    case Archived = 'encerrada';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Nova',
            self::ToHandle => 'Em contato',
            self::WaitingCustomer => 'Consulta solicitada',
            self::Handled => 'Agendada',
            self::Archived => 'Encerrada',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::New => 'danger',
            self::ToHandle => 'warning',
            self::WaitingCustomer => 'info',
            self::Handled => 'success',
            self::Archived => 'gray',
        };
    }
}
