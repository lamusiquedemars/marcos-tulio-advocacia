@extends('layouts.site', [
'seoTitle' => $homePage?->seo_title,
'seoDescription' => $homePage?->seo_description,
])

@section('content')
<x-site.hero
    variant="home"
    :title="$homePage?->hero_title ?? $settings->site_name"
    :subtitle="$homePage?->hero_subtitle ?? $settings->baseline"
    :image="$homePage?->heroImageUrl()"
    :cta-url="$contactUrl"
    cta-label="{{ \App\Support\ContentSlots::value('home.hero.cta_label', 'Falar sobre uma urgência') }}"
    :secondary-cta-url="$servicesUrl"
        secondary-cta-label="{{ \App\Support\ContentSlots::value('home.hero.secondary_cta_label', 'Conhecer a atuação') }}" />

@if ($homeNotice)
<div class="container notice-wrap">
    <x-site.notice :notice="$homeNotice" />
</div>
@endif

<x-site.section
    :title="\App\Support\ContentSlots::value('home.intro.title', 'Atuação penal com preparação e presença')"
    :intro="\App\Support\ContentSlots::value('home.intro.text', 'Orientação inicial clara para situações urgentes ou casos que precisam ser analisados.')"
    heading-variant="accent">
    <x-site.grid columns="3">
        <x-site.feature-card title="Urgências penais" icon="01" data-reveal>
            {{ \App\Support\ContentSlots::value('home.offer.essence.text', 'Contato humano direto para situações que não podem esperar.') }}
        </x-site.feature-card>
        <x-site.feature-card title="Defesa técnica" icon="02" data-reveal data-reveal-delay="120">
            {{ \App\Support\ContentSlots::value('home.offer.signature.text', 'Atuação em investigações, processos, recursos e habeas corpus.') }}
        </x-site.feature-card>
        <x-site.feature-card title="Sustentação oral" icon="03" data-reveal data-reveal-delay="240">
            {{ \App\Support\ContentSlots::value('home.offer.univers.text', 'Preparação cuidadosa da tese e apresentação perante os tribunais.') }}
        </x-site.feature-card>
    </x-site.grid>
</x-site.section>

<x-site.section
    variant="muted"
    :title="\App\Support\ContentSlots::value('home.admin.title', 'Experiência que sustenta a defesa')"
    :intro="\App\Support\ContentSlots::value('home.admin.intro', 'Advocacia, ensino e produção jurídica reunidos na preparação de cada atuação.')"
    heading-variant="underline">
    <x-site.grid columns="2-3">
        <x-site.quote author="Marcos Túlio" meta="Conteúdo de demonstração">
            {{ \App\Support\ContentSlots::value('home.admin.quote', 'A defesa começa com escuta, estudo e preparação.') }}
        </x-site.quote>

        <div class="stack stack--lg">
            <x-site.card title="Professor de direito penal" kicker="Ensino">
                {{ \App\Support\ContentSlots::value('home.admin.modules.text', 'Dez anos de ensino, informação ainda sujeita a validação profissional detalhada.') }}
            </x-site.card>
            <x-site.card title="Autor de obra jurídica" kicker="Publicação">
                {{ \App\Support\ContentSlots::value('home.admin.pages.text', 'Autor de O Pacote Anticrime Comentado; referências editoriais serão confirmadas.') }}
            </x-site.card>
        </div>
    </x-site.grid>
</x-site.section>

@if ($galleryImages->isNotEmpty())
<x-site.section
    :title="$gallery?->title ?? \App\Support\ContentSlots::value('gallery.title', 'Galerie')"
    :intro="$gallery?->intro ?? \App\Support\ContentSlots::value('gallery.intro', 'Le Media System gere alt, legende, credit, dimensions et lightbox.')"
    heading-variant="decorated">
    <x-site.gallery
        :images="$galleryImages"
        :layout="config('maracuja.gallery.layout')"
        :lightbox="config('maracuja.gallery.lightbox')" />
</x-site.section>
@endif

@if ($newsPosts->isNotEmpty())
<x-site.section
    variant="surface"
    :title="\App\Support\ContentSlots::value('home.news.title', 'Actualités démo')"
    :intro="\App\Support\ContentSlots::value('home.news.intro', 'Un module contenu récurrent pour animer le site.')"
    heading-variant="accent">
    <x-site.grid columns="3">
        @foreach ($newsPosts as $post)
        <x-site.card :title="$post->title" :url="$post->hasDetailPage() ? route('news.show', $post->slug) : null">
            {{ $post->excerpt }}
        </x-site.card>
        @endforeach
    </x-site.grid>
</x-site.section>
@endif

<x-site.section>
    <x-site.cta
        :title="\App\Support\ContentSlots::value('home.cta.title', 'Precisa explicar uma situação?')"
        :text="\App\Support\ContentSlots::value('home.cta.text', 'Envie apenas as informações iniciais necessárias. Não inclua documentos ou dados sensíveis nesta demonstração.')"
        :href="$contactUrl"
        :label="\App\Support\ContentSlots::value('home.cta.label', 'Solicitar atendimento')"
        variant="brand"
        inline />
</x-site.section>
@endsection
