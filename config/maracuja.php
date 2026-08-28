<?php

return [
    'product_name' => env('MARACUJA_PRODUCT_NAME', 'Maracuja CMS'),

    'theme' => env('MARACUJA_THEME', 'default'),

    'client_theme' => env('MARACUJA_CLIENT_THEME', 'marcos-tulio'),

    'offer' => env('MARACUJA_OFFER', 'signature'),

    'seo' => [
        'indexable' => env('MARACUJA_INDEXABLE', false),
    ],

    'assistant' => [
        'provider' => env('MARACUJA_ASSISTANT_PROVIDER', 'fake'),
        'inquiry_retention_days' => env('MARACUJA_INQUIRY_RETENTION_DAYS', 90),
    ],

    'acquisition' => [
        'cremona' => [
            'enabled' => env('MARACUJA_CREMONA_ENABLED', false),
            'endpoint' => env('MARACUJA_CREMONA_ENDPOINT'),
            'reporting_endpoint' => env('MARACUJA_CREMONA_REPORTING_ENDPOINT'),
            'token' => env('MARACUJA_CREMONA_TOKEN'),
            'site_reference' => env('MARACUJA_CREMONA_SITE_REFERENCE', 'marcos-tulio-advocacia'),
        ],
    ],

    'conversations' => [
        'retention_days' => env('MARACUJA_CONVERSATIONS_RETENTION_DAYS', 90),
        'archive_inactive_after_hours' => env('MARACUJA_CONVERSATIONS_ARCHIVE_INACTIVE_AFTER_HOURS', 48),
        'reference_length' => env('MARACUJA_CONVERSATIONS_REFERENCE_LENGTH', 8),
        'public' => [
            'handover_message' => env(
                'MARACUJA_CONVERSATIONS_HANDOVER_MESSAGE',
                'Seu pedido de atendimento humano foi registrado. Em caso de urgência, use também o WhatsApp.',
            ),
        ],
        'callback' => [
            'ask_name' => 'Claro. Como você gostaria de ser chamado?',
            'invalid_name' => 'Informe apenas o nome pelo qual podemos chamar você.',
            'ask_preference' => 'Você prefere receber o contato por WhatsApp, telefone ou email?',
            'invalid_preference' => 'Responda apenas: WhatsApp, telefone ou email.',
            'ask_email' => 'Em qual endereço de email podemos responder?',
            'ask_phone' => 'Qual número podemos usar para entrar em contato?',
            'invalid_email' => 'Esse email não parece válido. Pode conferir?',
            'invalid_phone' => 'Esse número parece incompleto. Pode conferir, incluindo o DDD?',
            'ask_consent' => 'Você autoriza o escritório a usar esses dados somente para responder a esta solicitação? Responda sim ou não.',
            'invalid_consent' => 'Por favor, responda claramente com sim ou não.',
            'consent_refused' => 'Nenhum dado de contato foi registrado. Você ainda pode continuar diretamente pelo WhatsApp.',
            'completed' => 'Obrigado. Sua solicitação foi registrada e o escritório poderá entrar em contato.',
        ],
        'notifications' => [
            'enabled' => env('MARACUJA_CONVERSATIONS_NOTIFICATIONS_ENABLED', true),
            'recipient' => env('MARACUJA_CONVERSATIONS_NOTIFICATION_EMAIL'),
            'subject' => 'Nova solicitação de contato pelo site',
        ],
        'ai' => [
            'provider' => env('MARACUJA_CONVERSATIONS_AI_PROVIDER', 'fake'),
            'model' => env('OPENAI_CONVERSATIONS_MODEL', 'gpt-5.6-luna'),
            'reasoning_effort' => env('OPENAI_CONVERSATIONS_REASONING_EFFORT', 'low'),
            'max_output_tokens' => env('OPENAI_CONVERSATIONS_MAX_OUTPUT_TOKENS', 600),
            'history_messages' => env('MARACUJA_CONVERSATIONS_HISTORY_MESSAGES', 24),
            'timeout_seconds' => env('MARACUJA_CONVERSATIONS_AI_TIMEOUT', 20),
            'fallback_message' => env(
                'MARACUJA_CONVERSATIONS_AI_FALLBACK_MESSAGE',
                'Não consigo responder agora. Seu atendimento será encaminhado a uma pessoa do escritório.',
            ),
        ],
    ],

    'gallery' => [
        'slug' => env('MARACUJA_GALLERY_SLUG', 'home'),
        'layout' => env('MARACUJA_GALLERY_LAYOUT', 'grid'),
        'lightbox' => env('MARACUJA_GALLERY_LIGHTBOX', true),
    ],

    'news' => [
        'default_duration_days' => env('MARACUJA_NEWS_DEFAULT_DURATION_DAYS', 30),
    ],

    'articles' => [
        'public_path' => env('MARACUJA_ARTICLES_PUBLIC_PATH', 'articles'),
    ],

    'events' => [
        'public_path' => env('MARACUJA_EVENTS_PUBLIC_PATH', 'evenements'),
    ],

    'media' => [
        'disk' => 'public',
        'images_directory' => 'media/images',
        'documents_directory' => 'media/documents',
        'video_thumbnails_directory' => 'media/video-thumbnails',
        'ffmpeg_binary' => env('MARACUJA_FFMPEG_BINARY', 'ffmpeg'),
        'video_thumbnail_second' => 1,
        'image_max_size_kb' => 5 * 1024,
        'document_max_size_kb' => 15 * 1024,
        'video_max_size_kb' => 100 * 1024,
        'mime_types' => [
            'image/jpeg' => ['type' => 'image', 'extension' => 'jpg'],
            'image/png' => ['type' => 'image', 'extension' => 'png'],
            'image/webp' => ['type' => 'image', 'extension' => 'webp'],
            'application/pdf' => ['type' => 'document', 'extension' => 'pdf'],
            'video/mp4' => ['type' => 'video', 'extension' => 'mp4'],
            'video/webm' => ['type' => 'video', 'extension' => 'webm'],
        ],
    ],

    'modules' => [
        'site_settings' => env('MARACUJA_MODULE_SITE_SETTINGS', true),
        'notices' => env('MARACUJA_MODULE_NOTICES', true),
        'content_slots' => env('MARACUJA_MODULE_CONTENT_SLOTS', true),
        'pages' => env('MARACUJA_MODULE_PAGES', true),
        'news' => env('MARACUJA_MODULE_NEWS', true),
        'articles' => env('MARACUJA_MODULE_ARTICLES', true),
        'venues' => env('MARACUJA_MODULE_VENUES', true),
        'events' => env('MARACUJA_MODULE_EVENTS', true),
        'gallery' => env('MARACUJA_MODULE_GALLERY', true),
        'contact_form' => env('MARACUJA_MODULE_CONTACT_FORM', true),
        'inquiries' => env('MARACUJA_MODULE_INQUIRIES', true),
        'audience' => env('MARACUJA_MODULE_AUDIENCE', false),
        'acquisition' => env('MARACUJA_MODULE_ACQUISITION', true),
        'campaigns' => env('MARACUJA_MODULE_CAMPAIGNS', false),
        'oral_defenses' => env('MARACUJA_MODULE_ORAL_DEFENSES', true),
        'assistant' => env('MARACUJA_MODULE_ASSISTANT', true),
        'appointments' => env('MARACUJA_MODULE_APPOINTMENTS', true),
        'contacts' => env('MARACUJA_MODULE_CONTACTS', true),
        'conversations' => env('MARACUJA_MODULE_CONVERSATIONS', true),
    ],

    'developer_tools' => [
        'pages_admin' => env('MARACUJA_DEV_PAGES_ADMIN', false),
        'image_optimization' => env('MARACUJA_DEV_IMAGE_OPTIMIZATION', false),
    ],

    'offers' => [
        'essence' => [
            'site_settings' => true,
            'notices' => false,
            'content_slots' => false,
            'pages' => true,
            'news' => false,
            'articles' => false,
            'venues' => false,
            'events' => false,
            'gallery' => false,
            'contact_form' => true,
            'inquiries' => false,
            'audience' => false,
            'campaigns' => false,
        ],
        'signature' => [
            'site_settings' => true,
            'notices' => true,
            'content_slots' => true,
            'pages' => true,
            'news' => true,
            'articles' => true,
            'venues' => true,
            'events' => true,
            'gallery' => true,
            'contact_form' => true,
            'inquiries' => true,
            'audience' => false,
            'campaigns' => false,
        ],
        'univers' => [
            'site_settings' => true,
            'notices' => true,
            'content_slots' => true,
            'pages' => true,
            'news' => true,
            'articles' => true,
            'venues' => true,
            'events' => true,
            'gallery' => true,
            'contact_form' => true,
            'inquiries' => true,
            'audience' => true,
            'campaigns' => false,
        ],
    ],
];
