<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal7581f317093bf3292868869e04b36f91 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7581f317093bf3292868869e04b36f91 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.hero','data' => ['variant' => 'page','title' => $page->hero_title ?? $page->title,'subtitle' => $page->hero_subtitle ?? $page->excerpt,'image' => $page->heroImageUrl(),'ctaUrl' => $contactUrl,'ctaLabel' => ''.e(\App\Support\ContentSlots::value('services.hero.cta_label', 'Parler du projet')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'page','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->hero_title ?? $page->title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->hero_subtitle ?? $page->excerpt),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->heroImageUrl()),'cta-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactUrl),'cta-label' => ''.e(\App\Support\ContentSlots::value('services.hero.cta_label', 'Parler du projet')).'']); ?>
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

    <?php if (isset($component)) { $__componentOriginal9cc5f92ce39a0f086d6eefac46b56040 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9cc5f92ce39a0f086d6eefac46b56040 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.breadcrumb','data' => ['items' => [
        ['label' => $page->title],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => $page->title],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9cc5f92ce39a0f086d6eefac46b56040)): ?>
<?php $attributes = $__attributesOriginal9cc5f92ce39a0f086d6eefac46b56040; ?>
<?php unset($__attributesOriginal9cc5f92ce39a0f086d6eefac46b56040); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9cc5f92ce39a0f086d6eefac46b56040)): ?>
<?php $component = $__componentOriginal9cc5f92ce39a0f086d6eefac46b56040; ?>
<?php unset($__componentOriginal9cc5f92ce39a0f086d6eefac46b56040); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2472f7d0b1ca22068dd46dfd59e8a3a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['title' => \App\Support\ContentSlots::value('services.offers.title', 'Trois niveaux, un même socle'),'intro' => \App\Support\ContentSlots::value('services.offers.intro', 'La différence se joue sur la richesse du contenu, les modules actifs et le degré de personnalisation.'),'headingVariant' => 'accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.offers.title', 'Trois niveaux, un même socle')),'intro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.offers.intro', 'La différence se joue sur la richesse du contenu, les modules actifs et le degré de personnalisation.')),'heading-variant' => 'accent']); ?>
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
            <?php if (isset($component)) { $__componentOriginala9cfd707271e0a7566f86345bb80c382 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9cfd707271e0a7566f86345bb80c382 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => 'Essence','kicker' => \App\Support\ContentSlots::value('services.essence.price', 'À partir de 1500'),'variant' => 'featured']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Essence','kicker' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.essence.price', 'À partir de 1500')),'variant' => 'featured']); ?>
                <?php echo e(\App\Support\ContentSlots::value('services.essence.description', 'Pages essentielles, contact, SEO de base, thème simple et administration limitée aux contenus utiles.')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => 'Signature','kicker' => \App\Support\ContentSlots::value('services.signature.price', 'Sur devis cadre'),'variant' => 'highlight']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Signature','kicker' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.signature.price', 'Sur devis cadre')),'variant' => 'highlight']); ?>
                <?php echo e(\App\Support\ContentSlots::value('services.signature.description', 'Structure plus riche, actualités, galerie, sections de preuve, CTA, media system et finitions thème.')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => 'Univers','kicker' => \App\Support\ContentSlots::value('services.univers.price', 'Sur devis métier')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Univers','kicker' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.univers.price', 'Sur devis métier'))]); ?>
                <?php echo e(\App\Support\ContentSlots::value('services.univers.description', 'Module métier client, catalogue (avec ou sans paiement), workflow spécifique ou intégration externe selon le besoin.')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['variant' => 'muted','title' => \App\Support\ContentSlots::value('services.common.title', 'Ce qui reste commun'),'headingVariant' => 'underline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'muted','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.common.title', 'Ce qui reste commun')),'heading-variant' => 'underline']); ?>
        <?php if (isset($component)) { $__componentOriginale7af5305188002b70961a0972a8dfcbd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7af5305188002b70961a0972a8dfcbd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.grid','data' => ['columns' => '2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => '2']); ?>
            <?php if (isset($component)) { $__componentOriginal682de61ccb5fe167fdfa0adff473ed89 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal682de61ccb5fe167fdfa0adff473ed89 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.feature-card','data' => ['title' => 'Socle technique','icon' => 'A']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Socle technique','icon' => 'A']); ?>
                <?php echo e(\App\Support\ContentSlots::value('services.common.tech.text', 'Laravel, Filament, modules activables, migrations, seeders, tests et conventions de livraison.')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.feature-card','data' => ['title' => 'Socle front','icon' => 'B']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.feature-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Socle front','icon' => 'B']); ?>
                <?php echo e(\App\Support\ContentSlots::value('services.common.front.text', 'Composants Blade, CSS maison, JS progressif, media system et thèmes clients.')); ?>

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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.cta','data' => ['title' => \App\Support\ContentSlots::value('services.cta.title', 'Une offre simple à expliquer'),'text' => \App\Support\ContentSlots::value('services.cta.text', 'Le client choisit un niveau de site. Le développeur garde un socle commun versionné.'),'href' => $contactUrl,'label' => \App\Support\ContentSlots::value('services.cta.label', 'Présenter un projet'),'inline' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.cta.title', 'Une offre simple à expliquer')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.cta.text', 'Le client choisit un niveau de site. Le développeur garde un socle commun versionné.')),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactUrl),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Support\ContentSlots::value('services.cta.label', 'Présenter un projet')),'inline' => true]); ?>
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

        <div class="stack stack--md">
            <?php if (isset($component)) { $__componentOriginal1d723961efa02a3f69f830e482ced20e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d723961efa02a3f69f830e482ced20e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.back-link','data' => ['href' => route('home'),'label' => 'Retour à l\'accueil']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.back-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('home')),'label' => 'Retour à l\'accueil']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d723961efa02a3f69f830e482ced20e)): ?>
<?php $attributes = $__attributesOriginal1d723961efa02a3f69f830e482ced20e; ?>
<?php unset($__attributesOriginal1d723961efa02a3f69f830e482ced20e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d723961efa02a3f69f830e482ced20e)): ?>
<?php $component = $__componentOriginal1d723961efa02a3f69f830e482ced20e; ?>
<?php unset($__componentOriginal1d723961efa02a3f69f830e482ced20e); ?>
<?php endif; ?>
        </div>
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
    'seoTitle' => $page->seo_title,
    'seoDescription' => $page->seo_description,
    'seoImage' => $page->heroImageUrl(),
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/pages/services.blade.php ENDPATH**/ ?>