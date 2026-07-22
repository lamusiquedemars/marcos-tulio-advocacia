<?php
    $previewContact = new \App\Modules\Audience\Models\AudienceContact([
        'first_name' => 'Client',
        'email' => 'client@example.test',
        'accepts_email' => true,
    ]);
?>

<div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
    <?php echo $__env->make('mail.segment-message', [
        'segmentMessage' => $segmentMessage,
        'contact' => $previewContact,
        'isPreview' => true,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/filament/audience/segment-message-preview.blade.php ENDPATH**/ ?>