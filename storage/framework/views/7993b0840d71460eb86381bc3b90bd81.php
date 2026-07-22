<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'images',
    'layout' => 'grid',
    'lightbox' => false,
    'itemsPerView' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'images',
    'layout' => 'grid',
    'lightbox' => false,
    'itemsPerView' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $allowedLayouts = ['grid', 'featured', 'carousel'];
    $layout = in_array($layout, $allowedLayouts, true) ? $layout : 'grid';
    $isCarousel = $layout === 'carousel';
    $itemsPerView = $itemsPerView === null ? null : max(1, min(4, (int) $itemsPerView));
    $items = collect($images)->values();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->isNotEmpty()): ?>
    <div
        <?php echo e($attributes
            ->class([
                'media-gallery',
                'showcase',
                'showcase--' . $layout,
                'carousel--items-' . $itemsPerView => $isCarousel && $itemsPerView,
            ])
            ->merge($lightbox ? ['data-lightbox' => true] : [])
            ->merge($isCarousel ? ['data-carousel' => true] : [])); ?>

    >
        <?php
            $renderItem = function ($image) use ($lightbox) {
                $src = $image->resolved_image_url;
                $caption = $image->caption ?: $image->media?->caption ?: $image->title;

                return compact('src', 'caption');
            };
        ?>

        <div class="showcase__items" <?php if($isCarousel): ?> data-carousel-viewport <?php endif; ?>>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCarousel): ?>
                <div class="carousel__track">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php (['src' => $src, 'caption' => $caption] = $renderItem($image)); ?>

                <article class="<?php echo \Illuminate\Support\Arr::toCssClasses(['showcase__item', 'carousel__slide' => $isCarousel]); ?>">
                    <div class="showcase__media">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lightbox): ?>
                            <a
                                href="<?php echo e($src); ?>"
                                data-pswp-width="<?php echo e($image->width ?? 1600); ?>"
                                data-pswp-height="<?php echo e($image->height ?? 1000); ?>"
                                target="_blank"
                                rel="noreferrer"
                            >
                                <?php if (isset($component)) { $__componentOriginal57afb0555c9772b514128317fae0a4c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57afb0555c9772b514128317fae0a4c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.image','data' => ['src' => $src,'alt' => $image->alt,'width' => $image->width,'height' => $image->height]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($src),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->alt),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->width),'height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->height)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57afb0555c9772b514128317fae0a4c5)): ?>
<?php $attributes = $__attributesOriginal57afb0555c9772b514128317fae0a4c5; ?>
<?php unset($__attributesOriginal57afb0555c9772b514128317fae0a4c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57afb0555c9772b514128317fae0a4c5)): ?>
<?php $component = $__componentOriginal57afb0555c9772b514128317fae0a4c5; ?>
<?php unset($__componentOriginal57afb0555c9772b514128317fae0a4c5); ?>
<?php endif; ?>
                            </a>
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginal57afb0555c9772b514128317fae0a4c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57afb0555c9772b514128317fae0a4c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.image','data' => ['src' => $src,'alt' => $image->alt,'width' => $image->width,'height' => $image->height]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($src),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->alt),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->width),'height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image->height)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57afb0555c9772b514128317fae0a4c5)): ?>
<?php $attributes = $__attributesOriginal57afb0555c9772b514128317fae0a4c5; ?>
<?php unset($__attributesOriginal57afb0555c9772b514128317fae0a4c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57afb0555c9772b514128317fae0a4c5)): ?>
<?php $component = $__componentOriginal57afb0555c9772b514128317fae0a4c5; ?>
<?php unset($__componentOriginal57afb0555c9772b514128317fae0a4c5); ?>
<?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($caption || $image->credit || $image->media?->credit): ?>
                        <div class="showcase__content">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($caption): ?>
                                <h3 class="showcase__item-title"><?php echo e($caption); ?></h3>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image->credit || $image->media?->credit): ?>
                                <p class="showcase__meta">Crédit : <?php echo e($image->credit ?: $image->media?->credit); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCarousel): ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isCarousel && $items->count() > 1): ?>
            <div class="carousel__controls">
                <button class="btn btn--secondary btn--small" data-carousel-prev type="button">Précédent</button>
                <button class="btn btn--secondary btn--small" data-carousel-next type="button">Suivant</button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/components/site/gallery.blade.php ENDPATH**/ ?>