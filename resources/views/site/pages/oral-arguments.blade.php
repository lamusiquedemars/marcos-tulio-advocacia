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
        title="Seleção profissional"
        intro="Somente materiais autorizados e exemplos devidamente anonimizados podem ser publicados nesta página."
        heading-variant="accent"
    >
        @if ($featuredVideo ?? null)
            <article class="featured-defense split">
                <div class="video-placeholder">
                    @if ($featuredVideo->video_media_id)
                        <video controls preload="metadata" @if ($featuredVideo->thumbnailMedia) poster="{{ $featuredVideo->thumbnailMedia->publicPath() }}" @endif>
                            <source src="{{ $featuredVideo->videoSource() }}" type="{{ $featuredVideo->videoMedia->mime_type }}">
                            Seu navegador não consegue reproduzir este vídeo.
                        </video>
                    @else
                        <div>
                            <span class="demo-tag">Vídeo externo</span>
                            <a class="button button--primary" href="{{ $featuredVideo->videoSource() }}" target="_blank" rel="noopener noreferrer">
                                Assistir ao vídeo
                            </a>
                        </div>
                    @endif
                </div>
                <div class="stack stack--md">
                    <span class="section-kicker">Vídeo principal</span>
                    <h2>{{ $featuredVideo->title }}</h2>
                    @if ($featuredVideo->context)
                        <p>{{ $featuredVideo->context }}</p>
                    @endif
                    <p>Este material apresenta uma atuação profissional sem promessa de resultado.</p>
                </div>
            </article>
        @else
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
        @endif

        @if (($secondaryVideos ?? collect())->isNotEmpty())
            <div class="defense-selection">
                @foreach ($secondaryVideos as $video)
                    <article class="authority-card">
                        <span class="section-kicker">Sustentação</span>
                        <h3>{{ $video->title }}</h3>
                        @if ($video->context)<p>{{ $video->context }}</p>@endif
                        <a href="{{ $video->videoSource() }}" @if (! $video->video_media_id) target="_blank" rel="noopener noreferrer" @endif>Assistir ao vídeo</a>
                    </article>
                @endforeach
            </div>
        @endif
    </x-site.section>

    <x-site.section
        variant="muted"
        title="Exemplos de preparação da defesa"
        intro="A estrutura protege a confidencialidade e concentra a atenção no trabalho realizado."
        heading-variant="underline"
    >
        @forelse (($defenseExamples ?? collect()) as $defense)
            <article class="defense-case stack stack--md">
                <span class="demo-tag">Exemplo fictício e anonimizado</span>
                <h3>{{ $defense->title }}</h3>
                @if ($defense->context)<p>{{ $defense->context }}</p>@endif
                <dl class="defense-case__details">
                    <div><dt>Situação inicial</dt><dd>{{ $defense->initial_situation }}</dd></div>
                    <div><dt>Questão jurídica</dt><dd>{{ $defense->legal_question }}</dd></div>
                    <div><dt>Estratégia</dt><dd>{{ $defense->strategy }}</dd></div>
                    <div><dt>Intervenção</dt><dd>{{ $defense->intervention }}</dd></div>
                </dl>
            </article>
        @empty
            <div class="process-grid">
                <article class="process-step"><span class="process-step__number">01</span><h3>Situação inicial</h3><p>Contexto geral sem elementos identificadores.</p></article>
                <article class="process-step"><span class="process-step__number">02</span><h3>Questão e estratégia</h3><p>Explicação objetiva da preparação da defesa.</p></article>
                <article class="process-step"><span class="process-step__number">03</span><h3>Intervenção realizada</h3><p>Descrição do trabalho sem promessa de resultado.</p></article>
            </div>
        @endforelse
    </x-site.section>

    <x-site.section>
        <div class="confidentiality-note">
            <strong>Importante:</strong> esta demonstração não contém casos reais. A publicação futura dependerá de autorização, anonimização e revisão.
        </div>
    </x-site.section>
@endsection
