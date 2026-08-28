<?php

namespace App\Console\Commands;

use App\Modules\Acquisition\Models\AcquisitionReportingSnapshot;
use App\Modules\Acquisition\Services\CremonaClient;
use Illuminate\Console\Command;
use Throwable;

class SyncAcquisitionSummaryCommand extends Command
{
    protected $signature = 'acquisition:sync-summary';

    protected $description = 'Atualiza o resumo de campanhas exibido no painel do site.';

    public function handle(CremonaClient $client): int
    {
        $config = config('maracuja.acquisition.cremona');

        if (! ($config['enabled'] ?? false)
            || blank($config['reporting_endpoint'] ?? null)
            || blank($config['token'] ?? null)) {
            $this->components->warn('A conexão de relatórios Cremona não está configurada.');

            return self::SUCCESS;
        }

        try {
            $payload = $client->summary((string) $config['site_reference']);
            AcquisitionReportingSnapshot::query()->updateOrCreate(
                ['site_reference' => $config['site_reference']],
                ['payload' => $payload, 'fetched_at' => now(), 'last_error' => null],
            );
            $this->components->info('Resumo de campanhas atualizado.');

            return self::SUCCESS;
        } catch (Throwable $exception) {
            AcquisitionReportingSnapshot::query()->where('site_reference', $config['site_reference'])->update([
                'last_error' => mb_substr($exception->getMessage(), 0, 2000),
            ]);
            $this->components->error('Não foi possível atualizar o resumo de campanhas.');

            return self::FAILURE;
        }
    }
}
