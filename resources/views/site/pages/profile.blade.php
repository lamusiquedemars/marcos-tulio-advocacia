@extends('layouts.site', [
    'seoTitle' => $page->seo_title,
    'seoDescription' => $page->seo_description,
    'seoImage' => $page->heroImageUrl(),
])

@section('content')
    <x-site.hero
        variant="page"
        eyebrow="Advocacia · Ensino · Produção jurídica"
        :title="$page->hero_title ?? $page->title"
        :subtitle="$page->hero_subtitle ?? $page->excerpt"
        :image="$page->heroImageUrl()"
        :cta-url="route('contact')"
        cta-label="Formas de atendimento"
    />

    <x-site.breadcrumb :items="[['label' => 'Marcos Túlio']]" />

    <x-site.section
        title="Uma apresentação profissional em construção"
        intro="Esta versão utiliza somente as informações confirmadas no briefing. O percurso detalhado será completado após validação."
        heading-variant="accent"
    >
        <div class="split">
            <div class="video-placeholder">
                <div>
                    <span class="demo-tag">Retrato pendente</span>
                    <p>Imagem profissional a ser fornecida e autorizada.</p>
                </div>
            </div>
            <div class="stack stack--md prose">
                <h2>Defesa penal com preparação para cada etapa</h2>
                <p>Marcos Túlio atua na advocacia penal, com atendimento presencial em Cuiabá e possibilidade de acompanhamento remoto em todo o Brasil.</p>
                <p>Sua atuação inclui atenção especial à preparação da sustentação oral e à comunicação clara dos fundamentos da defesa.</p>
                <p>Não foram adicionados número de OAB, instituições de ensino, endereço profissional ou tempo de exercício sem confirmação.</p>
            </div>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Atuação, ensino e publicação"
        heading-variant="underline"
    >
        <div class="authority-grid">
            <article class="authority-card">
                <span class="practice-card__label">Atuação</span>
                <h3>Advocacia penal</h3>
                <p>Preparação da defesa desde situações urgentes até a atuação perante os tribunais.</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Ensino</span>
                <h3>Dez anos como professor</h3>
                <p>Experiência de dez anos no ensino do direito penal. Instituições e períodos aguardam confirmação.</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Livro</span>
                <h3><em>O Pacote Anticrime Comentado</em></h3>
                <p>Referências editoriais, edição e imagem da obra serão incluídas após validação.</p>
            </article>
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
