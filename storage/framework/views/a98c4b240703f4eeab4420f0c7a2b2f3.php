<?php echo '<'.'?xml version="1.0" encoding="UTF-8"?'.'>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e($url['loc']); ?></loc>
        <lastmod><?php echo e($url['lastmod']->toAtomString()); ?></lastmod>
        <priority><?php echo e($url['priority']); ?></priority>
    </url>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</urlset>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/seo/sitemap.blade.php ENDPATH**/ ?>