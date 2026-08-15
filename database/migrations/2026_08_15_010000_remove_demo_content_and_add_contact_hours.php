<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        DB::table('content_slots')->updateOrInsert(
            ['key' => 'contact.office_hours'],
            [
                'label' => 'Horários de atendimento',
                'group' => 'Contato',
                'type' => 'text',
                'value' => 'Segunda a sexta, mediante agendamento.',
                'help_text' => 'Horários exibidos na seção “Onde nos encontrar” da página de contato.',
                'is_locked' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        );

        DB::table('site_settings')->update([
            'default_seo_title' => 'Marcos Túlio Advocacia — Advocacia criminal',
            'default_seo_description' => 'Advocacia criminal em Cuiabá, com atendimento presencial e remoto em todo o Brasil.',
            'contact_email' => 'marcostulioadvocacia@hotmail.com',
            'phone' => '+55 (65) 99283-0446',
            'address' => 'Endereço completo em Cuiabá, MT',
            'updated_at' => $now,
        ]);

        DB::table('conversation_settings')->update([
            'notification_email' => 'marcostulioadvocacia@hotmail.com',
            'updated_at' => $now,
        ]);

        $pages = [
            'accueil' => [
                'excerpt' => 'Advocacia criminal em Cuiabá, com atendimento presencial e remoto em todo o Brasil.',
            ],
            'services' => [
                'content' => '<p>Atuação técnica e estratégica em diferentes etapas da defesa penal.</p>',
            ],
            'sustentacoes-e-defesas' => [
                'hero_subtitle' => 'Seleção de sustentações orais e intervenções profissionais autorizadas.',
                'content' => '<p>Materiais profissionais publicados com autorização e respeito ao sigilo.</p>',
            ],
            'contact' => [
                'excerpt' => 'Formas de contato e atendimento do escritório.',
            ],
            'mentions-legales' => [
                'title' => 'Aviso legal',
                'excerpt' => 'Informações legais e condições de uso do site.',
                'hero_title' => 'Aviso legal',
                'hero_subtitle' => 'Informações institucionais e condições de uso.',
                'content' => '<p>As informações deste site têm caráter institucional e informativo. O envio de uma mensagem não cria relação advogado-cliente nem substitui uma consulta jurídica.</p><p>Os dados enviados pelos formulários são utilizados exclusivamente para analisar e responder à solicitação de contato.</p>',
            ],
        ];

        foreach ($pages as $slug => $attributes) {
            DB::table('pages')->where('slug', $slug)->update($attributes + [
                'seo_title' => ($attributes['title'] ?? DB::table('pages')->where('slug', $slug)->value('title')).' — Marcos Túlio Advocacia',
                'seo_description' => $attributes['excerpt'] ?? DB::table('pages')->where('slug', $slug)->value('excerpt'),
                'updated_at' => $now,
            ]);
        }

        DB::table('oral_defenses')
            ->whereIn('title', [
                'Preparação de sustentação — conteúdo demonstrativo',
                'Definição da questão central da defesa',
            ])
            ->delete();

        DB::table('inquiries')->where('source', 'demo_seeder')->delete();
    }

    public function down(): void
    {
        DB::table('content_slots')->where('key', 'contact.office_hours')->delete();
    }
};
