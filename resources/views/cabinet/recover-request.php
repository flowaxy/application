<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="mb-4 text-center">Восстановление пароля</h2>

    <form action="/cabinet/recover-request" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Введите ваш email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">Отправить ссылку</button>
    </form>
</div>