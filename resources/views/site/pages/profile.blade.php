@extends('layouts.site', [
    'seoTitle' => $page->seo_title,
    'seoDescription' => $page->seo_description,
    'seoImage' => $page->heroImageUrl(),
])

@section('content')
    @php
        $collaboratorName = \App\Support\ContentSlots::value('office.collaborator.name');
        $collaboratorRole = \App\Support\ContentSlots::value('office.collaborator.role', 'Advogado colaborador');
        $collaboratorBio = \App\Support\ContentSlots::value('office.collaborator.bio');
    @endphp

    <x-site.hero
        variant="page"
        eyebrow="Advocacia · Ensino · Produção jurídica"
        :title="$page->hero_title ?? $page->title"
        :subtitle="$page->hero_subtitle ?? $page->excerpt"
        :image="$page->heroImageUrl()"
        :cta-url="route('contact')"
        cta-label="Formas de atendimento"
    />

    <x-site.breadcrumb :items="[['label' => 'O Escritório']]" />

    <x-site.section
        title="O Escritório"
        intro="Atuação em advocacia penal com preparação técnica, comunicação clara e colaboração profissional quando o caso exige."
        heading-variant="accent"
    >
        <div class="stack stack--xl">
            <article class="stack stack--md prose">
                <span class="practice-card__label">Advogado responsável</span>
                <h2>Marcos Túlio de Melo</h2>
                <p>Advogado em Mato Grosso desde 2012, é mestre em História pela Universidade Federal de Mato Grosso (UFMT) e também cursou Economia na mesma instituição. Em 2008, obteve certificações básica e avançada em investimentos.</p>
                <p>Na docência, ministrou mais de 2.000 aulas para mais de 4.000 alunos, em mais de 100 turmas, passando pelas áreas penal, processual, civil, empresarial, administrativa e de direitos humanos.</p>
                <p>Em 2020, lançou o livro <em>O Pacote Anticrime Comentado</em>. É também autor do curso Oratória Jurídica, com mais de 400 unidades comercializadas em todo o Brasil.</p>
                <p>Na advocacia penal, dedica especial atenção à preparação da defesa e à exposição clara de seus fundamentos, inclusive em sustentações orais perante os tribunais. Fora da atividade profissional, cultiva interesses por cães da raça Dobermann, boxe, automóveis e whisky.</p>
            </article>

            @if ($collaboratorName)
                <article class="stack stack--md prose">
                    <span class="practice-card__label">{{ $collaboratorRole }}</span>
                    <h2>{{ $collaboratorName }}</h2>
                    @if ($collaboratorBio)
                        <p>{{ $collaboratorBio }}</p>
                    @endif
                </article>
            @endif
        </div>
    </x-site.section>

    <x-site.section>
        <x-site.cta
            title="Conheça a atuação perante os tribunais"
            text="A seleção profissional de sustentações será publicada somente com os cuidados de autorização e confidencialidade."
            :href="route('pages.show', 'sustentacoes-e-defesas')"
            label="Sustentações e defesas"
            inline
        />
    </x-site.section>
@endsection
