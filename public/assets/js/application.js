/**
 * Компанія     : Веб-студія "FlowAxy"
 * Версія       : v.1.0.0 Alpha
 * Автор        : iTeffa <iteffa@flowaxy.com>
 * 
 * Контакт:     flowaxy.dev@gmail.com
 * Вебсайт:     https://flowaxy.com
 * © 2024–2025 Усі права захищено
 *
 * Зміст:
 * 1.  Прелоадери
 * 2.  Анімації при прокрутці
 * 3.  Фонові зображення
 * 4.  Меню заголовка (Header)
 * 5.  Повноекранне меню
 * 6.  Кнопка "нагорі сторінки"
 * 7.  Мейсонрі портфоліо
 * 8.  Сітка портфоліо
 * 9.  Слайдер
 * 10. Мейсонрі блог
 * 11. Мейсонрі (загальна)
 * 12. Лайтбокс (Lightbox)
 * 13. Паралакс
 * 14. Зворотний відлік (Countdown)
 * 15. Лічильник (Counter)
 * 16. Акордеон
 * 17. Анімована прогрес-лінія
 * 18. Коло прогресу (Easy Pie Chart)
 * 19. Карти Google
 * 20. Форма зворотного зв’язку
 * 21. Курсор
 * 22. Прогрес прокрутки сторінки
 * 23. Swiper-слайдер
 */

"use strict";

// Отримуємо посилання на тіло документа та ширину вікна браузера
var body = document.body;
var $windowWidth = $(window).width();

/**
 * 1. Прелоадери (анімація завантаження)
 */

// Додаємо клас "loaded" до тіла документа після повного завантаження сторінки
window.addEventListener("load", function () {
    document.body.classList.add("loaded");
});

// Отримуємо тип прелоадера з атрибута data-preloader
var preloaderType = body.getAttribute("data-preloader");

// Додаємо прелоадер типу 1, якщо вибрано варіант "1"
if (preloaderType === "1") {
    var preloader1 = document.createElement("div");
    preloader1.className = "preloader preloader-1";
    preloader1.innerHTML = "<div><svg class='loader-circular' viewBox='25 25 50 50'><circle class='loader-path' cx='50' cy='50' r='20'></svg></div>";
    body.appendChild(preloader1);
}

// Додаємо прелоадер типу 2, якщо вибрано варіант "2"
else if (preloaderType === "2") {
    var preloader2 = document.createElement("div");
    preloader2.className = "preloader preloader-2";
    preloader2.innerHTML = "<div><span></span></div>";
    body.appendChild(preloader2);
}

// Додаємо прелоадер типу 3, якщо вибрано варіант "3"
else if (preloaderType === "3") {
    var preloader3 = document.createElement("div");
    preloader3.className = "preloader preloader-3";
    preloader3.innerHTML = "<div><span></span></div>";
    body.appendChild(preloader3);
}

/**
 * 2. Анімації при прокрутці
 */

// Ініціалізація бібліотеки анімацій при прокручуванні (наприклад, ScrollCue)
scrollCue.init();

/**
 * 3. Фонові зображення
 */

// Автоматичне встановлення фонових зображень з атрибута data-bg-src
var bgImages = document.querySelectorAll(".bg-image");

if (bgImages) {
    bgImages.forEach(function (bgImage) {
        var bgData = bgImage.getAttribute("data-bg-src");
        bgImage.style.backgroundImage = 'url("' + bgData + '")';
    });
}

/**
 * 4. Меню заголовка (Header Menu)
 */

// Отримуємо елементи меню заголовка
var header = document.querySelector(".header");
var headerMenu = document.querySelector(".header-menu");
var headerToggle = document.querySelector(".header-toggle");
var headerSticky = document.querySelector(".header.sticky-autohide");
var c, currentScrollTop = 0;

// ======= Автоматичне приховування при прокручуванні (auto-hide) =======
if (headerSticky) {
    window.addEventListener("scroll", function () {
        var a = window.pageYOffset;
        currentScrollTop = a;

        if (c < currentScrollTop && a > 210) {
            if ((!headerMenu || !headerMenu.classList.contains("show"))) {
                headerSticky.classList.add("hide");
            }
        } else if (c > currentScrollTop && !(a <= 210)) {
            headerSticky.classList.remove("hide");
        }

        c = currentScrollTop;
    });
}

