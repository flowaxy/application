<?php require base_path('resources/views/cabinet/layouts/header.php'); ?>

<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="mb-4 text-center">Регистрация</h2>

    <form action="/cabinet/register" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Имя:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Пароль:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">Зарегистрироваться</button>
    </form>

    <div class="mt-3 text-center">
        <a href="/cabinet/login" class="text-decoration-none">Уже есть аккаунт?</a>
    </div>
</div>

<?php require base_path('resources/views/cabinet/layouts/footer.php'); ?>