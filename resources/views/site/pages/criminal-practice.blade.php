@extends('layouts.site', [
    'seoTitle' => $page->seo_title,
    'seoDescription' => $page->seo_description,
    'seoImage' => $page->heroImageUrl(),
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Defesa criminal"
        :title="$page->hero_title ?? $page->title"
        :subtitle="$page->hero_subtitle ?? $page->excerpt"
        :image="$page->heroImageUrl()"
        :cta-url="config('maracuja.law_firm.whatsapp_url')"
        cta-label="Falar sobre uma urgência"
        :secondary-cta-url="route('contact', ['tipo' => 'analise'])"
        secondary-cta-label="Apresentar o caso"
    />

    <x-site.breadcrumb :items="[['label' => 'Atuação Penal']]" />

    <x-site.section
        title="Situações em que a defesa pode começar"
        intro="Cada situação exige análise própria. Os exemplos abaixo organizam o primeiro contato e não constituem aconselhamento jurídico."
        heading-variant="accent"
    >
        <ul class="practice-list practice-list--detailed">
            <li>
                <span class="practice-card__label">Urgência</span>
                <h2>Prisão, busca e apreensão</h2>
                <p>Contato imediato para compreender o ato realizado, identificar a autoridade responsável e orientar os próximos passos possíveis.</p>
            </li>
            <li>
                <span class="practice-card__label">Fase inicial</span>
                <h2>Investigação, intimação e depoimento</h2>
                <p>Acompanhamento antes e durante atos investigativos, com preparação adequada para a situação concreta.</p>
            </li>
            <li>
                <span class="practice-card__label">Acompanhamento</span>
                <h2>Processo penal</h2>
                <p>Estudo da acusação, organização da estratégia defensiva e atuação nas diferentes etapas processuais.</p>
            </li>
            <li>
                <span class="practice-card__label">Tribunais</span>
                <h2>Recursos e habeas corpus</h2>
                <p>Análise dos fundamentos e da medida processual adequada, incluindo preparação para julgamento e sustentação oral.</p>
            </li>
            <li>
                <span class="practice-card__label">Prevenção</span>
                <h2>Consultoria preventiva</h2>
                <p>Orientação para pessoas e organizações diante de riscos penais que precisam ser compreendidos antes de uma decisão.</p>
            </li>
        </ul>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Como escolher o primeiro caminho"
        heading-variant="underline"
    >
        <div class="pathway-grid">
            <article class="pathway-card pathway-card--urgent">
                <span class="pathway-card__label">Não pode esperar</span>
                <h3>Use o contato direto</h3>
                <p>Em caso de prisão, diligência em andamento ou prazo imediato, não preencha o formulário antes de pedir ajuda.</p>
                <x-site.button :href="config('maracuja.law_firm.whatsapp_url')">Abrir WhatsApp</x-site.button>
            </article>
            <article class="pathway-card pathway-card--analysis">
                <span class="pathway-card__label">Pode ser resumido</span>
                <h3>Apresente a situação</h3>
                <p>Informe apenas o contexto inicial, a fase geral e uma eventual data importante.</p>
                <x-site.button :href="route('contact', ['tipo' => 'analise'])" variant="secondary">Apresentar o caso</x-site.button>
            </article>
            <article class="pathway-card">
                <span class="pathway-card__label">Atendimento</span>
                <h3>Solicite uma consulta</h3>
                <p>A modalidade presencial ou remota será confirmada conforme a necessidade e a disponibilidade.</p>
                <x-site.button :href="route('contact', ['tipo' => 'consulta'])" variant="secondary">Solicitar consulta</x-site.button>
            </article>
        </div>
    </x-site.section>
@endsection