// ======= Плейсхолдери для липкого хедера (sticky header) =======
if (document.querySelector(".header.sticky-autohide:not(.header-lg, .header-xl, .transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholder = document.createElement("div");
    headerPlaceholder.className = "header-placeholder";
    document.querySelector(".header.sticky-autohide").insertAdjacentElement("beforebegin", headerPlaceholder);
}
if (document.querySelector(".header-lg.sticky-autohide:not(.transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholderLG = document.createElement("div");
    headerPlaceholderLG.className = "header-placeholder-lg";
    document.querySelector(".header-lg.sticky-autohide").insertAdjacentElement("beforebegin", headerPlaceholderLG);
}
if (document.querySelector(".header-xl.sticky-autohide:not(.transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholderXL = document.createElement("div");
    headerPlaceholderXL.className = "header-placeholder-xl";
    document.querySelector(".header-xl.sticky-autohide").insertAdjacentElement("beforebegin", headerPlaceholderXL);
}

// Sticky без autohide
if (document.querySelector(".header.sticky:not(.header-lg, .header-xl, .transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholder = document.createElement("div");
    headerPlaceholder.className = "header-placeholder";
    document.querySelector(".header.sticky").insertAdjacentElement("beforebegin", headerPlaceholder);
}
if (document.querySelector(".header-lg.sticky:not(.transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholderLG = document.createElement("div");
    headerPlaceholderLG.className = "header-placeholder-lg";
    document.querySelector(".header-lg.sticky").insertAdjacentElement("beforebegin", headerPlaceholderLG);
}
if (document.querySelector(".header-xl.sticky:not(.transparent-light, .transparent-dark, .header-boxed)")) {
    var headerPlaceholderXL = document.createElement("div");
    headerPlaceholderXL.className = "header-placeholder-xl";
    document.querySelector(".header-xl.sticky").insertAdjacentElement("beforebegin", headerPlaceholderXL);
}

// ======= Прозорий хедер (transparent) при скролі =======
if (document.querySelector(".transparent-light")) {
    window.addEventListener("scroll", function () {
        var headerFixed = document.querySelectorAll(".header.sticky-autohide, .header.sticky");
        if (window.pageYOffset > 10) {
            headerFixed.forEach(function (header) {
                header.classList.remove("transparent-light");
            });
        } else {
            headerFixed.forEach(function (header) {
                header.classList.add("transparent-light");
            });
        }
    });
}
if (document.querySelector(".transparent-dark")) {
    window.addEventListener("scroll", function () {
        var headerFixed = document.querySelectorAll(".header.sticky-autohide, .header.sticky");
        if (window.pageYOffset > 10) {
            headerFixed.forEach(function (header) {
                header.classList.remove("transparent-dark");
            });
        } else {
            headerFixed.forEach(function (header) {
                header.classList.add("transparent-dark");
            });
        }
    });
}

// ======= Відкриття/Закриття меню при кліку на іконку =======
if (headerToggle) {
    headerToggle.addEventListener("click", function () {
        if (headerMenu.classList.contains("show")) {
            headerMenu.classList.remove("show");
            headerToggle.classList.remove("toggle-close");
        } else {
            headerMenu.classList.add("show");
            headerToggle.classList.add("toggle-close");
        }
    });
}

// Закриття меню при кліку поза межами
if (headerMenu) {
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".header-menu, .header-toggle")) {
            if (headerMenu.classList.contains("show")) {
                headerMenu.classList.remove("show");
                headerToggle.classList.remove("toggle-close");
            }
        }
    });
}


// ======= Випадаюче меню (dropdown) =======
if (document.querySelector(".nav-dropdown")) {
    var navDropdowns = document.querySelectorAll(".nav-dropdown");
    var navSubdropdowns = document.querySelectorAll(".nav-subdropdown");

    // Основні dropdown'и
    navDropdowns.forEach(function (navDropdown) {
        var parentNavItem = navDropdown.parentNode;
        var navLink = parentNavItem.querySelector(".nav-link");
        navLink.classList.add("d-toggle");
        parentNavItem.insertAdjacentHTML("beforeend", '<a class="nav-dropdown-toggle" href="#"></a>');
    });

    // Підменю (subdropdown)
    navSubdropdowns.forEach(function (navSubdropdown) {
        var parentNavDropdownItem = navSubdropdown.parentNode;
        var navDropdownLink = parentNavDropdownItem.querySelector(".nav-dropdown-link");
        navDropdownLink.classList.add("sd-toggle");
        parentNavDropdownItem.insertAdjacentHTML("beforeend", '<a class="nav-subdropdown-toggle" href="#"></a>');
    });

    // Обробка кліків для відкриття/закриття dropdown'ів
    var navDropdownToggles = document.querySelectorAll(".nav-dropdown-toggle");
    navDropdownToggles.forEach(function (navDropdownToggle) {
        var parentNavItem = navDropdownToggle.parentNode;
        var navDropdown = parentNavItem.querySelector(".nav-dropdown");

        navDropdownToggle.addEventListener("click", function (e) {
            if (navDropdownToggle.classList.contains("active")) {
                navDropdownToggle.classList.remove("active");
                navDropdown.classList.remove("show");
            } else {
                navDropdownToggle.classList.add("active");
                navDropdown.classList.add("show");
            }
            e.preventDefault();
        });
    });

    // Обробка кліків для підменю
    var navSubdropdownToggles = document.querySelectorAll(".nav-subdropdown-toggle");
    navSubdropdownToggles.forEach(function (navSubdropdownToggle) {
        var parentNavDropdownItem = navSubdropdownToggle.parentNode;
        var navSubdropdown = parentNavDropdownItem.querySelector(".nav-subdropdown");

        navSubdropdownToggle.addEventListener("click", function (e) {
            if (navSubdropdownToggle.classList.contains("active")) {
                navSubdropdownToggle.classList.remove("active");
                navSubdropdown.classList.remove("show");
            } else {
                navSubdropdownToggle.classList.add("active");
                navSubdropdown.classList.add("show");
            }
            e.preventDefault();
        });
    });

    // ======= Mega меню =======
    var navMegaMenu = document.querySelectorAll(".mega-menu-content");
    navMegaMenu.forEach(function (navMega) {
        var parentMegaItem = navMega.parentNode;
        var navMegaLink = parentMegaItem.querySelector(".nav-link");
        navMegaLink.classList.add("d-toggle");
        parentMegaItem.insertAdjacentHTML("beforeend", '<a class="nav-dropdown-toggle" href="#"></a>');
    });

    // Обробка кліків для mega меню
    var megaMenuToggles = document.querySelectorAll(".mega-menu-item .nav-dropdown-toggle");
    megaMenuToggles.forEach(function (megaMenuToggle) {
        var parentMegaMenuItem = megaMenuToggle.parentNode;
        var megaMenu = parentMegaMenuItem.querySelector(".mega-menu-content");

        megaMenuToggle.addEventListener("click", function (e) {
            if (megaMenuToggle.classList.contains("active")) {
                megaMenuToggle.classList.remove("active");
                megaMenu.classList.remove("show");
            } else {
                megaMenuToggle.classList.add("active");
                megaMenu.classList.add("show");
            }
            e.preventDefault();
        });
    });
}

/**
 * 5. Повноекранне меню
 */

var fm = document.querySelector(".fullscreen-menu");

if (fm) {
    var fmToggle = document.querySelector(".fm-toggle");
    var fmClose = document.querySelector(".fm-close");

    // Відкрити меню
    fmToggle.addEventListener("click", function () {
        if (fm.classList.contains("fm-show")) {
            fm.classList.remove("fm-show");
        } else {
            fm.classList.add("fm-show");
        }
    });

    // Закрити меню
    fmClose.addEventListener("click", function () {
        fm.classList.remove("fm-show");
        fmToggle.classList.remove("fm-toggle-hide");
    });
}

/**
 * 6. Кнопка прокрутки вгору (Scroll to Top)
 */

var scrollTopBtn = document.querySelector(".scrolltotop");

if (scrollTopBtn) {
    // Показати/сховати кнопку
    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 700) { // 700px from top
            scrollTopBtn.classList.add("scrolltotop-show");
        } else {
            scrollTopBtn.classList.remove("scrolltotop-show");
        }
    });
}

