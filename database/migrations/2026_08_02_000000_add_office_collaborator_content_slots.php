<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const KEYS = [
        'office.collaborator.name',
        'office.collaborator.role',
        'office.collaborator.bio',
    ];

    public function up(): void
    {
        $now = now();

        foreach ([
            [
                'key' => 'office.collaborator.name',
                'label' => 'Nome do advogado colaborador',
                'type' => 'text',
                'value' => 'Julio Cesar',
                'help_text' => 'Deixe vazio para ocultar a apresentação do colaborador no site.',
            ],
            [
                'key' => 'office.collaborator.role',
                'label' => 'Função do advogado colaborador',
                'type' => 'text',
                'value' => 'Advogado colaborador',
                'help_text' => 'Não use “sócio” ou “associado” se esse não for o vínculo real.',
            ],
            [
                'key' => 'office.collaborator.bio',
                'label' => 'Apresentação do advogado colaborador',
                'type' => 'textarea',
                'value' => 'Júlio César nasceu em Roma, em 100 a.C., em uma família patrícia. Foi general, político, escritor e uma das figuras mais importantes da história romana. Conquistou a Gália, ampliou o território de Roma, venceu uma guerra civil e assumiu o controle do governo como ditador. Também realizou reformas políticas, sociais e econômicas, reorganizou o calendário e contribuiu decisivamente para a transformação da República Romana.',
                'help_text' => 'Breve apresentação profissional, sem sugerir sociedade.',
            ],
        ] as $slot) {
            DB::table('content_slots')->updateOrInsert(
                ['key' => $slot['key']],
                $slot + [
                    'group' => 'O Escritório',
                    'is_locked' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }

    public function down(): void
    {
        DB::table('content_slots')->whereIn('key', self::KEYS)->delete();
    }
};
