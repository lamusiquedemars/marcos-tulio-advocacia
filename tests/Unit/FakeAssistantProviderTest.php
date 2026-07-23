<?php

namespace Tests\Unit;

use App\Modules\Assistant\Providers\FakeAssistantProvider;
use Tests\TestCase;

class FakeAssistantProviderTest extends TestCase
{
    public function test_it_maps_the_scripted_answers_without_calling_an_external_service(): void
    {
        $message = app(FakeAssistantProvider::class)->qualify([
            'request_type' => 'consulta',
            'urgency' => 'sem_urgencia',
            'phase' => 'preventiva',
            'modality' => 'presencial',
            'name' => 'Pessoa Fictícia',
            'email' => 'pessoa@example.test',
            'summary' => 'Resumo fictício.',
        ]);

        $this->assertSame('Solicitação de consulta', $message->subject);
        $this->assertSame('consulta', $message->requestType);
        $this->assertSame('assistant_fake', $message->source);
        $this->assertNotNull($message->consentAt);
    }
}
