<?php

namespace App\Modules\Conversations\Policies;

use App\Models\User;
use App\Modules\Conversations\Models\Conversation;

class ConversationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canManageClients();
    }

    public function view(User $user, Conversation $conversation): bool
    {
        return $user->canManageClients();
    }

    public function update(User $user, Conversation $conversation): bool
    {
        return $user->canManageClients();
    }

    public function delete(User $user, Conversation $conversation): bool
    {
        return false;
    }
}
