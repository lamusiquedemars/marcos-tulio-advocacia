<?php

namespace App\Modules\Conversations\Providers;

use App\Modules\Conversations\Contracts\ConversationAiProvider;
use App\Modules\Conversations\Data\AiConversationRequest;
use App\Modules\Conversations\Data\AiConversationResult;
use App\Modules\Conversations\Enums\ConversationUrgency;

class FakeConversationAiProvider implements ConversationAiProvider
{
    public function respond(AiConversationRequest $request): AiConversationResult
    {
        return new AiConversationResult(
            reply: 'Obrigado pela mensagem. Você pode explicar brevemente como o escritório pode ajudar?',
            summary: 'Novo atendimento em fase de qualificação.',
            topic: null,
            urgency: ConversationUrgency::Unknown,
            requiresHuman: false,
        );
    }
}
