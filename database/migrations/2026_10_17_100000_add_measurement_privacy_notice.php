<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pages')
            ->where('slug', 'mentions-legales')
            ->update([
                'content' => '<p>As informações deste site têm caráter institucional e informativo. O envio de uma mensagem não cria relação advogado-cliente nem substitui uma consulta jurídica.</p><p>Os dados enviados pelos formulários são utilizados exclusivamente para analisar e responder à solicitação de contato.</p><p>Com autorização, utilizamos Google Analytics e a medição de conversões do Google Ads para medir o uso do site e saber se os anúncios geram contatos. Não utilizamos remarketing.</p>',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        DB::table('pages')
            ->where('slug', 'mentions-legales')
            ->update([
                'content' => '<p>As informações deste site têm caráter institucional e informativo. O envio de uma mensagem não cria relação advogado-cliente nem substitui uma consulta jurídica.</p><p>Os dados enviados pelos formulários são utilizados exclusivamente para analisar e responder à solicitação de contato.</p>',
                'updated_at' => now(),
            ]);
    }
};
