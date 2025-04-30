<?php

namespace Application\Controllers\Cabinet;

use Application\Core\BaseController;
use Application\Core\Session;

class DashboardController extends BaseController
{
    public function index(): void
    {
        if (!Session::has('cabinet_user_id')) {
            $this->redirect('/cabinet/login');
        }

        // Контент для главной страницы кабинета
        $content = $this->view('cabinet/index', [], true);

        // Передаем контент в общий шаблон layout
        $this->view('cabinet/layouts/default', ['content' => $content]);
    }
}
