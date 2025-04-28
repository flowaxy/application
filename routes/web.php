<?php

declare(strict_types=1);

use Application\Controllers\SiteController;
use Application\Core\App;
use Application\Routing\Router;

/**
 * Define web routes for the application.
 *
 * Here we bind the routes to their corresponding controllers and actions.
 */

// Retrieve the router instance from the application container
$router = App::get(Router::class);

// Define the homepage route
$router->get('/', [SiteController::class, 'index']);
