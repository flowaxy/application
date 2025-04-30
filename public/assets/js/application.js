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

