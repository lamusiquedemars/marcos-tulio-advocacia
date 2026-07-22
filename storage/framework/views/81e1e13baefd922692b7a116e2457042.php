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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->isEmpty()): ?>
            <div class="prose">
                <p>Aucun événement annoncé pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="event-list">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="event-card">
                        <div class="event-card__date">
                            <span><?php echo e($event->starts_at->translatedFormat('d')); ?></span>
                            <strong><?php echo e($event->starts_at->translatedFormat('M')); ?></strong>
                        </div>

                        <div class="event-card__body">
                            <p class="event-card__meta">
                                <?php echo e($event->starts_at->translatedFormat('d F Y à H:i')); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->venueLabel()): ?>
                                    · <?php echo e($event->venueLabel()); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <h2><a href="<?php echo e(route('events.show', $event->slug)); ?>"><?php echo e($event->title); ?></a></h2>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->publicExcerpt()): ?>
                                <p><?php echo e($event->publicExcerpt()); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->status !== \App\Modules\Events\Models\Event::STATUS_SCHEDULED): ?>
                                <span class="event-card__status"><?php echo e($event->statusLabel()); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php echo e($events->links()); ?>

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
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/site/events/index.blade.php ENDPATH**/ ?>