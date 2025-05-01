<!-- Про студію -->
<div class="section-lg bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 text-center">
                <h2 class="fw-light m-0">
                    Великі проєкти створює не одна людина, а сильна команда професіоналів.
                </h2>
            </div>
        </div>
        <div class="row g-4 mt-5 text-center">
            <?php
            $services = [
                ['title' => 'Розробка сайтів', 'text' => 'Сучасні, адаптивні сайти для бізнесу будь-якого масштабу. Онлайн-присутність — наш пріоритет.'],
                ['title' => 'Дизайн та UI/UX', 'text' => 'Створюємо інтерфейси, які не лише привабливі, а й зручні для користувачів.'],
                ['title' => 'SEO та підтримка', 'text' => 'Покращуємо видимість у Google і забезпечуємо технічний супровід після запуску.']
            ];
            foreach ($services as $service): ?>
                <div class="col-12 col-md-4">
                    <img src="/assets/images/previews/col-2.jpg" alt="<?= $service['title'] ?>">
                    <div class="mt-4">
                        <h4 class="fw-normal"><?= $service['title'] ?></h4>
                        <p><?= $service['text'] ?></p>
                        <a class="button-text-1 mt-4" href="#">Дізнатися більше</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>