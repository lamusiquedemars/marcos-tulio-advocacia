<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('conversation_settings')->updateOrInsert(
            ['id' => 1],
            [
                'is_enabled' => true,
                'widget_button_label' => 'Falar com o escritório',
                'widget_title' => 'Como podemos ajudar?',
                'privacy_notice' => 'Este atendimento inicial não constitui orientação jurídica nem cria relação advogado-cliente. Não envie documentos ou informações altamente sensíveis neste primeiro contato.',
                'assistant_language' => 'pt-BR',
                'assistant_tone' => 'profissional, calmo, claro, respeitoso e conciso',
                'organization_summary' => 'Marcos Túlio Advocacia atua na advocacia criminal no Brasil, com atendimento em Cuiabá e possibilidade de acompanhamento em outras localidades. O assistente realiza somente o primeiro acolhimento e a orientação do contato.',
                'qualification_fields' => json_encode([
                    'request_topic',
                    'location',
                    'deadline',
                    'existing_contact',
                    'preferred_contact',
                ], JSON_THROW_ON_ERROR),
                'qualification_guidance' => 'Entenda o tema geral, a cidade ou Estado, se já existe advogado, e se há prisão, pessoa detida, audiência, prazo, mandado, busca ou convocação próxima. Não peça um relato detalhado.',
                'urgency_guidance' => 'Considere urgente: prisão ou pessoa detida, audiência ou prazo próximo, mandado, busca, convocação iminente, ameaça ou risco físico. Em risco imediato, oriente também a procurar o serviço de emergência competente.',
                'sensitive_data_guidance' => 'Não peça nomes de vítimas ou testemunhas, documentos processuais, identidade completa, senhas, dados bancários ou detalhes confidenciais desnecessários.',
                'routing_triggers' => json_encode([
                    'minimum_context',
                    'visitor_request',
                    'urgency',
                    'assistant_limit',
                ], JSON_THROW_ON_ERROR),
                'whatsapp_enabled' => false,
                'whatsapp_number' => null,
                'whatsapp_message_template' => 'Olá, entrei em contato pelo site. Minha referência de atendimento é {{reference}}.',
                'whatsapp_contact_message_template' => 'Olá, entro em contato sobre sua solicitação {{reference}}.',
                'callback_enabled' => true,
                'callback_channels' => json_encode([
                    'whatsapp',
                    'phone',
                    'email',
                ], JSON_THROW_ON_ERROR),
                'notification_email' => null,
                'expected_response_time' => 'O escritório informará os próximos passos assim que puder analisar a solicitação.',
                'additional_instructions' => 'Não ofereça aconselhamento jurídico, não prometa resultados e não invente procedimentos. Explique a diferença entre continuar pelo WhatsApp e solicitar um contato posterior, deixando a escolha ao visitante.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        DB::table('conversation_settings')->where('id', 1)->delete();
    }
};
