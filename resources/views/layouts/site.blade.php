<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $seo = \App\Support\Seo::make($settings, [
            'title' => $seoTitle ?? null,
            'description' => $seoDescription ?? null,
            'image' => $seoImage ?? null,
            'type' => $seoType ?? null,
            'canonical' => $canonical ?? null,
        ]);
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="robots" content="{{ $seo['robots'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">

    <meta property="og:site_name" content="{{ $seo['site_name'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:type" content="{{ $seo['type'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    @if ($seo['image'])
        <meta property="og:image" content="{{ $seo['image'] }}">
        <meta name="twitter:card" content="summary_large_image">
    @else
        <meta name="twitter:card" content="summary">
    @endif
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    @if ($seo['image'])
        <meta name="twitter:image" content="{{ $seo['image'] }}">
    @endif

    @if ($settings->faviconUrl())
        <link rel="icon" href="{{ \App\Support\Seo::absoluteUrl($settings->faviconUrl()) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell theme-{{ config('maracuja.theme', 'default') }}">
    @if (config('maracuja.law_firm.demo'))
        <div class="demo-banner">
            <p class="container">
                Site de demonstração da <a href="https://maracujadigital.fr">Maracuja Digital</a>.
                Identidade, contatos e conteúdos fictícios.
            </p>
        </div>
    @endif

    <header class="site-header container" data-nav>
        <a class="site-brand" href="{{ route('home') }}">
            <span class="site-brand__mark" aria-hidden="true">MT</span>
            <span>
                <strong>{{ $settings->site_name }}</strong>
            </span>
        </a>

        <button class="btn btn--secondary nav-toggle" data-nav-toggle type="button" aria-label="Abrir menu de navegação">
            Menu
        </button>

        <nav class="site-nav" data-nav-menu aria-label="Navegação principal">
            @if (\App\Support\Modules::enabled('news'))
                <a href="{{ route('news.index') }}">Atualizações</a>
            @endif
            @if (\App\Support\Modules::enabled('articles'))
                <a href="{{ route('articles.index') }}">{{ \App\Support\ContentSlots::value('articles.public_label', 'Artigos') }}</a>
            @endif
            @if (\App\Support\Modules::enabled('events'))
                <a href="{{ route('events.index') }}">{{ \App\Support\ContentSlots::value('events.public_label', 'Eventos') }}</a>
            @endif
            @if (\App\Support\Modules::enabled('pages'))
                <a href="{{ route('pages.show', 'services') }}">Atuação Penal</a>
                <a href="{{ route('pages.show', 'sustentacoes-e-defesas') }}">Sustentações</a>
                <a href="{{ route('pages.show', 'marcos-tulio') }}">Marcos Túlio</a>
            @endif
            @if (\App\Support\Modules::enabled('contact_form'))
                <a href="{{ route('contact') }}">Atendimento</a>
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="site-footer__inner container">
            <div class="site-footer__identity">
                <a class="site-brand" href="{{ route('home') }}">
                    <span class="site-brand__mark" aria-hidden="true">MT</span>
                    <span>
                        <strong>{{ $settings->site_name }}</strong>
                        <small>Advocacia criminal</small>
                    </span>
                </a>
                <p>Atendimento presencial em Cuiabá e remoto em todo o Brasil.</p>
            </div>
            <div class="site-footer__notice">
                <p><strong>Site de demonstração</strong></p>
                <p>Identidade, contatos e conteúdos fictícios. Projeto realizado pela Maracuja Digital.</p>
            </div>
            <nav class="site-footer__links" aria-label="Links institucionais">
                @if ($settings->contact_email)
                    <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>
                @endif
                @if (\App\Support\Modules::enabled('pages'))
                    <a href="{{ route('pages.show', 'mentions-legales') }}">Aviso legal</a>
                @endif
                <a href="/admin" rel="nofollow">Administração</a>
            </nav>
        </div>
        <div class="site-footer__bottom container">
            <p>&copy; {{ now()->year }} {{ $settings->site_name }}</p>
            <p>Conteúdo informativo. Nenhum resultado é garantido.</p>
        </div>
    </footer>

    <button class="btn btn--primary back-to-top" type="button" data-back-to-top hidden aria-label="Voltar ao topo">
        <span class="back-to-top__icon" aria-hidden="true">↑</span>
    </button>

    @if (
        \App\Support\Modules::enabled('conversations')
        && \App\Modules\Conversations\Models\ConversationSetting::current()->is_enabled
    )
        @include('site.partials.conversation-widget')
    @endif
</body>
</html>
