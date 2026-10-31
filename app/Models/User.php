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

#[Fillable(['name', 'email', 'password', 'is_admin', 'role', 'content_permissions', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    public const ROLE_CONTENT_EDITOR = 'content_editor';

    public const ROLE_CLIENT_MANAGER = 'client_manager';

    public const ROLE_ADMIN = 'admin';

    public const ROLE_MANAGER = self::ROLE_CLIENT_MANAGER;

    public const ROLE_EDITOR = self::ROLE_CONTENT_EDITOR;

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
            'is_active' => 'boolean',
            'content_permissions' => 'array',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->is_active === false) {
            return false;
        }

        return $this->isFullAdministrator()
            || $this->isContentEditor()
            || $this->isClientManager();
    }

    public function isFullAdministrator(): bool
    {
        return $this->is_admin === true;
    }

    public function isAdministrator(): bool
    {
        return $this->isFullAdministrator();
    }

    public function canEditContent(): bool
    {
        return $this->isFullAdministrator() || $this->isContentEditor() || $this->isClientManager();
    }

    public function canAccessContent(string $permission): bool
    {
        return $this->isAdministrator() || $this->content_permissions === null
            || in_array($permission, $this->content_permissions, true);
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
        return $this->isFullAdministrator() || $this->isContentEditor()
            || (bool) array_intersect($this->content_permissions ?? [], ['pages', 'notices', 'content_slots', 'news', 'articles', 'media', 'gallery', 'events', 'venues', 'oral_defenses']);
    }

    public function canManageClients(): bool
    {
        return $this->isFullAdministrator() || $this->isClientManager()
            || (bool) array_intersect($this->content_permissions ?? [], ['inquiries', 'contacts', 'conversations']);
    }
}
