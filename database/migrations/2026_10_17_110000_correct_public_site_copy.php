<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('content_slots')->updateOrInsert(
            ['key' => 'office.marcos.oab'],
            [
                'label' => 'Inscrição profissional de Marcos Túlio',
                'group' => 'O Escritório',
                'type' => 'text',
                'value' => 'Inscrito na OAB/MT sob o nº 16.291.',
                'help_text' => 'Número de inscrição profissional exibido na apresentação do advogado responsável.',
                'is_locked' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        DB::table('oral_defenses')
            ->where('title', 'Sustentação oral contra prisão preventiva')
            ->update([
                'context' => 'Sustentação oral sobre prisão preventiva e a garantia da ordem pública.',
                'updated_at' => now(),
            ]);

        DB::table('oral_defenses')
            ->where('title', 'Estilo de sustentação com firmeza')
            ->update([
                'title' => 'Sustentação oral: firmeza na defesa',
                'context' => 'Sustentação oral perante os desembargadores, com apresentação dos fundamentos da defesa.',
                'updated_at' => now(),
            ]);

        DB::table('oral_defenses')
            ->where('title', 'Considerações sobre dinâmica de leitura de votos')
            ->update([
                'context' => 'Trecho de manifestação sobre a dinâmica da leitura dos votos durante o julgamento.',
                'updated_at' => now(),
            ]);

        DB::table('conversation_settings')->where('id', 1)->update([
            'widget_button_label' => 'Atendimento inicial',
            'widget_title' => 'Atendimento inicial automatizado',
            'privacy_notice' => 'Este atendimento inicial é automatizado e não substitui a conversa com um advogado. Não envie documentos ou informações altamente sensíveis neste primeiro contato.',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('content_slots')->where('key', 'office.marcos.oab')->delete();
    }
};
