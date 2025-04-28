<?php

declare(strict_types=1);

namespace Application\Providers;

use Application\Core\App;
use Application\Routing\Router;

/**
 * Class RouteServiceProvider
 *
 * Responsible for registering the application's routes.
 */
class RouteServiceProvider
{
    /**
     * Register the router and load route definitions.
     *
     * @return void
     */
    public function register(): void
    {
        $router = new Router();

        // Register the router in the service container
        App::set(Router::class, $router);

        // Load application routes
        require dirname(__DIR__, 2) . '/routes/web.php';
    }
}
