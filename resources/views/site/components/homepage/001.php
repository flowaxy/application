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
                                    Ласкаво просимо до нашої вебстудії. Ми створюємо сайти, що надихають, працюють і приносять результат.
                                </p>
                                <a class="button button-xl button-rounded button-white-2 mt-4 mt-lg-5" href="#">Дізнатися більше</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>