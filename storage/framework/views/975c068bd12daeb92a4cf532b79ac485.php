<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php
        $seo = \App\Support\Seo::make($settings, [
            'title' => $seoTitle ?? null,
            'description' => $seoDescription ?? null,
            'image' => $seoImage ?? null,
            'type' => $seoType ?? null,
            'canonical' => $canonical ?? null,
        ]);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($seo['title']); ?></title>
    <meta name="description" content="<?php echo e($seo['description']); ?>">
    <meta name="robots" content="<?php echo e($seo['robots']); ?>">
    <link rel="canonical" href="<?php echo e($seo['canonical']); ?>">

    <meta property="og:site_name" content="<?php echo e($seo['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($seo['title']); ?>">
    <meta property="og:description" content="<?php echo e($seo['description']); ?>">
    <meta property="og:type" content="<?php echo e($seo['type']); ?>">
    <meta property="og:url" content="<?php echo e($seo['canonical']); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo['image']): ?>
        <meta property="og:image" content="<?php echo e($seo['image']); ?>">
        <meta name="twitter:card" content="summary_large_image">
    <?php else: ?>
        <meta name="twitter:card" content="summary">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <meta name="twitter:title" content="<?php echo e($seo['title']); ?>">
    <meta name="twitter:description" content="<?php echo e($seo['description']); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo['image']): ?>
        <meta name="twitter:image" content="<?php echo e($seo['image']); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->faviconUrl()): ?>
        <link rel="icon" href="<?php echo e(\App\Support\Seo::absoluteUrl($settings->faviconUrl())); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="site-shell theme-<?php echo e(config('maracuja.theme', 'default')); ?>">
    <header class="site-header container" data-nav>
        <a class="site-brand" href="<?php echo e(route('home')); ?>">
            <span class="site-brand__mark">M</span>
            <span>
                <strong><?php echo e($settings->site_name); ?></strong>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->baseline): ?>
                    <small><?php echo e($settings->baseline); ?></small>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </span>
        </a>

        <button class="btn btn--secondary nav-toggle" data-nav-toggle type="button">
            Menu
        </button>

        <nav class="site-nav" data-nav-menu aria-label="Navegação principal">
            <a href="<?php echo e(route('home')); ?>">Início</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('news')): ?>
                <a href="<?php echo e(route('news.index')); ?>">Actualités</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('articles')): ?>
                <a href="<?php echo e(route('articles.index')); ?>"><?php echo e(\App\Support\ContentSlots::value('articles.public_label', 'Articles')); ?></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('events')): ?>
                <a href="<?php echo e(route('events.index')); ?>"><?php echo e(\App\Support\ContentSlots::value('events.public_label', 'Événements')); ?></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('pages')): ?>
                <a href="<?php echo e(route('pages.show', 'services')); ?>">Atuação Penal</a>
                <a href="<?php echo e(route('pages.show', 'sustentacoes-e-defesas')); ?>">Sustentações</a>
                <a href="<?php echo e(route('pages.show', 'marcos-tulio')); ?>">Marcos Túlio</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('contact_form')): ?>
                <a href="<?php echo e(route('contact')); ?>">Atendimento</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <a href="/admin">Admin</a>
        </nav>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="site-footer container">
        <p>&copy; <?php echo e(now()->year); ?> <?php echo e($settings->site_name); ?></p>
        <p><strong>Site de demonstração:</strong> identidade, dados e conteúdos fictícios, realizado por Maracuja Digital.</p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->contact_email): ?>
            <a href="mailto:<?php echo e($settings->contact_email); ?>"><?php echo e($settings->contact_email); ?></a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\Modules::enabled('pages')): ?>
            <a href="<?php echo e(route('pages.show', 'mentions-legales')); ?>">Aviso legal</a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </footer>

    <button class="btn btn--primary back-to-top" type="button" data-back-to-top hidden aria-label="Voltar ao topo">
        <span class="back-to-top__icon" aria-hidden="true">↑</span>
    </button>
</body>
</html>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/layouts/site.blade.php ENDPATH**/ ?>