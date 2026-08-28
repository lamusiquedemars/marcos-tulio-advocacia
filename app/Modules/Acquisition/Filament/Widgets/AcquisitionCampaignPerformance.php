<?php

namespace App\Modules\Acquisition\Filament\Widgets;

use App\Modules\Acquisition\Models\AcquisitionReportingSnapshot;
use App\Support\Modules;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Schema;

class AcquisitionCampaignPerformance extends Widget
{
    protected static ?int $sort = 31;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.acquisition-campaign-performance';

    public static function canView(): bool
    {
        return Modules::enabled('acquisition')
            && Schema::hasTable('acquisition_reporting_snapshots');
    }

    /** @return array<string, mixed> */
    protected function getViewData(): array
    {
        $snapshot = AcquisitionReportingSnapshot::current();
        $payload = $snapshot?->payload ?? [];
        $currency = $payload['currency'] ?? 'BRL';
        $campaigns = collect($payload['campaigns'] ?? [])
            ->filter(fn (mixed $campaign): bool => is_array($campaign))
            ->map(function (array $campaign) use ($currency): array {
                $spend = (float) ($campaign['spend'] ?? 0);
                $leads = (int) ($campaign['leads'] ?? 0);

                return [
                    'name' => $campaign['name'] ?? 'Campanha sem nome',
                    'channel' => $campaign['channel'] ?? 'other',
                    'status' => $campaign['status'] ?? 'draft',
                    'spend' => $spend,
                    'leads' => $leads,
                    'converted_leads' => (int) ($campaign['converted_leads'] ?? 0),
                    'cost_per_lead' => $leads > 0 ? $spend / $leads : null,
                    'currency' => $currency,
                ];
            })
            ->sortByDesc('spend')
            ->values()
            ->all();

        return [
            'campaigns' => $campaigns,
            'fetchedAt' => $snapshot?->fetched_at,
            'hasSnapshot' => $snapshot !== null,
        ];
    }
}
