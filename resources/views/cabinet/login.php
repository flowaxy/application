<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="mb-4 text-center">Вход в кабинет</h2>

    <form action="/cabinet/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Пароль:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Войти</button>
    </form>

    <div class="mt-3 text-center">
        <a href="/cabinet/forgot-password" class="text-decoration-none">Забыли пароль?</a><br>
        <a href="/cabinet/register" class="text-decoration-none">Регистрация</a>
    </div>
</div>
