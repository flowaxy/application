<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="mb-4 text-center">Вход</h2>

    <form action="/cabinet/login" method="POST">
        <!-- CSRF токен -->
        <input type="hidden" name="_csrf_token" value="<?= \Application\Core\Session::generateToken(); ?>">

        <div class="mb-3">
            <label for="identifier" class="form-label">Email или логин:</label>
            <input type="text" name="identifier" id="identifier" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Войти</button>
    </form>

    <div class="d-flex justify-content-between">
        <a href="/cabinet/register" class="text-decoration-none">Регистрация</a>
        <a href="/cabinet/recover-request" class="text-decoration-none">Забыли пароль?</a>
    </div>
</div>