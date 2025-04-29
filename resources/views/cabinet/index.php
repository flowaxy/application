<?php require base_path('resources/views/cabinet/layouts/header.php'); ?>

<div class="container py-5">
    <h2 class="mb-4">Добро пожаловать в личный кабинет</h2>
    <p>Вы успешно вошли в систему. Здесь будет доступна персональная информация и действия.</p>

    <form action="/cabinet/logout" method="POST" class="mt-4">
        <button type="submit" class="btn btn-danger">Выйти</button>
    </form>
</div>

<?php require base_path('resources/views/cabinet/layouts/footer.php'); ?>