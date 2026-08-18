<?php

namespace App\Support;

use App\Models\User;
use Filament\Facades\Filament;

final class PanelAccess
{
    public static function administerSite(): bool
    {
        return self::user()?->isFullAdministrator() === true;
    }

    public static function manageContent(): bool
    {
        return self::user()?->canManageContent() === true;
    }

    public static function manageClients(): bool
    {
        return self::user()?->canManageClients() === true;
    }

    private static function user(): ?User
    {
        $user = Filament::auth()->user();

        return $user instanceof User ? $user : null;
    }
}
