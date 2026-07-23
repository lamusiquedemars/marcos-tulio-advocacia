<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\ContentSlots\ContentSlotResource;
use App\Filament\Resources\Events\EventResource;
use App\Filament\Resources\Galleries\GalleryResource;
use App\Filament\Resources\NewsPosts\NewsPostResource;
use App\Filament\Resources\OralDefenses\OralDefenseResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\SiteNotices\SiteNoticeResource;
use App\Filament\Resources\SiteSettings\SiteSettingResource;
use App\Modules\Appointments\Filament\Resources\AppointmentSettings\AppointmentSettingResource;
use App\Modules\Inquiries\Filament\Resources\Inquiries\InquiryResource;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Schema;

class AdminWelcome extends Widget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 10;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.admin-welcome';

    protected function getViewData(): array
    {
        $settings = SiteSetting::current();

        return [
            'siteName' => $settings->site_name ?: 'Maracuja CMS',
            'baseline' => $settings->baseline,
            'primaryActions' => $this->primaryActions(),
            'secondaryActions' => $this->secondaryActions(),
        ];
    }

    private function primaryActions(): array
    {
        return array_values(array_filter([
            $this->moduleAction('oral_defenses', OralDefenseResource::class, 'Gerenciar sustentações e defesas', 'Vídeo principal, seleção publicada e exemplos anonimizados.', 'oral_defenses'),
            $this->moduleAction('pages', PageResource::class, 'Atualizar uma página', 'Títulos, textos principais e SEO.'),
            $this->moduleAction('content_slots', ContentSlotResource::class, 'Modificar um texto curto', 'Chamadas, frases de seção e microconteúdos.'),
            $this->moduleAction('inquiries', InquiryResource::class, 'Tratar solicitações', 'Mensagens recebidas, respostas e acompanhamento.', 'inquiries'),
            $this->moduleAction('appointments', AppointmentSettingResource::class, 'Configurar agendamento', 'Página Brevo Meetings, modo de reserva e fuso horário.', 'appointment_settings'),
            $this->moduleAction('site_settings', SiteSettingResource::class, 'Configurar o site', 'Nome, contato, redes, SEO e imagens padrão.'),
        ]));
    }

    private function secondaryActions(): array
    {
        return array_values(array_filter([
            $this->moduleAction('news', NewsPostResource::class, 'Notícias', 'Publicar um aviso ou uma informação curta.'),
            $this->moduleAction('articles', ArticleResource::class, 'Artigos', 'Preparar conteúdos longos e estruturados.'),
            $this->moduleAction('notices', SiteNoticeResource::class, 'Aviso curto', 'Exibir uma mensagem temporária no site.'),
            $this->moduleAction('gallery', GalleryResource::class, 'Galerias', 'Organizar as imagens visíveis no site.'),
            $this->moduleAction('events', EventResource::class, 'Eventos', 'Atualizar datas, locais e programação.'),
        ]));
    }

    /**
     * @param  class-string  $resource
     */
    private function moduleAction(string $module, string $resource, string $label, string $description, ?string $table = null): ?array
    {
        if (! Modules::enabled($module)) {
            return null;
        }

        if ($table !== null && ! Schema::hasTable($table)) {
            return null;
        }

        if (! method_exists($resource, 'getUrl') || ! $resource::canAccess()) {
            return null;
        }

        return [
            'label' => $label,
            'description' => $description,
            'url' => $resource::getUrl(),
            'external' => false,
        ];
    }
}
