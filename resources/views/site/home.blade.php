@extends('layouts.site', [
    'seoTitle' => $homePage?->seo_title,
    'seoDescription' => $homePage?->seo_description,
])

@php
    $analysisUrl = $contactUrl ? route('contact', ['tipo' => 'analise']) : null;
    $consultationUrl = $contactUrl ? route('contact', ['tipo' => 'consulta']) : null;
@endphp

@section('content')
    <x-site.hero
        variant="home"
        eyebrow="Em Cuiabá · atuação em todo o Brasil"
        :title="$homePage?->hero_title ?? 'Marcos Túlio de Melo, advogado criminalista'"
        :subtitle="$homePage?->hero_subtitle ?? 'Defesa penal com atuação estratégica, sigilo profissional e atendimento presencial ou remoto.'"
        :image="$homePage?->heroImageUrl() ?? asset('images/marcos-tulio-home.jpg')"
        cta-url="#atendimento"
        cta-label="Escolher forma de atendimento"
    />

    <div class="home-divider" aria-hidden="true"></div>

    @if ($homeNotice)
        <div class="container notice-wrap">
            <x-site.notice :notice="$homeNotice" />
        </div>
    @endif

    <x-site.section
        variant="muted"
        title="Advocacia, docência e produção jurídica"
        intro="Marcos Túlio de Melo reúne atuação na advocacia criminal, experiência docente e produção jurídica. A preparação e a apresentação oral da defesa ocupam lugar central em seu trabalho."
        heading-variant="underline"
    >
        <div class="authority-grid">
            <article class="authority-card">
                <span class="practice-card__label">Advocacia</span>
                <h3>Defesa penal</h3>
                <p>Atuação desde [ANO] em [PRINCIPAIS ÁREAS DA ADVOCACIA CRIMINAL].</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Docência</span>
                <h3>Direito penal</h3>
                <p>Professor desde [ANO], com experiência em [INSTITUIÇÃO E DISCIPLINAS A CONFIRMAR].</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Autoria</span>
                <h3>Produção jurídica</h3>
                <p>Autor de <em>O Pacote Anticrime Comentado</em>. [EDITORA, EDIÇÃO E ANO A CONFIRMAR].</p>
            </article>
        </div>

        <div class="cluster section-action">
            <x-site.button :href="route('pages.show', 'marcos-tulio')" variant="secondary">Conhecer Marcos Túlio</x-site.button>
        </div>
    </x-site.section>

    <x-site.section
        id="atendimento"
        title="Como podemos orientar o primeiro contato"
        intro="Escolha entre contato imediato, apresentação inicial da situação ou solicitação de consulta."
        heading-variant="accent"
    >
        <div class="pathway-grid">
            <article class="pathway-card pathway-card--urgent">
                <span class="pathway-card__label">01 · Urgência</span>
                <h2>Preciso de contato imediato</h2>
                <p>Para prisão, busca e apreensão, intimação próxima ou outra situação que não pode esperar.</p>
                <x-site.button :href="config('maracuja.law_firm.whatsapp_url')">Abrir WhatsApp</x-site.button>
            </article>

            <article class="pathway-card pathway-card--analysis">
                <span class="pathway-card__label">02 · Análise inicial</span>
                <h2>Quero apresentar uma situação</h2>
                <p>Envie um resumo inicial pelo formulário para organizar o primeiro contato.</p>
                @if ($analysisUrl)
                    <x-site.button :href="$analysisUrl" variant="secondary">Preencher o formulário</x-site.button>
                @endif
            </article>

            <article class="pathway-card">
                <span class="pathway-card__label">03 · Consulta</span>
                <h2>Quero solicitar atendimento</h2>
                <p>Solicite uma consulta presencial ou remota, sujeita à análise e confirmação.</p>
                @if ($consultationUrl)
                    <x-site.button :href="$consultationUrl" variant="secondary">Solicitar consulta</x-site.button>
                @endif
            </article>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Atuação penal"
        intro="Conheça as áreas em que concentro minha atuação na defesa penal."
        heading-variant="underline"
    >
        <div class="practice-grid">
            <article class="practice-card">
                <span class="practice-card__label">Atuação imediata</span>
                <h3>Prisão, busca e apreensão</h3>
                <p>Orientação e defesa desde os primeiros atos da persecução penal.</p>
            </article>
            <article class="practice-card">
                <span class="practice-card__label">Acompanhamento</span>
                <h3>Investigação e processo penal</h3>
                <p>Preparação técnica para depoimentos, audiências e demais fases do processo.</p>
            </article>
            <article class="practice-card">
                <span class="practice-card__label">Tribunais</span>
                <h3>Recursos e habeas corpus</h3>
                <p>Análise da medida adequada e apresentação da defesa perante os tribunais.</p>
            </article>
        </div>

        <div class="cluster section-action">
            <x-site.button :href="route('pages.show', 'services')" variant="secondary">Conhecer a atuação penal</x-site.button>
        </div>
    </x-site.section>

    <x-site.section
        title="Sustentação oral: preparação e presença"
        intro="Veja como preparo e apresento os fundamentos da defesa perante os tribunais."
        heading-variant="accent"
    >
        <div class="split">
            <div class="video-placeholder">
                <div>
                    <span class="demo-tag">Vídeo de demonstração pendente</span>
                    <p>A sustentação principal será inserida após seleção e autorização.</p>
                </div>
            </div>
            <div class="stack stack--md">
                <h2>Uma defesa compreensível, fundamentada e preparada para o julgamento</h2>
                <p>Os materiais publicados preservam a confidencialidade e não representam promessa de resultado.</p>
                <x-site.button :href="route('pages.show', 'sustentacoes-e-defesas')" variant="secondary">Conhecer exemplos de sustentações</x-site.button>
            </div>
        </div>
    </x-site.section>

    @if ($galleryImages->isNotEmpty())
        <x-site.section
            :title="$gallery?->title ?? 'Imagens'"
            :intro="$gallery?->intro ?? 'Seleção de imagens autorizadas para apresentação profissional.'"
            heading-variant="decorated"
        >
            <x-site.gallery
                :images="$galleryImages"
                :layout="config('maracuja.gallery.layout')"
                :lightbox="config('maracuja.gallery.lightbox')"
            />
        </x-site.section>
    @endif

    @if ($newsPosts->isNotEmpty())
        <x-site.section
            variant="surface"
            title="Atualizações"
            intro="Conteúdos e informações publicados pelo escritório."
            heading-variant="accent"
        >
            <x-site.grid columns="3">
                @foreach ($newsPosts as $post)
                    <x-site.card :title="$post->title" :url="$post->hasDetailPage() ? route('news.show', $post->slug) : null">
                        {{ $post->excerpt }}
                    </x-site.card>
                @endforeach
            </x-site.grid>
        </x-site.section>
    @endif

    <x-site.section
        title="Como funciona o atendimento"
        intro="Cada situação exige uma análise própria. O percurso abaixo será detalhado com o escritório."
        heading-variant="accent"
    >
        <div class="process-grid">
            <article class="process-step">
                <span class="process-step__number">01</span>
                <h3>Contato inicial</h3>
                <p>[DESCREVER OS CANAIS E A FORMA DE RECEPÇÃO DO PRIMEIRO CONTATO.]</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">02</span>
                <h3>Análise da situação</h3>
                <p>[DESCREVER COMO A SOLICITAÇÃO É ANALISADA E QUAIS INFORMAÇÕES SÃO NECESSÁRIAS.]</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">03</span>
                <h3>Definição do atendimento</h3>
                <p>[DESCREVER COMO SÃO DEFINIDOS A CONSULTA E OS PRÓXIMOS PASSOS.]</p>
            </article>
        </div>
    </x-site.section>
@endsection
