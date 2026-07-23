<?php

namespace App\Modules\Assistant\Providers;

use App\Modules\Assistant\Contracts\AssistantProvider;
use App\Modules\ContactForm\Data\ContactMessage;
use App\Modules\Inquiries\Enums\InquiryRequestType;

class FakeAssistantProvider implements AssistantProvider
{
    public function qualify(array $input): ContactMessage
    {
        $type = InquiryRequestType::from($input['request_type']);

        return new ContactMessage(
            name: $input['name'],
            email: $input['email'],
            phone: $input['phone'] ?? null,
            subject: $type->label(),
            message: $input['summary'],
            requestType: $type->value,
            urgency: $input['urgency'],
            phase: $input['phase'],
            location: $input['location'] ?? null,
            modality: $input['modality'] ?? null,
            consentAt: now()->toIso8601String(),
            source: 'assistant_fake',
        );
    }
}
