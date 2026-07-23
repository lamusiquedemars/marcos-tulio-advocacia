<?php

namespace App\Modules\Inquiries\Support;

use App\Modules\Inquiries\Models\Inquiry;

class InquiryReplyLink
{
    public static function make(Inquiry $inquiry): string
    {
        $subject = 'Retorno sobre sua solicitação';

        $bodyLines = [
            'Olá '.($inquiry->name ?: ''),
            '',
            'Recebemos sua solicitação de contato.',
            '',
            'Atenciosamente,',
        ];

        $body = implode("\n", $bodyLines);

        return 'mailto:'.$inquiry->email
            .'?subject='.rawurlencode($subject)
            .'&body='.rawurlencode($body);
    }
}
