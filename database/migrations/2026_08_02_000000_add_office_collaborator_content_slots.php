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
                'value' => 'Luis Eduardo Oliveira Miranda',
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
                'value' => 'Inscrito na OAB/MT sob o nº 10.394, Luis Eduardo Oliveira Miranda atua na advocacia criminal desde 2008 e mantém, há alguns anos, uma colaboração profissional com Marcos Túlio em casos da área penal.',
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
