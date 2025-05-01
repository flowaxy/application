<div class="flash-container">
    <?php foreach (['success', 'error'] as $type): ?>
        <?php $message = \Application\Core\Session::getFlash($type); ?>
        <?php if (!empty($message)): ?>
            <div class="flash-message <?= $type ?>">
                <span class="flash-text"><?= htmlspecialchars((string)$message); ?></span>
                <button class="flash-close" onclick="this.parentElement.remove();">&times;</button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>