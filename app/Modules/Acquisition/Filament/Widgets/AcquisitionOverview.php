<?php

namespace App\Modules\Acquisition\Filament\Widgets;

use App\Modules\Acquisition\Models\AcquisitionReportingSnapshot;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Models\Inquiry;
use App\Support\Modules;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class AcquisitionOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 30;

    protected ?string $heading = 'Aquisição — últimos 30 dias';

    protected ?string $description = 'O que o site registrou antes da conexão dos custos publicitários.';

    public static function canView(): bool
    {
        return Modules::enabled('acquisition') && Schema::hasTable('inquiries');
    }

    protected function getStats(): array
    {
        $recent = fn (Builder $query): Builder => $query->where('created_at', '>=', now()->subDays(30));
        $received = $this->count($recent);
        $attributed = $this->count(fn (Builder $query): Builder => $recent($query)->whereNotNull('attribution_source'));
        $google = $this->count(fn (Builder $query): Builder => $recent($query)->where('attribution_source', 'google'));
        $priority = $this->count(fn (Builder $query): Builder => $query
            ->whereIn('status', [InquiryStatus::New->value, InquiryStatus::ToHandle->value])
            ->where(function (Builder $query): void {
                $query->where('urgency', 'urgente')
                    ->orWhere('deadline', '<=', now()->addDays(7)->toDateString());
            }));
        $report = Schema::hasTable('acquisition_reporting_snapshots')
            ? AcquisitionReportingSnapshot::current()
            : null;
        $reportData = $report?->payload ?? [];
        $reportDescription = $report !== null
            ? 'Mis à jour '.$report->fetched_at?->diffForHumans()
            : 'À synchroniser depuis Cremona';

        return [
            Stat::make('Demandes reçues', $received)
                ->description('Les 30 derniers jours')
                ->icon(Heroicon::OutlinedInbox)
                ->color('info'),
            Stat::make('Origine identifiée', $attributed)
                ->description($this->rateDescription($attributed, $received))
                ->icon(Heroicon::OutlinedLink)
                ->color($attributed > 0 ? 'success' : 'gray'),
            Stat::make('Issues de Google', $google)
                ->description('Demandes avec Google comme origine')
                ->icon(Heroicon::OutlinedMagnifyingGlass)
                ->color($google > 0 ? 'primary' : 'gray'),
            Stat::make('À répondre en priorité', $priority)
                ->description('Urgence déclarée ou date proche')
                ->icon(Heroicon::OutlinedExclamationTriangle)
                ->color($priority > 0 ? 'danger' : 'gray'),
            Stat::make('Dépense campagnes', isset($reportData['spend'])
                ? 'R$ '.number_format((float) $reportData['spend'], 2, ',', '.')
                : '—')
                ->description($reportDescription)
                ->icon(Heroicon::OutlinedBanknotes)
                ->color(isset($reportData['spend']) ? 'warning' : 'gray'),
            Stat::make('Demandes liées aux campagnes', $reportData['leads'] ?? '—')
                ->description('Synthèse Cremona, sans données personnelles')
                ->icon(Heroicon::OutlinedChartBar)
                ->color(isset($reportData['leads']) ? 'success' : 'gray'),
        ];
    }

    /** @param callable(Builder): Builder $scope */
    private function count(callable $scope): int
    {
        return $scope(Inquiry::query())->count();
    }

    private function rateDescription(int $attributed, int $received): string
    {
        if ($received === 0) {
            return 'Aucune demande reçue sur la période';
        }

        return sprintf('%d %% des demandes reçues', (int) round(($attributed / $received) * 100));
    }
}
