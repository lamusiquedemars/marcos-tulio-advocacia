<?php

namespace App\Modules\OralDefenses\Enums;

enum OralDefenseType: string
{
    case Video = 'video';
    case Defense = 'defense';

    public function label(): string
    {
        return match ($this) {
            self::Video => 'Sustentação em vídeo',
            self::Defense => 'Exemplo de defesa',
        };
    }
}
