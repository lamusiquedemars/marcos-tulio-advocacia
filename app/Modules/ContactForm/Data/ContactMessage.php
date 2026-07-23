<?php

namespace App\Modules\ContactForm\Data;

class ContactMessage
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly ?string $subject,
        public readonly string $message,
        public readonly ?string $requestType = null,
        public readonly ?string $urgency = null,
        public readonly ?string $phase = null,
        public readonly ?string $deadline = null,
        public readonly ?string $location = null,
        public readonly ?string $modality = null,
        public readonly ?string $consentAt = null,
        public readonly string $source = 'contact_form',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'] ?? null,
            subject: $data['subject'] ?? null,
            message: $data['message'],
            requestType: $data['request_type'] ?? null,
            urgency: $data['urgency'] ?? null,
            phase: $data['phase'] ?? null,
            deadline: $data['deadline'] ?? null,
            location: $data['location'] ?? null,
            modality: $data['modality'] ?? null,
            consentAt: $data['consent_at'] ?? null,
            source: $data['source'] ?? 'contact_form',
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'request_type' => $this->requestType,
            'urgency' => $this->urgency,
            'phase' => $this->phase,
            'deadline' => $this->deadline,
            'location' => $this->location,
            'modality' => $this->modality,
            'consent_at' => $this->consentAt,
            'source' => $this->source,
        ];
    }
}