/**
 * 7. Портфоліо у вигляді Masonry (з фільтрацією)
 */

var pMasonry = document.querySelector(".portfolio-masonry");

if (pMasonry) {
    imagesLoaded(pMasonry, function () {
        var pWrapper = $(".portfolio-masonry").isotope({
            itemSelector: ".portfolio-item",
            transitionDuration: 250
        });
        var filter = $(".filter ul li");

        // Фільтрація елементів портфоліо
        filter.on("click", function () {
            var filterValue = $(this).attr("data-filter");
            pWrapper.isotope({ filter: filterValue });

            filter.removeClass("active");
            $(this).addClass("active");
        });
    });
}

/**
 * 8. Сітка портфоліо (Grid)
 */

var pGrid = document.querySelector(".portfolio-grid");

if (pGrid) {
    var mixer = mixitup('.portfolio-grid', {
        selectors: {
            target: '.portfolio-item'
        },
        animation: {
            duration: 250
        }
    });
}

/**
 * 9. Слайдер (Owl Carousel)
 */

var owlSlider = document.querySelector(".owl-carousel");

if (owlSlider) {
    $(".owl-carousel").each(function () {
        var $carousel = $(this);

        var $defaults = {
            rewind: true,
            navText: ["<i class='bi bi-arrow-left-short'></i>", "<i class='bi bi-arrow-right-short'></i>"],
            autoHeight: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 400,
            autoplayHoverPause: true,
            navSpeed: 300,
            dotsSpeed: 300
        }

        var $options = {
            items: $carousel.data("owl-items"),
            margin: $carousel.data("owl-margin"),
            loop: $carousel.data("owl-loop"),
            center: $carousel.data("owl-center"),
            nav: $carousel.data("owl-nav"),
            rewind: $carousel.data("owl-rewind"),
            dots: $carousel.data("owl-dots"),
            autoplay: $carousel.data("owl-autoplay")
        }

        var $responsive = {
            responsive: {
                0: {
                    items: $carousel.data("owl-xs")
                },
                576: {
                    items: $carousel.data("owl-sm")
                },
                768: {
                    items: $carousel.data("owl-md")
                },
                992: {
                    items: $carousel.data("owl-lg")
                },
                1200: {
                    items: $carousel.data("owl-xl")
                }
            }
        }

        $carousel.owlCarousel($.extend($defaults, $options, $responsive));
    });
}

