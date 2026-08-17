<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Modules\Articles\Models\Article;
use App\Modules\ContentSlots\Models\ContentSlot;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Models\Inquiry;
use App\Modules\News\Models\NewsPost;
use App\Modules\Pages\Models\Page;
use App\Support\Modules;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AdminOverview extends StatsOverviewWidget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 20;

    protected ?string $heading = 'Visão geral';

    protected ?string $description = 'Os pontos úteis para administrar o site no dia a dia.';

    protected function getStats(): array
    {
        $stats = [
            Stat::make('Páginas publicadas', Modules::enabled('pages') ? $this->count(Page::class, 'pages', fn ($query) => $query->where('is_published', true)) : 0)
                ->description('Páginas visíveis no site')
                ->icon(Heroicon::OutlinedRectangleStack)
                ->color('success'),
            Stat::make('Conteúdos para revisar', $this->contentToReviewCount())
                ->description('Rascunhos e textos curtos')
                ->icon(Heroicon::OutlinedPencilSquare)
                ->color('warning'),
        ];

        if ($this->isFullAdministrator()) {
            $stats[] = Stat::make('Solicitações pendentes', $this->inquiriesToHandleCount())
                ->description('Novas solicitações e acompanhamentos prioritários')
                ->icon(Heroicon::OutlinedInbox)
                ->color($this->inquiriesToHandleCount() > 0 ? 'danger' : 'gray');
        }

        return $stats;
    }

    private function contentToReviewCount(): int
    {
        $count = 0;

        if (Modules::enabled('news')) {
            $count += $this->count(NewsPost::class, 'news_posts', fn ($query) => $query->where('is_published', false));
        }

        if (Modules::enabled('articles')) {
            $count += $this->count(Article::class, 'articles', fn ($query) => $query->where('is_published', false));
        }

        if (Modules::enabled('content_slots')) {
            $count += $this->count(ContentSlot::class, 'content_slots');
        }

        if ($this->isFullAdministrator() && Modules::enabled('inquiries')) {
            $count += $this->inquiriesToHandleCount();
        }

        return $count;
    }

    private function inquiriesToHandleCount(): int
    {
        if (! Modules::enabled('inquiries') || ! Schema::hasTable('inquiries')) {
            return 0;
        }

        return Inquiry::query()
            ->whereIn('status', [
                InquiryStatus::New->value,
                InquiryStatus::ToHandle->value,
            ])
            ->count();
    }

    private function isFullAdministrator(): bool
    {
        $user = Filament::auth()->user();

        return $user instanceof User && $user->isFullAdministrator();
    }

    /**
     * @param  class-string<Model>  $model
     */
    private function count(string $model, string $table, ?callable $queryCallback = null): int
    {
        if (! Schema::hasTable($table)) {
            return 0;
        }

        $query = $model::query();

        if ($queryCallback !== null) {
            $queryCallback($query);
        }

        return $query->count();
    }
}
