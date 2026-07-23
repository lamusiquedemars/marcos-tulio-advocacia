<?php

namespace App\Modules\Inquiries\Enums;

enum InquiryRequestType: string
{
    case Analysis = 'analise';
    case Consultation = 'consulta';
    case Other = 'outro';

    public function label(): string
    {
        return match ($this) {
            self::Analysis => 'Análise da situação',
            self::Consultation => 'Solicitação de consulta',
            self::Other => 'Outro contato',
        };
    }
}
