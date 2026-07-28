<?php

namespace App\Modules\Conversations\Enums;

enum ConversationUrgency: string
{
    case Unknown = 'unknown';
    case Normal = 'normal';
    case High = 'high';
    case Immediate = 'immediate';

    public function label(): string
    {
        return match ($this) {
            self::Unknown => 'A definir',
            self::Normal => 'Normal',
            self::High => 'Alta',
            self::Immediate => 'Imediata',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Unknown, self::Normal => 'gray',
            self::High => 'warning',
            self::Immediate => 'danger',
        };
    }
}
