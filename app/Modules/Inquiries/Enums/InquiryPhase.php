<?php

namespace App\Modules\Inquiries\Enums;

enum InquiryPhase: string
{
    case NotInformed = 'nao_informada';
    case Investigation = 'investigacao';
    case Summons = 'intimacao_depoimento';
    case Arrest = 'prisao';
    case CriminalProceeding = 'processo_penal';
    case Appeal = 'recurso';
    case Preventive = 'preventiva';

    public function label(): string
    {
        return match ($this) {
            self::NotInformed => 'Prefiro não informar',
            self::Investigation => 'Investigação',
            self::Summons => 'Intimação ou depoimento',
            self::Arrest => 'Prisão',
            self::CriminalProceeding => 'Processo penal',
            self::Appeal => 'Recurso ou habeas corpus',
            self::Preventive => 'Orientação preventiva',
        };
    }
}
