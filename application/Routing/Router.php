<?php

declare(strict_types=1);

namespace Application\Routing;

/**
 * Class Router
 *
 * Simple router class for handling HTTP requests with support for middleware and config-based routing.
 */
class Router
{
    /**
     * Dispatch the incoming request.
     *
     * @param string $method
     * @param string $uri
     */
    public function dispatch(string $method, string $uri): void
    {
        // Remove query string
        $uri = parse_url($uri, PHP_URL_PATH);
        // Load route definitions
        $routes = require base_path('/routes/web.php');

        // Support both exact route (e.g. '/') and method-prefixed routes (e.g. 'GET@/cabinet')
        $key = strtoupper($method) . '@' . $uri;
        $route = $routes[$key] ?? $routes[$uri] ?? null;

        if (!$route) {
            http_response_code(404);
            $errorPage = base_path('resources/views/errors/404.php');

            if (file_exists($errorPage)) {
                require $errorPage;
            } else {
                echo "<h1>404 Not Found</h1>";
            }

            return;
        }

        [$controllerClass, $methodName, $middlewares] = array_pad($route, 3, []);

        // Build middleware chain
        $middlewareChain = array_reduce(
            array_reverse($middlewares),
            function ($next, $middlewareClass) {
                return fn() => (new $middlewareClass())->handle($next);
            },
            function () use ($controllerClass, $methodName) {
                $controller = new $controllerClass();
                call_user_func([$controller, $methodName]);
            }
        );

        $middlewareChain();
    }
}
