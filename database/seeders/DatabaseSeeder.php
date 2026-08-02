<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Appointments\Enums\AppointmentMode;
use App\Modules\Appointments\Enums\AppointmentProvider;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\ContentSlots\Models\ContentSlot;
use App\Modules\Inquiries\Enums\InquiryModality;
use App\Modules\Inquiries\Enums\InquiryPhase;
use App\Modules\Inquiries\Enums\InquiryRequestType;
use App\Modules\Inquiries\Enums\InquiryStatus;
use App\Modules\Inquiries\Enums\InquiryUrgency;
use App\Modules\Inquiries\Models\Inquiry;
use App\Modules\OralDefenses\Enums\OralDefenseStatus;
use App\Modules\OralDefenses\Enums\OralDefenseType;
use App\Modules\OralDefenses\Models\OralDefense;
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
                'name' => 'Administração Demonstração',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
        }

        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'site_name' => 'Marcos Túlio Advocacia',
            'baseline' => 'Defesa penal em Cuiabá e em todo o Brasil',
            'default_seo_title' => 'Marcos Túlio Advocacia — Site de demonstração',
            'default_seo_description' => 'Demonstração fictícia de um site para advocacia criminal, realizada pela Maracuja Digital.',
            'contact_email' => 'contato-avocat@example.test',
            'phone' => '+55 (65) 0000-0000',
            'address' => 'Endereço fictício — Cuiabá, MT',
            'social_links' => [],
            'contact_form_send_admin_email' => false,
            'contact_form_send_confirmation_email' => false,
        ]);

        AppointmentSetting::query()->updateOrCreate(['id' => 1], [
            'is_enabled' => true,
            'provider' => AppointmentProvider::Fake,
            'mode' => AppointmentMode::AfterReview,
            'booking_url' => 'https://example.test/agendamento-demo',
            'timezone' => 'America/Cuiaba',
        ]);

        collect([
            [
                'key' => 'home.hero.cta_label',
                'label' => 'Ação principal da página inicial',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Falar sobre uma urgência',
                'help_text' => 'Conteúdo fictício a validar antes da produção.',
            ],
            [
                'key' => 'home.hero.secondary_cta_label',
                'label' => 'Ação secundária da página inicial',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Apresentar meu caso',
                'help_text' => 'Conteúdo fictício a validar antes da produção.',
            ],
            [
                'key' => 'home.intro.title',
                'label' => 'Título de introdução',
                'group' => 'Início',
                'type' => 'text',
                'value' => 'Atuação penal com preparação e presença',
                'help_text' => 'Conteúdo de demonstração.',
            ],
            [
                'key' => 'home.intro.text',
                'label' => 'Texto de introdução',
                'group' => 'Início',
                'type' => 'textarea',
                'value' => 'Uma base inicial para apresentar a atuação, as sustentações e os caminhos de atendimento.',
                'help_text' => 'Conteúdo de demonstração.',
            ],
            [
                'key' => 'office.collaborator.name',
                'label' => 'Nome do advogado colaborador',
                'group' => 'O Escritório',
                'type' => 'text',
                'value' => null,
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
                'value' => null,
                'help_text' => 'Breve apresentação profissional, sem sugerir sociedade.',
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
                'excerpt' => 'Site fictício de demonstração realizado pela Maracuja Digital.',
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
                'content' => '<p>Conteúdo inicial de demonstração, a ser desenvolvido e validado.</p>',
            ],
            [
                'slug' => 'sustentacoes-e-defesas',
                'title' => 'Sustentações e Defesas',
                'template' => 'oral-arguments',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Seleção profissional de sustentações e intervenções.',
                'hero_title' => 'Sustentações e Defesas',
                'hero_subtitle' => 'Estrutura provisória, sem casos reais nem promessas de resultado.',
                'content' => '<p>As mídias e defesas autorizadas serão adicionadas em um próximo lote.</p>',
            ],
            [
                'slug' => 'marcos-tulio',
                'title' => 'O Escritório',
                'template' => 'profile',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Advogado em Mato Grosso desde 2012, professor, mestre em História e autor.',
                'hero_title' => 'O Escritório',
                'hero_subtitle' => 'Advocacia penal, ensino e comunicação jurídica.',
                'content' => '<p>Advogado em Mato Grosso desde 2012, mestre em História pela UFMT, professor e autor de O Pacote Anticrime Comentado.</p>',
            ],
            [
                'slug' => 'contact',
                'title' => 'Atendimento e Contato',
                'template' => 'contact',
                'type' => Page::TYPE_SYSTEM,
                'excerpt' => 'Contato de demonstração, sem envio de email real.',
                'hero_title' => 'Atendimento e Contato',
                'hero_subtitle' => 'Em uma urgência, o contato humano deve permanecer direto.',
                'content' => null,
            ],
            [
                'slug' => 'mentions-legales',
                'title' => 'Aviso legal e demonstração',
                'template' => 'default',
                'type' => Page::TYPE_TEXT,
                'excerpt' => 'Informações sobre esta demonstração.',
                'hero_title' => 'Site de demonstração',
                'hero_subtitle' => 'Projeto fictício realizado pela Maracuja Digital.',
                'content' => '<p>Este site é uma demonstração comercial realizada pela Maracuja Digital. A identidade, os contatos, o endereço e os conteúdos apresentados são fictícios ou provisórios. Este site não presta aconselhamento jurídico e não recebe casos reais.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page + [
                'seo_title' => $page['title'].' — Demonstração',
                'seo_description' => $page['excerpt'],
                'is_published' => true,
                'published_at' => now(),
            ]);
        }

        OralDefense::query()->updateOrCreate([
            'title' => 'Preparação de sustentação — conteúdo demonstrativo',
        ], [
            'type' => OralDefenseType::Video,
            'context' => 'Registro fictício aguardando um vídeo expressamente autorizado para publicação.',
            'status' => OralDefenseStatus::Draft,
            'is_featured' => true,
            'position' => 10,
        ]);

        OralDefense::query()->updateOrCreate([
            'title' => 'Definição da questão central da defesa',
        ], [
            'type' => OralDefenseType::Defense,
            'context' => 'Exemplo inteiramente fictício criado apenas para demonstrar a estrutura editorial.',
            'initial_situation' => 'Situação hipotética, sem pessoa, processo ou resultado real.',
            'legal_question' => 'Identificação do ponto jurídico que precisava ser apresentado com clareza.',
            'strategy' => 'Organização dos argumentos e seleção dos elementos estritamente necessários à exposição.',
            'intervention' => 'Preparação de uma apresentação objetiva, respeitando os limites éticos e a confidencialidade.',
            'is_anonymized' => true,
            'status' => OralDefenseStatus::Published,
            'is_featured' => false,
            'position' => 20,
            'published_at' => now(),
        ]);

        Inquiry::query()->updateOrCreate([
            'email' => 'solicitante-ficticio@example.test',
            'source' => 'demo_seeder',
        ], [
            'name' => 'Solicitante Fictício',
            'phone' => '+55 (65) 00000-0000',
            'subject' => 'Apresentação de situação',
            'request_type' => InquiryRequestType::Analysis,
            'urgency' => InquiryUrgency::UpcomingDeadline,
            'phase' => InquiryPhase::Investigation,
            'deadline' => now()->addDays(10)->toDateString(),
            'location' => 'Cuiabá, MT — dado fictício',
            'modality' => InquiryModality::Remote,
            'message' => 'Resumo inteiramente fictício para demonstrar o acompanhamento administrativo.',
            'consent_at' => now(),
            'status' => InquiryStatus::New,
            'internal_notes' => 'Demonstração: não entrar em contato.',
        ]);
    }
}
