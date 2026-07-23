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
        eyebrow="Advocacia criminal · Cuiabá e todo o Brasil"
        :title="$homePage?->hero_title ?? $settings->site_name"
        :subtitle="$homePage?->hero_subtitle ?? $settings->baseline"
        :image="$homePage?->heroImageUrl()"
        :cta-url="config('maracuja.law_firm.whatsapp_url')"
        cta-label="Falar sobre uma urgência"
        :secondary-cta-url="$analysisUrl"
        secondary-cta-label="Apresentar meu caso"
    />

    <div class="home-facts" aria-label="Informações de atendimento">
        <div class="container home-facts__inner">
            <p><span>Base</span><strong>Cuiabá, Mato Grosso</strong></p>
            <p><span>Alcance</span><strong>Atendimento em todo o Brasil</strong></p>
            <p><span>Formato</span><strong>Presencial e remoto</strong></p>
        </div>
    </div>

    @if ($homeNotice)
        <div class="container notice-wrap">
            <x-site.notice :notice="$homeNotice" />
        </div>
    @endif

    <x-site.section
        title="Como podemos orientar o primeiro contato"
        intro="Escolha o caminho mais adequado ao momento. Uma urgência nunca depende do preenchimento de um formulário."
        heading-variant="accent"
    >
        <div class="pathway-grid">
            <article class="pathway-card pathway-card--urgent">
                <span class="pathway-card__label">Resposta direta</span>
                <h2>Estou em uma situação urgente</h2>
                <p>Prisão, busca e apreensão, intimação próxima ou outra situação que exige contato humano imediato.</p>
                <x-site.button :href="config('maracuja.law_firm.whatsapp_url')">Abrir WhatsApp</x-site.button>
            </article>

            <article class="pathway-card pathway-card--analysis">
                <span class="pathway-card__label">Apresentação guiada</span>
                <h2>Preciso explicar meu caso</h2>
                <p>Envie somente um resumo inicial para que a solicitação possa ser organizada e avaliada.</p>
                @if ($analysisUrl)
                    <x-site.button :href="$analysisUrl" variant="secondary">Apresentar o caso</x-site.button>
                @endif
            </article>

            <article class="pathway-card">
                <span class="pathway-card__label">Consulta</span>
                <h2>Quero solicitar uma consulta</h2>
                <p>Atendimento presencial em Cuiabá ou remoto, conforme a disponibilidade a ser confirmada.</p>
                @if ($consultationUrl)
                    <x-site.button :href="$consultationUrl" variant="secondary">Solicitar consulta</x-site.button>
                @endif
            </article>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Atuação penal"
        intro="Uma apresentação inicial das situações atendidas, sem promessas de resultado e sem substituir uma análise jurídica."
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

        <div class="cluster">
            <x-site.button :href="route('pages.show', 'services')" variant="secondary">Conhecer a atuação penal</x-site.button>
        </div>
    </x-site.section>

    <x-site.section
        title="Sustentação oral: preparação e presença"
        intro="Uma seleção profissional mostrará, com autorização, como a defesa é apresentada perante os tribunais."
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
                <span class="section-kicker">Sustentações e defesas</span>
                <h2>Uma defesa compreensível, fundamentada e preparada para o julgamento</h2>
                <p>Nenhum caso, resultado ou dado de cliente será publicado sem autorização e anonimização adequadas.</p>
                <x-site.button :href="route('pages.show', 'sustentacoes-e-defesas')" variant="secondary">Ver a seleção profissional</x-site.button>
            </div>
        </div>
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Experiência que sustenta a defesa"
        intro="Informações profissionais conhecidas nesta fase, ainda sujeitas à validação dos detalhes editoriais e biográficos."
        heading-variant="underline"
    >
        <div class="authority-grid">
            <article class="authority-card">
                <span class="practice-card__label">Advocacia</span>
                <h3>Atuação penal</h3>
                <p>Defesa em Cuiabá e atendimento remoto em todo o Brasil.</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Ensino</span>
                <h3>Professor há dez anos</h3>
                <p>Experiência no ensino do direito penal, sem instituições inventadas nesta demonstração.</p>
            </article>
            <article class="authority-card">
                <span class="practice-card__label">Publicação</span>
                <h3><em>O Pacote Anticrime Comentado</em></h3>
                <p>Referências editoriais e imagem da obra serão adicionadas após confirmação.</p>
            </article>
        </div>

        <div class="cluster">
            <x-site.button :href="route('pages.show', 'marcos-tulio')" variant="secondary">Conhecer Marcos Túlio</x-site.button>
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
            intro="Conteúdos publicados pela administração."
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
        intro="Um processo inicial simples, inclusive para quem está fora de Cuiabá."
        heading-variant="accent"
    >
        <div class="process-grid">
            <article class="process-step">
                <span class="process-step__number">01</span>
                <h3>Primeiro contato</h3>
                <p>Urgência pelo WhatsApp ou apresentação resumida da situação.</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">02</span>
                <h3>Análise inicial</h3>
                <p>Confirmação do conflito de interesses e das informações necessárias.</p>
            </article>
            <article class="process-step">
                <span class="process-step__number">03</span>
                <h3>Próximo passo</h3>
                <p>Orientação sobre consulta presencial ou remota, quando aplicável.</p>
            </article>
        </div>
    </x-site.section>

    <x-site.section>
        <x-site.cta
            title="Precisa falar sobre uma situação penal?"
            text="Em uma urgência, use o contato direto. Para uma análise inicial, apresente apenas as informações essenciais."
            :href="$contactUrl"
            label="Ver formas de atendimento"
            variant="brand"
            inline
        />
    </x-site.section>
@endsection
