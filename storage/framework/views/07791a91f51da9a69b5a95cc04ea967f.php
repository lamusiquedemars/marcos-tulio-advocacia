<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => null,
    'container' => 'default',
    'title' => null,
    'intro' => null,
    'eyebrow' => null,
    'innerClass' => null,
    'headingVariant' => null,
    'align' => null,
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
    'variant' => null,
    'container' => 'default',
    'title' => null,
    'intro' => null,
    'eyebrow' => null,
    'innerClass' => null,
    'headingVariant' => null,
    'align' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $containerClass = match ($container) {
        'narrow' => 'container container--narrow',
        'readable' => 'container container--readable',
        'wide' => 'container container--wide',
        'none' => null,
        default => 'container',
    };
?>

<section <?php echo e($attributes->class(['section', 'section--' . $variant => $variant])); ?>>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([$containerClass => $containerClass, $innerClass => $innerClass]); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title || $intro || $eyebrow): ?>
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['section__header', 'section__header--center' => $align === 'center']); ?>">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($eyebrow): ?>
                    <p class="eyebrow"><?php echo e($eyebrow); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
                    <?php if (isset($component)) { $__componentOriginal54720f4a233a99e850f489b669118ff4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54720f4a233a99e850f489b669118ff4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.heading','data' => ['level' => '2','variant' => $headingVariant,'align' => $align]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '2','variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headingVariant),'align' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($align)]); ?>
                        <?php echo e($title); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54720f4a233a99e850f489b669118ff4)): ?>
<?php $attributes = $__attributesOriginal54720f4a233a99e850f489b669118ff4; ?>
<?php unset($__attributesOriginal54720f4a233a99e850f489b669118ff4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54720f4a233a99e850f489b669118ff4)): ?>
<?php $component = $__componentOriginal54720f4a233a99e850f489b669118ff4; ?>
<?php unset($__componentOriginal54720f4a233a99e850f489b669118ff4); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($intro): ?>
                    <p class="section__intro"><?php echo e($intro); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo e($slot); ?>

    </div>
</section>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/components/site/section.blade.php ENDPATH**/ ?>