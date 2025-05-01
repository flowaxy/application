<?php
$themeCssPath = base_path('public/assets/css/theme.css');
$colorCssPath = base_path('public/assets/css/color.css');
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?= $title ?? 'Welcome' ?></title>

    <!-- Фавікон -->
    <link rel="shortcut icon" href="/assets/images/previews/favicon.png">

    <!-- Підключення CSS плагінів -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/plugins/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/plugins/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/plugins/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="/assets/plugins/scrollcue/scrollcue.css">
    <link rel="stylesheet" href="/assets/plugins/swiper/swiper-bundle.min.css">

    <!-- Шрифти та іконки -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/all.css">

    <!-- Основний CSS шаблону -->
    <link href="/assets/css/theme.css?v=<?= file_exists($themeCssPath) ? filemtime($themeCssPath) : time() ?>" rel="stylesheet">
    <link href="/assets/css/color.css?v=<?= file_exists($colorCssPath) ? filemtime($colorCssPath) : time() ?>" rel="stylesheet">
</head>

<body data-preloader="1-dark">
    <!-- Шапка сайту -->
    <div class="header right header-color-black transparent-light sticky-autohide">
        <div class="container">
            <div class="branding-block text-white d-flex flex-column align-items-start py-2 position-relative">
                <!-- Брендова вертикальна лінія -->
                <div class="branding-line"></div>

                <!-- Логотип -->
                <a href="/" class="d-inline-flex align-items-center text-decoration-none" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.6rem;">
                    <span style="color:rgb(255, 255, 255);">FLOW<span style="color: #0d6efd;">AXY</span></span>
                    <span style="color: #0d6efd; font-size: 1.2rem; margin-left: 5px;">•</span>
                </a>

                <!-- Анімований слоган -->
                <div class="branding-slogan">
                    <div class="slogan-list">
                        <span>CREATIVE DIGITAL SOLUTIONS</span>
                        <span>MODERN UI/UX DESIGN</span>
                        <span>FULL-CYCLE DEVELOPMENT</span>
                        <span>STRATEGIC BRANDING IDEAS</span>
                        <span>PERFORMANCE-DRIVEN SEO</span>
                        <span>WEBSITES THAT CONVERT</span>
                        <span>HIGH-SPEED PAGE OPTIMIZATION</span>
                        <span>GOOGLE & META (FB) ADS EXPERTISE</span>
                    </div>
                </div>
            </div>

            <!-- <div class="header-logo"> -->
            <!-- SVG або PNG логотип світлої теми -->
            <!-- <img src="/assets/images/flowaxy-logo-light.png" alt="Flowaxy" class="logo-light" style="height: 40px;"> -->
            <!-- SVG або PNG логотип темної теми -->
            <!-- <img src="/assets/images/flowaxy-logo-dark.png" alt="Flowaxy" class="logo-dark d-none" style="height: 40px;"> -->
            <!-- </div> -->

            <!-- Меню сайту -->
            <div class="header-menu">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#">Посилання</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Випадаюче</a>
                        <ul class="nav-dropdown">
                            <li class="nav-dropdown-item"><a class="nav-dropdown-link" href="#">Елемент</a></li>
                            <li class="nav-dropdown-item"><a class="nav-dropdown-link" href="#">Елемент</a></li>
                            <li class="nav-dropdown-item"><a class="nav-dropdown-link" href="#">Елемент</a></li>
                            <li class="nav-dropdown-item"><a class="nav-dropdown-link" href="#">Елемент</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Підменю</a>
                        <ul class="nav-dropdown">
                            <li class="nav-dropdown-item">
                                <a class="nav-dropdown-link" href="#">Елемент</a>
                                <ul class="nav-subdropdown">
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                </ul>
                            </li>
                            <li class="nav-dropdown-item">
                                <a class="nav-dropdown-link" href="#">Елемент</a>
                                <ul class="nav-subdropdown">
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                    <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Велике підменю</a>
                        <ul class="nav-dropdown">
                            <li class="nav-dropdown-item">
                                <a class="nav-dropdown-link" href="#">Елемент</a>
                                <div class="nav-subdropdown nav-subdropdown-lg">
                                    <div class="row g-2 g-lg-3">
                                        <div class="col-12 col-lg-6">
                                            <ul>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <ul>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                                <li class="nav-subdropdown-item"><a class="nav-subdropdown-link" href="#">Підпункт</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Іконки соцмереж -->
            <div class="header-menu-extra">
                <ul class="list-inline-sm">
                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                    <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>

            <!-- Кнопка меню для мобільної версії -->
            <button class="header-toggle">
                <span></span>
            </button>
        </div>
    </div>

    <!-- Контент сторінки -->
    <?= $content ?? ''; ?>

    <!-- Футер -->
    <footer>
        <div class="section bg-dark">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-12 col-md-6 text-center text-md-start">
                        <h2 class="uppercase letter-spacing-1">FLOWAXY</h2>
                        <ul class="list-inline-dash mt-3">
                            <li><a href="#">Послуги</a></li>
                            <li><a href="#">Портфоліо</a></li>
                            <li><a href="#">Контакти</a></li>
                            <li><a href="#">Про нас</a></li>
                        </ul>
                        <p class="mt-2">&copy; 2024–<?= date('Y') ?> Flowaxy Digital Agency. Усі права захищено.</p>
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-phone-alt me-2"></i>
                                <a href="tel:+380991234567" class="text-white text-decoration-none">+38 (099) 123-45-67</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope me-2"></i>
                                <a href="mailto:hello@flowaxy.com" class="text-white text-decoration-none">hello@flowaxy.com</a>
                            </li>
                        </ul>
                        <ul class="list-inline-sm mt-3 mt-lg-4">
                            <li><a class="button-circle button-circle-sm button-circle-social-facebook" href="#"><i class="bi bi-facebook"></i></a></li>
                            <li><a class="button-circle button-circle-sm button-circle-social-twitter" href="#"><i class="bi bi-twitter-x"></i></a></li>
                            <li><a class="button-circle button-circle-sm button-circle-social-instagram" href="#"><i class="bi bi-instagram"></i></a></li>
                            <li><a class="button-circle button-circle-sm button-circle-social-linkedin" href="#"><i class="bi bi-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Кнопка "вгору" -->
    <div class="scrolltotop icon-lg">
        <a class="button-circle button-circle-md button-circle-dark" href="#"><i class="bi bi-arrow-up-short"></i></a>
    </div>

    <!-- JS плагіни -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script src="/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/plugins/appear/appear.min.js"></script>
    <script src="/assets/plugins/easing/easing.min.js"></script>
    <script src="/assets/plugins/retina/retina.min.js"></script>
    <script src="/assets/plugins/jquery/jquery.countdown.min.js"></script>
    <script src="/assets/plugins/imagesloaded/imagesloaded.min.js"></script>
    <script src="/assets/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/assets/plugins/parallaxie/parallaxie.min.js"></script>
    <script src="/assets/plugins/magnific-popup/magnific-popup.min.js"></script>
    <script src="/assets/plugins/owl-carousel/owlcarousel.min.js"></script>
    <script src="/assets/plugins/mixitup/mixitup.min.js"></script>
    <script src="/assets/plugins/easy-pie-chart/easy-pie-chart.min.js"></script>
    <script src="/assets/plugins/typer/typer.min.js"></script>
    <script src="/assets/plugins/gmaps/gmaps.min.js"></script>
    <script src="/assets/plugins/swiper/swiper.min.js"></script>
    <script src="/assets/plugins/scrollcue/scrollcue.min.js"></script>

    <!-- Головний скрипт -->
    <script src="/assets/js/application.js"></script>
</body>

</html>