/**
 * 10. Masonry для блогу
 */

var blogMasonry = document.querySelector(".blog-masonry");

if (blogMasonry) {
    imagesLoaded(blogMasonry, function () {
        var $blogMasonry = $(blogMasonry);
        $blogMasonry.masonry({
            itemSelector: '.blog-post-box'
        });
    });
}

/**
 * 11. Masonry макет
 * Вирівнює елементи в стилі сітки із плавною адаптацією
 */

var masonryGrid = document.querySelector(".masonry");

if (masonryGrid) {
    imagesLoaded(masonryGrid, function () {
        var $masonryGrid = $(masonryGrid);
        $masonryGrid.masonry({
            itemSelector: '.masonry-item'
        });
    });
}

/**
 * 12. Lightbox (Відкриття зображень та відео в модальному вікні)
 */

// Зображення
var $lightboxImage = $(".lightbox-image-link, .lightbox-image-box");

$lightboxImage.each(function () {
    var $this = $(this);
    $this.magnificPopup({
        type: 'image',
        fixedContentPos: false,
        removalDelay: 200,
        closeOnContentClick: true,
        image: {
            titleSrc: 'data-image-title'
        }
    });
});

// Медіа (YouTube, Vimeo)
var $lightboxMedia = $(".lightbox-media-link, .lightbox-media-box");

$lightboxMedia.each(function () {
    var $this = $(this);
    $this.magnificPopup({
        type: "iframe",
        fixedContentPos: false,
        removalDelay: 200,
        preloader: false,
        iframe: {
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                }
            },
            srcAction: "iframe_src"
        }
    });
});

// Галерея
var $gallery = $(".gallery-wrapper");

if ($gallery.length) {
    $gallery.each(function () {
        var $this = $(this);
        $this.magnificPopup({
            delegate: 'a',
            removalDelay: '200',
            type: 'image',
            fixedContentPos: false,
            gallery: {
                enabled: true
            },
            image: {
                titleSrc: 'data-gallery-title'
            }
        });
    });
}

