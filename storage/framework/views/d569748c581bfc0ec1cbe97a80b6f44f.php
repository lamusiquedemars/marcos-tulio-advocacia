<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal7581f317093bf3292868869e04b36f91 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7581f317093bf3292868869e04b36f91 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.hero','data' => ['variant' => 'home','title' => $homePage?->hero_title ?? $settings->site_name,'subtitle' => $homePage?->hero_subtitle ?? $settings->baseline,'image' => $homePage?->heroImageUrl(),'ctaUrl' => $contactUrl,'ctaLabel' => ''.e(\App\Support\ContentSlots::value('home.hero.cta_label', 'Falar sobre uma urgência')).'','secondaryCtaUrl' => $servicesUrl,'secondaryCtaLabel' => ''.e(\App\Support\ContentSlots::value('home.hero.secondary_cta_label', 'Conhecer a atuação')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'home','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homePage?->hero_title ?? $settings->site_name),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homePage?->hero_subtitle ?? $settings->baseline),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homePage?->heroImageUrl()),'cta-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactUrl),'cta-label' => ''.e(\App\Support\ContentSlots::value('home.hero.cta_label', 'Falar sobre uma urgência')).'','secondary-cta-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($servicesUrl),'secondary-cta-label' => ''.e(\App\Support\ContentSlots::value('home.hero.secondary_cta_label', 'Conhecer a atuação')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7581f317093bf3292868869e04b36f91)): ?>
<?php $attributes = $__attributesOriginal7581f317093bf3292868869e04b36f91; ?>
<?php unset($__attributesOriginal7581f317093bf3292868869e04b36f91); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7581f317093bf3292868869e04b36f91)): ?>
<?php $component = $__componentOriginal7581f317093bf3292868869e04b36f91; ?>
<?php unset($__componentOriginal7581f317093bf3292868869e04b36f91); ?>
<?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($homeNotice): ?>
<div class="container notice-wrap">
    <?php if (isset($component)) { $__componentOriginalebb962a4428890120e2b343da3bab1a8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalebb962a4428890120e2b343da3bab1a8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.notice','data' => ['notice' => $homeNotice]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['notice' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($homeNotice)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalebb962a4428890120e2b343da3bab1a8)): ?>
<?php $attributes = $__attributesOriginalebb962a4428890120e2b343da3bab1a8; ?>
<?php unset($__attributesOriginalebb962a4428890120e2b343da3bab1a8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalebb962a4428890120e2b343da3bab1a8)): ?>
<?php $component = $__componentOriginalebb962a4428890120e2b343da3bab1a8; ?>
<?php unset($__componentOriginalebb962a4428890120e2b343da3bab1a8); ?>
<?php endif; ?>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['title' => \App\Support\ContentSlots::value('home.intro.title', 'Atuação penal com preparação e presença'),'intro' => \App\Support\ContentSlots::value('home.intro.text', 'Orientação inicial clara para situações urgentes ou casos que precisam ser analisados.'),'headingVariant' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.intro.title', 'Atuação penal com preparação e presença')),'intro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.intro.text', 'Orientação inicial clara para situações urgentes ou casos que precisam ser analisados.')),'heading-variant' => 'accent']); ?>
    <?php if (isset($component)) { $__componentOriginale7af5305188002b70961a0972a8dfcbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7af5305188002b70961a0972a8dfcbd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.grid','data' => ['columns' => '3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => '3']); ?>
        <?php if (isset($component)) { $__componentOriginal682de61ccb5fe167fdfa0adff473ed89 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.feature-card','data' => ['title' => 'Urgências penais','icon' => '01','dataReveal' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Urgências penais','icon' => '01','data-reveal' => true]); ?>
            <?php echo e(\App\Support\ContentSlots::value('home.offer.essence.text', 'Contato humano direto para situações que não podem esperar.')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $attributes = $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $component = $__componentOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal682de61ccb5fe167fdfa0adff473ed89 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.feature-card','data' => ['title' => 'Defesa técnica','icon' => '02','dataReveal' => true,'dataRevealDelay' => '120']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Defesa técnica','icon' => '02','data-reveal' => true,'data-reveal-delay' => '120']); ?>
            <?php echo e(\App\Support\ContentSlots::value('home.offer.signature.text', 'Atuação em investigações, processos, recursos e habeas corpus.')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $attributes = $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $component = $__componentOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal682de61ccb5fe167fdfa0adff473ed89 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.feature-card','data' => ['title' => 'Sustentação oral','icon' => '03','dataReveal' => true,'dataRevealDelay' => '240']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sustentação oral','icon' => '03','data-reveal' => true,'data-reveal-delay' => '240']); ?>
            <?php echo e(\App\Support\ContentSlots::value('home.offer.univers.text', 'Preparação cuidadosa da tese e apresentação perante os tribunais.')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $attributes = $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__attributesOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89)): ?>
