<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="mb-4 text-center">Новый пароль</h2>

    <form action="/cabinet/recover-reset" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Повторите пароль:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Сменить пароль</button>
    </form>
</div>