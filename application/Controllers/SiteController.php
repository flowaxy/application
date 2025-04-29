<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Core\BaseController;

/**
 * Class SiteController
 *
 * Handles the main site routes and displays the homepage.
 *
 * @package Application\Controllers
 */
class SiteController extends BaseController
{
    /**
     * Displays the homepage view.
     *
     * @return void
     */
    public function index(): void
    {
        $this->view('site/index', ['title' => 'Welcome to the framework']);
    }
}
