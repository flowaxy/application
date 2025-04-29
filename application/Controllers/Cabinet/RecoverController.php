<?php

namespace Application\Controllers\Cabinet;

use Application\Core\BaseController;

class RecoverController extends BaseController
{
    public function request(): void
    {
        $this->view('cabinet/recover-request');
    }

    public function sent(): void
    {
        $this->view('cabinet/recover-sent');
    }

    public function reset(): void
    {
        $this->view('cabinet/recover-reset');
    }

    public function done(): void
    {
        $this->view('cabinet/recover-done');
    }
}
