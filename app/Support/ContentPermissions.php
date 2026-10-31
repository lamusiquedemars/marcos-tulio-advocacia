<?php

namespace App\Support;

use App\Models\User;
use App\Modules\Articles\Models\Article;
use App\Modules\Contacts\Models\Contact;
use App\Modules\ContentSlots\Models\ContentSlot;
use App\Modules\Conversations\Models\Conversation;
use App\Modules\Events\Models\Event;
use App\Modules\Gallery\Models\Gallery;
use App\Modules\Inquiries\Models\Inquiry;
use App\Modules\Media\Models\MediaAsset;
use App\Modules\News\Models\NewsPost;
use App\Modules\Notices\Models\SiteNotice;
use App\Modules\OralDefenses\Models\OralDefense;
use App\Modules\Pages\Models\Page;
use App\Modules\Venues\Models\Venue;
use Illuminate\Database\Eloquent\Model;

final class ContentPermissions
{
    public static function labels(): array
    {
        return [
            'pages' => 'Páginas', 'notices' => 'Avisos', 'content_slots' => 'Conteúdos curtos',
            'news' => 'Notícias', 'articles' => 'Artigos', 'media' => 'Mídias', 'gallery' => 'Galerias',
            'events' => 'Eventos', 'venues' => 'Locais', 'oral_defenses' => 'Sustentações orais',
            'inquiries' => 'Solicitações', 'contacts' => 'Contatos', 'conversations' => 'Conversas',
        ];
    }

    public static function labelsForForm(): array
    {
        $labels = self::labels();
        $modules = [];

        foreach ($labels as $key => $label) {
            // Older sites provide media permanently without a module flag.
            if ($key === 'media' && ! isset($modules[$key]) && config('maracuja.modules.media') === null) {
                continue;
            }

            if (! Modules::enabled($modules[$key] ?? $key)) {
                $labels[$key] = $label.' (módulo inativo)';
            }
        }

        return $labels;
    }

    public static function allows(User $user, ?string $model): bool
    {
        $permission = match ($model) {
            Page::class => 'pages', SiteNotice::class => 'notices', ContentSlot::class => 'content_slots',
            NewsPost::class => 'news', Article::class => 'articles', MediaAsset::class => 'media',
            Gallery::class => 'gallery', Event::class => 'events', Venue::class => 'venues',
            OralDefense::class => 'oral_defenses', Inquiry::class => 'inquiries', Contact::class => 'contacts',
            Conversation::class => 'conversations', default => null,
        };

        if ($permission !== null) {
            if (! $user->canAccessContent($permission)) {
                return false;
            }

            return in_array($permission, ['inquiries', 'contacts', 'conversations'], true)
                ? $user->canManageClients()
                : $user->canManageContent();
        }

        return $user->isAdministrator() || ! $model || ! is_a($model, Model::class, true);
    }
}
