<?php

namespace App\Modules\Appointments\Support;

use App\Modules\Appointments\Enums\AppointmentInvitationType;
use App\Modules\Inquiries\Models\Inquiry;

class AppointmentInvitationDeliveryLink
{
    public static function mailto(Inquiry $inquiry, AppointmentInvitationType $type, string $invitationUrl): string
    {
        return 'mailto:'.$inquiry->email
            .'?subject='.rawurlencode('Agendamento de consulta — Marcos Túlio Advocacia')
            .'&body='.rawurlencode(self::message($inquiry, $type, $invitationUrl));
    }

    public static function whatsapp(Inquiry $inquiry, AppointmentInvitationType $type, string $invitationUrl): ?string
    {
        $phone = preg_replace('/\D+/', '', (string) $inquiry->phone);

        if (blank($phone)) {
            return null;
        }

        return 'https://wa.me/'.$phone.'?text='.rawurlencode(self::message($inquiry, $type, $invitationUrl));
    }

    private static function message(Inquiry $inquiry, AppointmentInvitationType $type, string $invitationUrl): string
    {
        return implode("\n", [
            'Olá '.trim((string) $inquiry->name).',',
            '',
            'Após a análise inicial da sua solicitação, você pode escolher um horário para a sua '.$type->label().':',
            $invitationUrl,
            '',
            'O agendamento permanece sujeito à confirmação do escritório.',
            '',
            'Atenciosamente,',
            'Marcos Túlio Advocacia',
        ]);
    }
}
