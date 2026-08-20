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
        eyebrow="Advocacia · Trajetória acadêmica · Produção jurídica"
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
            <div class="profile-bio">
                <article class="stack stack--md prose">
                    <span class="practice-card__label">Advogado responsável</span>
                    <h2>Marcos Túlio de Melo</h2>
                    <p>Advogado em Mato Grosso desde 2012, é mestre em História pela Universidade Federal de Mato Grosso (UFMT) e também cursou Economia na mesma instituição. Em 2008, obteve certificações básica e avançada em investimentos.</p>
                    <p>Foi docente por dez anos, com atuação em Direito Penal e Processo Penal no UNIVAG, em Várzea Grande. Ao longo de sua trajetória acadêmica, ministrou mais de 2.000 aulas para mais de 4.000 alunos, em mais de 100 turmas.</p>
                    <p>Em 2020, lançou o livro <em>O Pacote Anticrime Comentado</em>. É também autor do curso Oratória Jurídica, com mais de 400 unidades comercializadas em todo o Brasil.</p>
                    <p>Na advocacia penal, dedica especial atenção à preparação da defesa e à exposição clara de seus fundamentos, inclusive em sustentações orais perante os tribunais. Fora da atividade profissional, cultiva interesses por cães da raça Dobermann, boxe, automóveis e whisky.</p>
                </article>

                @if ($marcosBioImage)
                    <figure class="profile-bio__portrait">
                        <img
                            src="{{ $marcosBioImage->url() }}"
                            alt="{{ $marcosBioImage->alt_text ?: 'Marcos Túlio de Melo' }}"
                            width="{{ $marcosBioImage->width }}"
                            height="{{ $marcosBioImage->height }}"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                @endif
            </div>

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
