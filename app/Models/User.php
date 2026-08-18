<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'is_admin', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    public const ROLE_CONTENT_EDITOR = 'content_editor';

    public const ROLE_CLIENT_MANAGER = 'client_manager';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isFullAdministrator()
            || $this->isContentEditor()
            || $this->isClientManager();
    }

    public function isFullAdministrator(): bool
    {
        return $this->is_admin === true;
    }

    public function isContentEditor(): bool
    {
        return $this->role === self::ROLE_CONTENT_EDITOR;
    }

    public function isClientManager(): bool
    {
        return $this->role === self::ROLE_CLIENT_MANAGER;
    }

    public function canManageContent(): bool
    {
        return $this->isFullAdministrator() || $this->isContentEditor();
    }

    public function canManageClients(): bool
    {
        return $this->isFullAdministrator() || $this->isClientManager();
    }
}
