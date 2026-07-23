<?php

namespace App\Modules\Inquiries\Enums;

enum InquiryUrgency: string
{
    case None = 'sem_urgencia';
    case UpcomingDeadline = 'prazo_proximo';
    case Urgent = 'urgente';

    public function label(): string
    {
        return match ($this) {
            self::None => 'Sem urgência imediata',
            self::UpcomingDeadline => 'Prazo próximo',
            self::Urgent => 'Urgente',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::None => 'gray',
            self::UpcomingDeadline => 'warning',
            self::Urgent => 'danger',
        };
    }
}
