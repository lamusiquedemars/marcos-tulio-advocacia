<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'src',
    'alt' => '',
    'width' => null,
    'height' => null,
    'loading' => 'lazy',
    'decoding' => 'async',
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
    'src',
    'alt' => '',
    'width' => null,
    'height' => null,
    'loading' => 'lazy',
    'decoding' => 'async',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $resolvedSrc = str_starts_with($src, 'http') || str_starts_with($src, '/') ? $src : asset('storage/' . $src);
?>

<img
    <?php echo e($attributes->merge([
        'src' => $resolvedSrc,
        'alt' => $alt,
        'width' => $width,
        'height' => $height,
        'loading' => $loading,
        'decoding' => $decoding,
    ])); ?>

>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/components/site/image.blade.php ENDPATH**/ ?>