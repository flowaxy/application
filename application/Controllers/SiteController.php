<?php

declare(strict_types=1);

namespace Application\Controllers;

/**
 * Class SiteController
 *
 * Handles the main site pages.
 */
class SiteController
{
    /**
     * Display the homepage.
     *
     * @return void
     */
    public function index(): void
    {
        $title = 'Welcome to the framework';

        // Render the 'site.index' view with the provided title
        view('site.index', ['title' => $title]);
    }
}
