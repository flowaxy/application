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

        $this->view('cabinet/index');
    }
}
