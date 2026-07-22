<div style="font-family: Arial, sans-serif; color: #222; line-height: 1.55; max-width: 640px;">
    <?php
        $body = $segmentMessage->bodyForEmail($message ?? null);
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(str_contains($body, '<')): ?>
        <?php echo $body; ?>

    <?php else: ?>
        <?php echo nl2br(e($body)); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <hr style="border: 0; border-top: 1px solid #ddd; margin: 28px 0 16px;">

    <p style="color: #666; font-size: 13px;">
        Vous recevez ce message car votre adresse figure dans la liste de contacts de l’atelier.
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($isPreview) && $contact->unsubscribe_token): ?>
            <br>
            <a href="<?php echo e(route('audience.unsubscribe', ['token' => $contact->unsubscribe_token])); ?>" style="color: #555;">
                Ne plus recevoir ces messages
            </a>
        <?php elseif(! empty($isPreview)): ?>
            <br>
            <span style="color: #555;">Lien de désinscription masqué dans l’aperçu.</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </p>
</div>
<?php /**PATH /Users/ivocorreiademelo/Sites/avocat-cms/resources/views/mail/segment-message.blade.php ENDPATH**/ ?>