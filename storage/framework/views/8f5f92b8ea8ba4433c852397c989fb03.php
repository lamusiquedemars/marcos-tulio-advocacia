<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
'eyebrow' => 'Maracuja CMS',
'title',
'subtitle' => null,
'ctaUrl' => null,
'ctaLabel' => null,
'secondaryCtaUrl' => null,
'secondaryCtaLabel' => null,
'variant' => null,
'image' => null,
'media' => null,
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
'eyebrow' => 'Maracuja CMS',
'title',
'subtitle' => null,
'ctaUrl' => null,
'ctaLabel' => null,
'secondaryCtaUrl' => null,
'secondaryCtaLabel' => null,
'variant' => null,
'image' => null,
'media' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section
    <?php echo e($attributes->class([
        'hero',
        'hero--' . $variant => $variant,
        'hero--image' => $image,
    ])->style([
        'background-image: url(' . $image . ')' => $image,
    ])); ?>>
    <div class="hero__inner">
        <div class="hero__content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($eyebrow)): ?>
            <p class="eyebrow"><?php echo e($eyebrow); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <h1><?php echo e($title); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($subtitle)): ?>
            <p class="hero__subtitle"><?php echo e($subtitle); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((! empty($ctaUrl) && ! empty($ctaLabel)) || (! empty($secondaryCtaUrl) && ! empty($secondaryCtaLabel))): ?>
            <div class="hero__actions">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($ctaUrl) && ! empty($ctaLabel)): ?>
                <a class="btn btn--primary" href="<?php echo e($ctaUrl); ?>"><?php echo e($ctaLabel); ?></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($secondaryCtaUrl) && ! empty($secondaryCtaLabel)): ?>
                <a class="btn btn--secondary" href="<?php echo e($secondaryCtaUrl); ?>"><?php echo e($secondaryCtaLabel); ?></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($media): ?>
        <div class="hero__media">
            <?php echo e($media); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section><?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/components/site/hero.blade.php ENDPATH**/ ?>