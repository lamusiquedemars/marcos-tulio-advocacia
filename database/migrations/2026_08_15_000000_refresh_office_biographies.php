<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('content_slots')
            ->where('key', 'office.collaborator.name')
            ->update([
                'value' => 'Luis Eduardo Oliveira Miranda',
                'updated_at' => now(),
            ]);

        DB::table('content_slots')
            ->where('key', 'office.collaborator.role')
            ->update([
                'value' => 'Advogado colaborador',
                'updated_at' => now(),
            ]);

        DB::table('content_slots')
            ->where('key', 'office.collaborator.bio')
            ->update([
                'value' => 'Inscrito na OAB/MT sob o nº 10.394, Luis Eduardo Oliveira Miranda atua na advocacia criminal desde 2008 e mantém, há alguns anos, uma colaboração profissional com Marcos Túlio em casos da área penal.',
                'updated_at' => now(),
            ]);

        DB::table('pages')
            ->where('slug', 'marcos-tulio')
            ->update([
                'excerpt' => 'Advogado em Mato Grosso desde 2012, mestre em História, autor e ex-docente universitário.',
                'hero_subtitle' => 'Advocacia penal, trajetória acadêmica e comunicação jurídica.',
                'content' => '<p>Advogado em Mato Grosso desde 2012, mestre em História pela UFMT, autor de O Pacote Anticrime Comentado e ex-docente de Direito Penal e Processo Penal no UNIVAG.</p>',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        // Content corrections are intentionally not reverted.
    }
};
