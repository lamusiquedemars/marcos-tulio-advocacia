<?php

namespace App\Modules\Acquisition\Actions;

use App\Modules\Acquisition\Jobs\SendAcquisitionDelivery;
use App\Modules\Acquisition\Models\AcquisitionDelivery;
use App\Modules\Inquiries\Models\Inquiry;

class QueueInquiryForCremona
{
    public static function run(Inquiry $inquiry): ?AcquisitionDelivery
    {
        if (! config('maracuja.acquisition.cremona.enabled')
            || blank(config('maracuja.acquisition.cremona.endpoint'))
            || blank(config('maracuja.acquisition.cremona.token'))) {
            return null;
        }

        $delivery = AcquisitionDelivery::query()->firstOrCreate(
            ['inquiry_id' => $inquiry->getKey()],
            [
                'idempotency_key' => sprintf('marcos-tulio:inquiry:%s', $inquiry->getKey()),
                'payload' => self::payload($inquiry),
                'status' => 'pending',
            ],
        );

        if ($delivery->wasRecentlyCreated || $delivery->status !== 'sent') {
            SendAcquisitionDelivery::dispatch($delivery->getKey())->afterCommit();
        }

        return $delivery;
    }

    /** @return array<string, mixed> */
    private static function payload(Inquiry $inquiry): array
    {
        return [
            'source' => [
                'channel' => 'website',
                'name' => 'maracuja-cms',
                'site_reference' => config('maracuja.acquisition.cremona.site_reference'),
                'form_reference' => 'contact-v1',
            ],
            'attribution' => [
                'source' => $inquiry->attribution_source,
                'medium' => $inquiry->attribution_medium,
                'campaign' => $inquiry->attribution_campaign,
                'first_touch' => $inquiry->attribution_first_touch,
                'last_touch' => $inquiry->attribution_last_touch,
                'method' => $inquiry->attribution_method,
                'confidence' => $inquiry->attribution_confidence !== null
                    ? (float) $inquiry->attribution_confidence
                    : null,
            ],
            'contact' => [
                'name' => $inquiry->name,
                'email' => $inquiry->email,
                'phone' => $inquiry->phone,
            ],
            'request' => [
                'subject' => $inquiry->subject,
                'message' => $inquiry->message,
                'category' => $inquiry->request_type?->value,
                'urgency' => match ($inquiry->urgency?->value) {
                    'urgente' => 'urgent',
                    'prazo_proximo' => 'high',
                    'sem_urgencia' => 'normal',
                    default => 'unknown',
                },
                'important_date' => $inquiry->deadline?->format('Y-m-d'),
            ],
            'answers' => collect([
                ['field_key' => 'phase', 'label' => 'Fase', 'value' => $inquiry->phase?->value],
                ['field_key' => 'location', 'label' => 'Localidade', 'value' => $inquiry->location],
                ['field_key' => 'modality', 'label' => 'Modalidade', 'value' => $inquiry->modality?->value],
            ])->filter(fn (array $answer): bool => filled($answer['value']))
                ->values()
                ->all(),
            'consent' => [
                'purpose' => 'respond_to_request',
                'channel' => 'email',
                'status' => 'granted',
                'statement' => 'Autorizou o uso dos dados para responder a esta solicitação.',
                'statement_version' => 'contact-v1',
                'source' => 'website_contact_form',
                'granted_at' => $inquiry->consent_at?->toIso8601String(),
            ],
        ];
    }
}