<?php $component = $__componentOriginal682de61ccb5fe167fdfa0adff473ed89; ?>
<?php unset($__componentOriginal682de61ccb5fe167fdfa0adff473ed89); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $attributes = $__attributesOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__attributesOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $component = $__componentOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__componentOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $attributes = $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $component = $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['variant' => 'muted','title' => \App\Support\ContentSlots::value('home.admin.title', 'Experiência que sustenta a defesa'),'intro' => \App\Support\ContentSlots::value('home.admin.intro', 'Advocacia, ensino e produção jurídica reunidos na preparação de cada atuação.'),'headingVariant' => 'underline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'muted','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.admin.title', 'Experiência que sustenta a defesa')),'intro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.admin.intro', 'Advocacia, ensino e produção jurídica reunidos na preparação de cada atuação.')),'heading-variant' => 'underline']); ?>
    <?php if (isset($component)) { $__componentOriginale7af5305188002b70961a0972a8dfcbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7af5305188002b70961a0972a8dfcbd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.grid','data' => ['columns' => '2-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => '2-3']); ?>
        <?php if (isset($component)) { $__componentOriginaldeb81fd67a3e6393ea3be285cb2d4739 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldeb81fd67a3e6393ea3be285cb2d4739 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.quote','data' => ['author' => 'Marcos Túlio','meta' => 'Conteúdo de demonstração']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.quote'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['author' => 'Marcos Túlio','meta' => 'Conteúdo de demonstração']); ?>
            <?php echo e(\App\Support\ContentSlots::value('home.admin.quote', 'A defesa começa com escuta, estudo e preparação.')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldeb81fd67a3e6393ea3be285cb2d4739)): ?>
