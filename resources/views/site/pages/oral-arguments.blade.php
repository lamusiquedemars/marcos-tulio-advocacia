@extends('layouts.site', [
    'seoTitle' => $page->seo_title,
    'seoDescription' => $page->seo_description,
    'seoImage' => $page->heroImageUrl(),
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Atuação perante os tribunais"
        :title="$page->hero_title ?? $page->title"
        :subtitle="$page->hero_subtitle ?? $page->excerpt"
        :image="$page->heroImageUrl()"
        :cta-url="route('contact', ['tipo' => 'analise'])"
        cta-label="Apresentar uma situação"
    />

    <x-site.breadcrumb :items="[['label' => 'Sustentações e Defesas']]" />

    <x-site.section
        title="Seleção profissional em preparação"
        intro="Esta página receberá apenas vídeos autorizados e exemplos de defesa devidamente anonimizados."
        heading-variant="accent"
    >
        <div class="split">
            <div class="video-placeholder">
                <div>
                    <span class="demo-tag">Demonstração</span>
                    <h2>Vídeo principal ainda não selecionado</h2>
                    <p>Nenhum vídeo real foi associado sem autorização.</p>
                </div>
            </div>
            <div class="stack stack--md">
                <span class="section-kicker">Sustentação oral</span>
                <h2>Clareza, síntese e domínio do processo</h2>
                <p>A sustentação oral é preparada a partir do estudo dos autos, da identificação da questão central e da forma mais clara de apresentá-la ao colegiado.</p>
                <p>O material publicado aqui não será usado para prometer resultados ou expor clientes.</p>
            </div>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Como os exemplos serão apresentados"
        intro="A estrutura protege a confidencialidade e concentra a atenção no trabalho realizado."
        heading-variant="underline"
    >
        <div class="process-grid">
            <article class="process-step">
                <span class="process-step__number">01</span>
                <h3>Situação inicial</h3>
                <p>Contexto geral sem nomes, números processuais ou elementos identificadores.</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">02</span>
                <h3>Questão e estratégia</h3>
                <p>Explicação objetiva da questão jurídica e da linha de preparação da defesa.</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">03</span>
                <h3>Intervenção realizada</h3>
                <p>Descrição do trabalho, sem promessa de resultado nem divulgação indevida.</p>
            </article>
        </div>
    </x-site.section>

    <x-site.section>
        <div class="confidentiality-note">
            <strong>Importante:</strong> esta demonstração não contém casos reais. A publicação futura dependerá de autorização, anonimização e revisão.
        </div>
    </x-site.section>
@endsection
