<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\ContentSlots\Models\ContentSlot;
use App\Modules\Pages\Models\Page;
use App\Modules\SiteSettings\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->isProduction()) {
            User::query()->updateOrCreate([
                'email' => 'admin@avocat.test',
            ], [
                'name' => 'Administração',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
        }

        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'site_name' => 'Marcos Túlio Advocacia',
            'baseline' => 'Defesa penal em Cuiabá e em todo o Brasil',
            'default_seo_title' => 'Marcos Túlio Advocacia — Advocacia criminal',
            'default_seo_description' => 'Advocacia criminal em Cuiabá, com atendimento presencial e remoto em todo o Brasil.',
            'contact_email' => 'marcostulioadvocacia@hotmail.com',
            'phone' => '+55 (65) 99283-0446',
            'address' => 'Endereço completo em Cuiabá, MT',
            'social_links' => [],
            'contact_form_send_admin_email' => false,
            'contact_form_send_confirmation_email' => false,
        ]);

        AppointmentSetting::query()->updateOrCreate(['id' => 1], [
            'is_enabled' => false,
            'provider' => AppointmentProvider::Brevo,
            'mode' => AppointmentMode::AfterReview,
            'booking_url' => null,
            'timezone' => 'America/Cuiaba',
        ]);

        collect([
            [
                'key' => 'home.hero.cta_label',
                'label' => 'Ação principal da página inicial',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Falar sobre uma urgência',
                'help_text' => 'Texto do botão principal da página inicial.',
            ],
            [
                'key' => 'home.hero.secondary_cta_label',
                'label' => 'Ação secundária da página inicial',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Apresentar meu caso',
                'help_text' => 'Texto do botão secundário da página inicial.',
            ],
            [
                'key' => 'home.intro.title',
                'label' => 'Título de introdução',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Atuação penal com preparação e presença',
                'help_text' => 'Título da introdução da página inicial.',
            ],
            [
                'key' => 'home.intro.text',
                'label' => 'Texto de introdução',
                'group' => 'Início',
                'type' => 'textarea',
                'value' => 'Uma base inicial para apresentar a atuação, as sustentações e os caminhos de atendimento.',
                'help_text' => 'Breve apresentação da atuação do escritório.',
            ],
            [
                'key' => 'office.collaborator.name',
                'label' => 'Nome do advogado colaborador',
                'group' => 'O Escritório',
                'type' => 'text',
                'value' => 'Luis Eduardo Oliveira Miranda',
                'help_text' => 'Deixe vazio para ocultar a apresentação do colaborador no site.',
            ],
            [
                'key' => 'office.collaborator.role',
                'label' => 'Função do advogado colaborador',
                'group' => 'O Escritório',
                'type' => 'text',
                'value' => 'Advogado colaborador',
                'help_text' => 'Não use “sócio” ou “associado” se esse não for o vínculo real.',
            ],
            [
                'key' => 'office.collaborator.bio',
                'label' => 'Apresentação do advogado colaborador',
                'group' => 'O Escritório',
                'type' => 'textarea',
                'value' => 'Inscrito na OAB/MT sob o nº 10.394, Luis Eduardo Oliveira Miranda atua na advocacia criminal desde 2008 e mantém, há alguns anos, uma colaboração profissional com Marcos Túlio em casos da área penal.',
                'help_text' => 'Breve apresentação profissional, sem sugerir sociedade.',
            ],
            [
                'key' => 'contact.office_hours',
                'label' => 'Horários de atendimento',
                'group' => 'Contato',
                'type' => 'text',
                'value' => 'Segunda a sexta, mediante agendamento.',
                'help_text' => 'Horários exibidos na seção “Onde nos encontrar” da página de contato.',
            ],
        ])->each(fn (array $slot) => ContentSlot::query()->updateOrCreate(
            ['key' => $slot['key']],
            $slot + ['is_locked' => true],
        ));

        $pages = [
            [
                'slug' => 'accueil',
                'title' => 'Início',
                'template' => 'landing',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Advocacia criminal em Cuiabá, com atendimento presencial e remoto em todo o Brasil.',
                'hero_title' => 'Marcos Túlio de Melo, advogado criminalista',
                'hero_subtitle' => 'Defesa penal com atuação estratégica, sigilo profissional e atendimento presencial ou remoto.',
                'content' => null,
            ],
            [
                'slug' => 'services',
                'title' => 'Atuação Penal',
                'template' => 'criminal-practice',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Situações em que o escritório pode atuar.',
                'hero_title' => 'Atuação Penal',
                'hero_subtitle' => 'Prisão, investigação, processo penal, recursos e consultoria preventiva.',
                'content' => '<p>Atuação técnica e estratégica em diferentes etapas da defesa penal.</p>',
            ],
            [
                'slug' => 'sustentacoes-e-defesas',
                'title' => 'Sustentações e Defesas',
                'template' => 'oral-arguments',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Seleção profissional de sustentações e intervenções.',
                'hero_title' => 'Sustentações e Defesas',
                'hero_subtitle' => 'Seleção de sustentações orais e intervenções profissionais autorizadas.',
                'content' => '<p>Materiais profissionais publicados com autorização e respeito ao sigilo.</p>',
            ],
            [
                'slug' => 'marcos-tulio',
                'title' => 'O Escritório',
                'template' => 'profile',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Advogado em Mato Grosso desde 2012, mestre em História, autor e ex-docente universitário.',
                'hero_title' => 'O Escritório',
                'hero_subtitle' => 'Advocacia penal, trajetória acadêmica e comunicação jurídica.',
                'content' => '<p>Advogado em Mato Grosso desde 2012, mestre em História pela UFMT, autor de O Pacote Anticrime Comentado e ex-docente de Direito Penal e Processo Penal no UNIVAG.</p>',
            ],
            [
                'slug' => 'contact',
                'title' => 'Atendimento e Contato',
                'template' => 'contact',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Formas de contato e atendimento do escritório.',
                'hero_title' => 'Atendimento e Contato',
                'hero_subtitle' => 'Em uma urgência, o contato humano deve permanecer direto.',
                'content' => null,
            ],
            [
                'slug' => 'mentions-legales',
                'title' => 'Aviso legal',
                'template' => 'default',
                'type' => Page::TYPE_TEXT,
                'excerpt' => 'Informações legais e condições de uso do site.',
                'hero_title' => 'Aviso legal',
                'hero_subtitle' => 'Informações institucionais e condições de uso.',
                'content' => '<p>As informações deste site têm caráter institucional e informativo. O envio de uma mensagem não cria relação advogado-cliente nem substitui uma consulta jurídica.</p><p>Os dados enviados pelos formulários são utilizados exclusivamente para analisar e responder à solicitação de contato.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page + [
                'seo_title' => $page['title'].' — Marcos Túlio Advocacia',
                'seo_description' => $page['excerpt'],
                'is_published' => true,
                'published_at' => now(),
            ]);
        }

    }
}
