<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Flowaxy') ?></title>
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Уведомления CSS -->
    <?php $noticeCssPath = base_path('public/assets/css/notice.css'); ?>
    <link href="/assets/css/notice.css?v=<?= file_exists($noticeCssPath) ? filemtime($noticeCssPath) : time() ?>" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <?php include base_path('/resources/views/cabinet/partials/flash.php') ?>
    </div>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="w-100 d-flex justify-content-center">
            <?= $content ?? ''; ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Уведомления JS -->
    <script src="/assets/js/notice.js"></script>
</body>

</html>