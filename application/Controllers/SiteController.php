<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Core\BaseController;

class SiteController extends BaseController
{
    public function index(): void
    {
        $content = $this->view('site/index', [], true);
        $this->view('site/layouts/default', [
            'title' => 'Welcome to the framework',
            'content' => $content
        ]);
    }
}
