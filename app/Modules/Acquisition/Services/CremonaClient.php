<?php

namespace App\Modules\Acquisition\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CremonaClient
{
    /** @param array<string, mixed> $payload */
    public function send(string $idempotencyKey, array $payload): Response
    {
        return Http::acceptJson()
            ->asJson()
            ->withToken((string) config('maracuja.acquisition.cremona.token'))
            ->withHeader('Idempotency-Key', $idempotencyKey)
            ->timeout(15)
            ->post((string) config('maracuja.acquisition.cremona.endpoint'), $payload);
    }

    /** @return array<string, mixed> */
    public function summary(string $siteReference, int $days = 30): array
    {
        $response = Http::acceptJson()
            ->withToken((string) config('maracuja.acquisition.cremona.token'))
            ->timeout(15)
            ->get((string) config('maracuja.acquisition.cremona.reporting_endpoint'), [
                'site_reference' => $siteReference,
                'days' => $days,
            ]);

        $response->throw();

        return $response->json('data') ?? [];
    }
}
