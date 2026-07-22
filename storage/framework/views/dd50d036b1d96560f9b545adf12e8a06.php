<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'level' => 2,
    'variant' => null,
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
    'level' => 2,
    'variant' => null,
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
    $tag = in_array((int) $level, [1, 2, 3, 4], true) ? 'h' . (int) $level : 'h2';
?>

<<?php echo e($tag); ?> <?php echo e($attributes->class([
    'heading',
    'heading--' . $variant => $variant,
    'heading--center' => $align === 'center',
])); ?>>
    <?php echo e($slot); ?>

</<?php echo e($tag); ?>>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/components/site/heading.blade.php ENDPATH**/ ?>