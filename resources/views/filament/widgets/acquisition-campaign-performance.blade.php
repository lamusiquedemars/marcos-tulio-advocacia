<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Desempenho das campanhas</x-slot>
        <x-slot name="description">
            @if ($fetchedAt)
                Dados consolidados no Cremona, atualizados {{ $fetchedAt->diffForHumans() }}.
            @else
                Os dados aparecerão aqui após a primeira sincronização com o Cremona.
            @endif
        </x-slot>

        @if (! $hasSnapshot)
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Nenhum dado de campanha foi sincronizado ainda. As solicitações do site já continuam registradas normalmente.
            </p>
        @elseif ($campaigns === [])
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Ainda não há campanhas vinculadas a este site no Cremona.
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b text-xs uppercase text-gray-500 dark:border-white/10 dark:text-gray-400">
                        <tr>
                            <th class="px-3 py-3">Campanha</th>
                            <th class="px-3 py-3">Canal</th>
                            <th class="px-3 py-3 text-right">Investimento</th>
                            <th class="px-3 py-3 text-right">Solicitações</th>
                            <th class="px-3 py-3 text-right">Convertidas</th>
                            <th class="px-3 py-3 text-right">Custo por solicitação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-white/10">
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td class="px-3 py-3 font-medium text-gray-950 dark:text-white">{{ $campaign['name'] }}</td>
                                <td class="px-3 py-3">{{ match ($campaign['channel']) { 'google_ads' => 'Google Ads', 'meta_ads' => 'Meta Ads', 'linkedin_ads' => 'LinkedIn Ads', default => 'Outro' } }}</td>
                                <td class="px-3 py-3 text-right">{{ $campaign['currency'] }} {{ number_format($campaign['spend'], 2, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right">{{ $campaign['leads'] }}</td>
                                <td class="px-3 py-3 text-right">{{ $campaign['converted_leads'] }}</td>
                                <td class="px-3 py-3 text-right">
                                    {{ $campaign['cost_per_lead'] === null ? '—' : $campaign['currency'].' '.number_format($campaign['cost_per_lead'], 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
