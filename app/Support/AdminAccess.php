<?php

namespace App\Support;

use App\Models\User;
use Filament\Facades\Filament;

final class AdminAccess
{
    public static function allowed(): bool
    {
        $user = Filament::auth()->user();

        return $user instanceof User && $user->isFullAdministrator();
    }
}
