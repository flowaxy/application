<!-- Герой-секція з каруселлю -->
<div class="owl-carousel owl-nav-overlay owl-dots-overlay" data-owl-nav="true" data-owl-items="1">
    <?php foreach (['Креативні рішення', 'Цифрові технології', 'Індивідуальний підхід'] as $slideTitle): ?>
        <div class="section-fullscreen bg-image" data-bg-src="/assets/images/previews/background.jpg">
            <div class="bg-dark-04">
                <div class="container text-center">
                    <div class="position-middle">
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                                <h1 class="display-4 fw-normal uppercase letter-spacing-2"><?= htmlspecialchars($slideTitle) ?></h1>
                                <p class="font-large fw-light text-white-07 mt-3">
                                    Ласкаво просимо до нашої вебстудії. Ми створюємо унікальні сайти, що надихають та приносять результат. Приєднуйтесь до нашої цифрової подорожі вже сьогодні.
                                </p>
                                <a class="button button-xl button-rounded button-white-2 mt-4 mt-lg-5" href="#">Дізнатись більше</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Про студію -->
<div class="section-lg bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 text-center">
                <h2 class="fw-light m-0">
                    Ми впевнені: великі речі в бізнесі створюються не однією людиною, а сильною командою фахівців.
                </h2>
            </div>
        </div>
        <div class="row g-4 mt-5 text-center">
            <!-- 1 -->
            <div class="col-12 col-md-4">
                <img src="/assets/images/previews/col-2.jpg" alt="Розробка сайтів">
                <div class="mt-4">
                    <h4 class="fw-normal">Розробка сайтів</h4>
                    <p>Ми створюємо сучасні, адаптивні та ефективні сайти для бізнесу будь-якого рівня. Ваша онлайн-присутність — наш пріоритет.</p>
                    <a class="button-text-1 mt-4" href="#">Дізнатись більше</a>
                </div>
            </div>
            <!-- 2 -->
            <div class="col-12 col-md-4">
                <img src="/assets/images/previews/col-2.jpg" alt="Дизайн та UI/UX">
                <div class="mt-4">
                    <h4 class="fw-normal">Дизайн та UI/UX</h4>
                    <p>Ми створюємо інтерфейси, які не лише гарно виглядають, а й зручно працюють. Ваші користувачі залишаться задоволені.</p>
                    <a class="button-text-1 mt-4" href="#">Дізнатись більше</a>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-12 col-md-4">
                <img src="/assets/images/previews/col-2.jpg" alt="SEO та підтримка">
                <div class="mt-4">
                    <h4 class="fw-normal">SEO та підтримка</h4>
                    <p>Оптимізуємо ваш сайт для пошукових систем та забезпечуємо стабільну технічну підтримку після запуску.</p>
                    <a class="button-text-1 mt-4" href="#">Дізнатись більше</a>
                </div>
            </div>
        </div>
    </div>
</div>