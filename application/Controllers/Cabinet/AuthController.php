<?php

namespace Application\Controllers\Cabinet;

use Application\Core\BaseController;

class AuthController extends BaseController
{
    public function login(): void
    {
        $this->view('cabinet/login');
    }

    public function register(): void
    {
        $this->view('cabinet/register');
    }

    public function logout(): void
    {
        $this->redirect('/cabinet/login');
    }
}
