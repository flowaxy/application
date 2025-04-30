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

