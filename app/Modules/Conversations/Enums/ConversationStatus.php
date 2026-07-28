<?php

namespace App\Modules\Conversations\Enums;

enum ConversationStatus: string
{
    case New = 'new';
    case AiActive = 'ai_active';
    case WaitingForVisitor = 'waiting_for_visitor';
    case NeedsHuman = 'needs_human';
    case HumanActive = 'human_active';
    case Closed = 'closed';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Nova',
            self::AiActive => 'IA ativa',
            self::WaitingForVisitor => 'Aguardando visitante',
            self::NeedsHuman => 'A tratar',
            self::HumanActive => 'Atendimento humano',
            self::Closed => 'Encerrada',
            self::Archived => 'Arquivada',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::New, self::NeedsHuman => 'danger',
            self::AiActive => 'info',
            self::WaitingForVisitor => 'warning',
            self::HumanActive => 'success',
            self::Closed, self::Archived => 'gray',
        };
    }
}
