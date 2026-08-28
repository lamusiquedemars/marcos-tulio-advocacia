<?php

namespace App\Modules\Acquisition\Jobs;

use App\Modules\Acquisition\Models\AcquisitionDelivery;
use App\Modules\Acquisition\Services\CremonaClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use RuntimeException;
use Throwable;

class SendAcquisitionDelivery implements ShouldQueue
{
    use Queueable;

    public int $tries = 5;

    /** @var array<int, int> */
    public array $backoff = [60, 300, 900, 3600];

    public function __construct(public readonly int $deliveryId) {}

    public function handle(CremonaClient $client): void
    {
        $delivery = AcquisitionDelivery::query()->findOrFail($this->deliveryId);

        if ($delivery->status === 'sent') {
            return;
        }

        $delivery->forceFill([
            'status' => 'sending',
            'attempts' => $delivery->attempts + 1,
            'last_attempt_at' => now(),
            'last_error' => null,
        ])->save();

        try {
            $response = $client->send($delivery->idempotency_key, $delivery->payload);
            $delivery->response_status = $response->status();

            if (! $response->successful()) {
                throw new RuntimeException("Cremona returned HTTP {$response->status()}.");
            }

            $delivery->forceFill([
                'status' => 'sent',
                'sent_at' => now(),
                'last_error' => null,
            ])->save();
        } catch (Throwable $exception) {
            $delivery->forceFill([
                'status' => 'pending',
                'last_error' => mb_substr($exception->getMessage(), 0, 2000),
            ])->save();

            throw $exception;
        }
    }

    public function failed(Throwable $exception): void
    {
        AcquisitionDelivery::query()->whereKey($this->deliveryId)->update([
            'status' => 'failed',
            'last_error' => mb_substr($exception->getMessage(), 0, 2000),
        ]);
    }
}
