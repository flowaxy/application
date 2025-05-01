<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Flowaxy') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Пользовательские стили -->
    <?php
    $layoutCssPath = base_path('public/assets/css/layout.css');
    $noticeCssPath = base_path('public/assets/css/notice.css');
    ?>
    <link href="/assets/css/layout.css?v=<?= file_exists($layoutCssPath) ? filemtime($layoutCssPath) : time() ?>" rel="stylesheet">
    <link href="/assets/css/notice.css?v=<?= file_exists($noticeCssPath) ? filemtime($noticeCssPath) : time() ?>" rel="stylesheet">
</head>

<body>

    <body>
        <div id="content">
            <nav class="navbar navbar-dark bg-dark px-2">
                <div class="container-fluid">
                    <!-- Кнопка "Меню" (мобильные) -->
                    <button class="btn btn-sm btn-outline-light d-md-none" id="menu-toggle" type="button">
                        &#9776;
                    </button>
                    <!-- Название/логотип -->
                    <span class="navbar-brand fs-5 d-flex align-items-center m-0 p-0">
                        WEB STUDIO FLOWAXY
                    </span>
                    <!-- Кнопка "Выйти" справа -->
                    <form action="/cabinet/logout" method="POST" class="d-inline m-0 p-0">
                        <input type="hidden" name="_csrf_token" value="<?= \Application\Core\Session::generateToken(); ?>">
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            Вийти
                        </button>
                    </form>
                </div>
            </nav>

            <div id="sidebar">
                <!-- Аватар та ім’я -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <img src="/assets/images/avatar/default.avif" alt="Аватар" class="rounded-circle me-2" width="36" height="36">
                        <strong>Ім'я Фамілія</strong>
                    </div>
                    <span class="text-white-50">&#9660;</span>
                </div>

                <hr>

                <?= \Application\Helpers\DirectHelper::components('resources/views/cabinet/components/sidebar', 1, 6, 'html'); ?>
            </div>
            <?= $content ?? ''; ?>
        </div>

        <?php include base_path('resources/views/cabinet/partials/flash.php') ?>

        <footer class="footer-flowaxy">
            © 2024-<?php echo date('Y'); ?>. Работает на CMS Flowaxy
        </footer>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Уведомления JS -->
        <script src="/assets/js/notice.js"></script>

        <script>
            // Кнопка "Меню" (мобильные)
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');

            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        </script>
    </body>

</html>