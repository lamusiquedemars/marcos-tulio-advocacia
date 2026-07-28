<?php

namespace App\Modules\Conversations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class ConversationSetting extends Model
{
    public const QUALIFICATION_FIELDS = [
        'request_topic' => 'Tema geral da solicitação',
        'location' => 'Localização',
        'deadline' => 'Data, prazo ou momento importante',
        'existing_contact' => 'Profissional já envolvido',
        'preferred_contact' => 'Canal de contato preferido',
    ];

    public const ROUTING_TRIGGERS = [
        'minimum_context' => 'O contexto mínimo foi compreendido',
        'visitor_request' => 'O visitante pede para falar com uma pessoa',
        'urgency' => 'Uma urgência configurada foi detectada',
        'assistant_limit' => 'O assistente atingiu o limite de seu papel',
    ];

    public const CALLBACK_CHANNELS = [
        'whatsapp' => 'WhatsApp',
        'phone' => 'Telefone',
        'email' => 'E-mail',
    ];

    protected $fillable = [
        'is_enabled',
        'widget_button_label',
        'widget_title',
        'privacy_notice',
        'assistant_language',
        'assistant_tone',
        'organization_summary',
        'qualification_fields',
        'qualification_guidance',
        'urgency_guidance',
        'sensitive_data_guidance',
        'routing_triggers',
        'whatsapp_enabled',
        'whatsapp_number',
        'whatsapp_message_template',
        'whatsapp_contact_message_template',
        'callback_enabled',
        'callback_channels',
        'notification_email',
        'expected_response_time',
        'additional_instructions',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'qualification_fields' => 'array',
            'routing_triggers' => 'array',
            'whatsapp_enabled' => 'boolean',
            'callback_enabled' => 'boolean',
            'callback_channels' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $setting): void {
            if ($setting->whatsapp_enabled && blank($setting->whatsapp_number)) {
                throw ValidationException::withMessages([
                    'whatsapp_number' => 'Renseignez le numéro WhatsApp proposé aux visiteurs.',
                ]);
            }

            if ($setting->callback_enabled && blank($setting->callback_channels)) {
                throw ValidationException::withMessages([
                    'callback_channels' => 'Sélectionnez au moins un canal de rappel.',
                ]);
            }
        });
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], self::defaults());
    }

    /**
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'is_enabled' => false,
            'widget_button_label' => 'Nous écrire',
            'widget_title' => 'Comment pouvons-nous vous aider ?',
            'privacy_notice' => 'Ne transmettez pas de mots de passe, coordonnées bancaires ou documents sensibles.',
            'assistant_language' => 'fr',
            'assistant_tone' => 'clair, calme et concis',
            'organization_summary' => null,
            'qualification_fields' => ['request_topic', 'location'],
            'qualification_guidance' => null,
            'urgency_guidance' => null,
            'sensitive_data_guidance' => null,
            'routing_triggers' => array_keys(self::ROUTING_TRIGGERS),
            'whatsapp_enabled' => false,
            'whatsapp_number' => null,
            'whatsapp_message_template' => 'Bonjour, je viens du site. Ma référence de conversation est {{reference}}.',
            'whatsapp_contact_message_template' => 'Bonjour, je vous contacte au sujet de votre demande {{reference}}.',
            'callback_enabled' => false,
            'callback_channels' => ['phone', 'email'],
            'notification_email' => null,
            'expected_response_time' => null,
            'additional_instructions' => null,
        ];
    }
}
