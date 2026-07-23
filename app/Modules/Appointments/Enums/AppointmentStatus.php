<?php

namespace App\Modules\Appointments\Enums;

enum AppointmentStatus: string
{
    case NotRequested = 'not_requested';
    case Requested = 'requested';
    case BookingOpened = 'booking_opened';
    case Booked = 'booked';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::NotRequested => 'Não solicitado',
            self::Requested => 'Solicitado',
            self::BookingOpened => 'Página de reserva aberta',
            self::Booked => 'Agendado',
            self::Cancelled => 'Cancelado',
        };
    }
}
