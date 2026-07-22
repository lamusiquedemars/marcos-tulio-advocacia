<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal7581f317093bf3292868869e04b36f91 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7581f317093bf3292868869e04b36f91 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.hero','data' => ['eyebrow' => $label,'title' => $label,'subtitle' => $subtitle,'variant' => 'page']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtitle),'variant' => 'page']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.breadcrumb','data' => ['items' => [['label' => $label]]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => $label]])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.section','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->isEmpty()): ?>
            <div class="prose">
                <p>Aucun article publié pour le moment.</p>
            </div>
        <?php else: ?>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginala9cfd707271e0a7566f86345bb80c382 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9cfd707271e0a7566f86345bb80c382 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.card','data' => ['title' => $post->title,'url' => route('articles.show', $post->slug),'image' => $post->imageUrl() ?: '/assets/images/merle.png','variant' => 'featured']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('articles.show', $post->slug)),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->imageUrl() ?: '/assets/images/merle.png'),'variant' => 'featured']); ?>
                        <?php echo e($post->publicExcerpt()); ?>

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
            <?php echo e($posts->links()); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
    'seoTitle' => $label . ' - ' . $settings->site_name,
    'seoDescription' => $subtitle,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/articles/index.blade.php ENDPATH**/ ?>