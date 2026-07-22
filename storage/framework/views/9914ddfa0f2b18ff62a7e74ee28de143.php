<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal7581f317093bf3292868869e04b36f91 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7581f317093bf3292868869e04b36f91 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.hero','data' => ['eyebrow' => $label,'title' => $post->title,'subtitle' => $post->published_at?->translatedFormat('d F Y'),'variant' => 'page']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->published_at?->translatedFormat('d F Y')),'variant' => 'page']); ?>
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
        ['label' => $label, 'url' => route('articles.index')],
        ['label' => $post->title],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => $label, 'url' => route('articles.index')],
        ['label' => $post->title],
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => ['container' => 'readable']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container' => 'readable']); ?>
        <article class="article-content prose">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->imageUrl()): ?>
                <?php if (isset($component)) { $__componentOriginal3bc840f3aea2d3a7a5a00cc93035babf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bc840f3aea2d3a7a5a00cc93035babf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.figure','data' => ['src' => $post->imageUrl(),'alt' => $post->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.figure'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->imageUrl()),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3bc840f3aea2d3a7a5a00cc93035babf)): ?>
<?php $attributes = $__attributesOriginal3bc840f3aea2d3a7a5a00cc93035babf; ?>
<?php unset($__attributesOriginal3bc840f3aea2d3a7a5a00cc93035babf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bc840f3aea2d3a7a5a00cc93035babf)): ?>
<?php $component = $__componentOriginal3bc840f3aea2d3a7a5a00cc93035babf; ?>
<?php unset($__componentOriginal3bc840f3aea2d3a7a5a00cc93035babf); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e(\App\Support\ArticleBlocks::render($post->body_blocks)); ?>


            <?php if (isset($component)) { $__componentOriginal1d723961efa02a3f69f830e482ced20e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d723961efa02a3f69f830e482ced20e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.back-link','data' => ['href' => route('articles.index'),'label' => 'Retour à ' . strtolower($label)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.back-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('articles.index')),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Retour à ' . strtolower($label))]); ?>
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
        </article>
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
    'seoTitle' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description ?? $post->publicExcerpt(),
    'seoImage' => $post->imageUrl(),
    'seoType' => 'article',
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/articles/show.blade.php ENDPATH**/ ?>