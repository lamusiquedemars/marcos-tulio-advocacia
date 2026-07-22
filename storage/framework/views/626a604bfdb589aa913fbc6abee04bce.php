<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal7581f317093bf3292868869e04b36f91 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7581f317093bf3292868869e04b36f91 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.hero','data' => ['title' => $page->hero_title ?? $page->title,'subtitle' => $page->hero_subtitle ?? $page->excerpt,'image' => $page->heroImageUrl()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->hero_title ?? $page->title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->hero_subtitle ?? $page->excerpt),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->heroImageUrl())]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['container' => 'narrow','innerClass' => 'prose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container' => 'narrow','inner-class' => 'prose']); ?>
        <h2><?php echo e($page->title); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page->excerpt): ?>
            <p class="lead"><?php echo e($page->excerpt); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page->content): ?>
            <?php echo strip_tags($page->content, '<p><br><strong><b><em><i><u><ul><ol><li><a><sup><sub>'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/page.blade.php ENDPATH**/ ?>