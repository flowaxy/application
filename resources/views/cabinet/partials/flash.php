<?php foreach (['success', 'error'] as $type): ?>
    <?php $message = \Application\Core\Session::getFlash($type); ?>
    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $type === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars((string)$message); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endforeach; ?>