<?php $attributes = $__attributesOriginaldeb81fd67a3e6393ea3be285cb2d4739; ?>
<?php unset($__attributesOriginaldeb81fd67a3e6393ea3be285cb2d4739); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldeb81fd67a3e6393ea3be285cb2d4739)): ?>
<?php $component = $__componentOriginaldeb81fd67a3e6393ea3be285cb2d4739; ?>
<?php unset($__componentOriginaldeb81fd67a3e6393ea3be285cb2d4739); ?>
<?php endif; ?>

        <div class="stack stack--lg">
            <?php if (isset($component)) { $__componentOriginala9cfd707271e0a7566f86345bb80c382 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9cfd707271e0a7566f86345bb80c382 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => 'Professor de direito penal','kicker' => 'Ensino']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Professor de direito penal','kicker' => 'Ensino']); ?>
                <?php echo e(\App\Support\ContentSlots::value('home.admin.modules.text', 'Dez anos de ensino, informação ainda sujeita a validação profissional detalhada.')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $attributes = $__attributesOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__attributesOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $component = $__componentOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__componentOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginala9cfd707271e0a7566f86345bb80c382 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9cfd707271e0a7566f86345bb80c382 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => 'Autor de obra jurídica','kicker' => 'Publicação']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Autor de obra jurídica','kicker' => 'Publicação']); ?>
                <?php echo e(\App\Support\ContentSlots::value('home.admin.pages.text', 'Autor de O Pacote Anticrime Comentado; referências editoriais serão confirmadas.')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $attributes = $__attributesOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__attributesOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $component = $__componentOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__componentOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $attributes = $__attributesOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__attributesOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $component = $__componentOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__componentOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $attributes = $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $component = $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($galleryImages->isNotEmpty()): ?>
<?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['title' => $gallery?->title ?? \App\Support\ContentSlots::value('gallery.title', 'Galerie'),'intro' => $gallery?->intro ?? \App\Support\ContentSlots::value('gallery.intro', 'Le Media System gere alt, legende, credit, dimensions et lightbox.'),'headingVariant' => 'decorated']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($gallery?->title ?? \App\Support\ContentSlots::value('gallery.title', 'Galerie')),'intro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($gallery?->intro ?? \App\Support\ContentSlots::value('gallery.intro', 'Le Media System gere alt, legende, credit, dimensions et lightbox.')),'heading-variant' => 'decorated']); ?>
    <?php if (isset($component)) { $__componentOriginal8a4b56dfc9db248ae89268f609717344 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a4b56dfc9db248ae89268f609717344 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.gallery','data' => ['images' => $galleryImages,'layout' => config('maracuja.gallery.layout'),'lightbox' => config('maracuja.gallery.lightbox')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.gallery'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['images' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($galleryImages),'layout' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(config('maracuja.gallery.layout')),'lightbox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(config('maracuja.gallery.lightbox'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a4b56dfc9db248ae89268f609717344)): ?>
<?php $attributes = $__attributesOriginal8a4b56dfc9db248ae89268f609717344; ?>
<?php unset($__attributesOriginal8a4b56dfc9db248ae89268f609717344); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a4b56dfc9db248ae89268f609717344)): ?>
<?php $component = $__componentOriginal8a4b56dfc9db248ae89268f609717344; ?>
<?php unset($__componentOriginal8a4b56dfc9db248ae89268f609717344); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $attributes = $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $component = $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newsPosts->isNotEmpty()): ?>
<?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['variant' => 'surface','title' => \App\Support\ContentSlots::value('home.news.title', 'Actualités démo'),'intro' => \App\Support\ContentSlots::value('home.news.intro', 'Un module contenu récurrent pour animer le site.'),'headingVariant' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'surface','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.news.title', 'Actualités démo')),'intro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.news.intro', 'Un module contenu récurrent pour animer le site.')),'heading-variant' => 'accent']); ?>
    <?php if (isset($component)) { $__componentOriginale7af5305188002b70961a0972a8dfcbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7af5305188002b70961a0972a8dfcbd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.grid','data' => ['columns' => '3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => '3']); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $newsPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginala9cfd707271e0a7566f86345bb80c382 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9cfd707271e0a7566f86345bb80c382 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => $post->title,'url' => $post->hasDetailPage() ? route('news.show', $post->slug) : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->hasDetailPage() ? route('news.show', $post->slug) : null)]); ?>
            <?php echo e($post->excerpt); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $attributes = $__attributesOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__attributesOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9cfd707271e0a7566f86345bb80c382)): ?>
<?php $component = $__componentOriginala9cfd707271e0a7566f86345bb80c382; ?>
<?php unset($__componentOriginala9cfd707271e0a7566f86345bb80c382); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $attributes = $__attributesOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__attributesOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7af5305188002b70961a0972a8dfcbd)): ?>
<?php $component = $__componentOriginale7af5305188002b70961a0972a8dfcbd; ?>
<?php unset($__componentOriginale7af5305188002b70961a0972a8dfcbd); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $attributes = $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $component = $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal106c39dd228b3992904670768e42d9e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal106c39dd228b3992904670768e42d9e3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.cta','data' => ['title' => \App\Support\ContentSlots::value('home.cta.title', 'Precisa explicar uma situação?'),'text' => \App\Support\ContentSlots::value('home.cta.text', 'Envie apenas as informações iniciais necessárias. Não inclua documentos ou dados sensíveis nesta demonstração.'),'href' => $contactUrl,'label' => \App\Support\ContentSlots::value('home.cta.label', 'Solicitar atendimento'),'variant' => 'brand','inline' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.cta.title', 'Precisa explicar uma situação?')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.cta.text', 'Envie apenas as informações iniciais necessárias. Não inclua documentos ou dados sensíveis nesta demonstração.')),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactUrl),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('home.cta.label', 'Solicitar atendimento')),'variant' => 'brand','inline' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal106c39dd228b3992904670768e42d9e3)): ?>
<?php $attributes = $__attributesOriginal106c39dd228b3992904670768e42d9e3; ?>
<?php unset($__attributesOriginal106c39dd228b3992904670768e42d9e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal106c39dd228b3992904670768e42d9e3)): ?>
<?php $component = $__componentOriginal106c39dd228b3992904670768e42d9e3; ?>
<?php unset($__componentOriginal106c39dd228b3992904670768e42d9e3); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $attributes = $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7)): ?>
<?php $component = $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7; ?>
<?php unset($__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', [
'seoTitle' => $homePage?->seo_title,
'seoDescription' => $homePage?->seo_description,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/home.blade.php ENDPATH**/ ?>