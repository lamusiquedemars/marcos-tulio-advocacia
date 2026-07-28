<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('conversation_settings')->where('id', 1)->update([
            'welcome_message' => 'Olá! Este é o atendimento inicial da Marcos Túlio Advocacia. Conte brevemente o tema geral da sua situação para que possamos orientar o próximo passo.',
            'max_visitor_messages' => 12,
            'warning_at_message' => 10,
            'interaction_limit_message' => 'Chegamos ao limite desta conversa inicial. Para continuar, escolha uma das opções de contato disponíveis.',
            'whatsapp_enabled' => true,
            'whatsapp_number' => '+5565992830446',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('conversation_settings')->where('id', 1)->update([
            'welcome_message' => null,
            'max_visitor_messages' => 12,
            'warning_at_message' => 10,
            'interaction_limit_message' => null,
            'updated_at' => now(),
        ]);
    }
};
