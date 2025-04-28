<?php

declare(strict_types=1);

namespace Application\Routing;

/**
 * Class Router
 *
 * Simple router class for handling HTTP requests.
 */
class Router
{
    protected array $routes = [];

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param array $action
     */
    public function get(string $uri, array $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param array $action
     */
    public function post(string $uri, array $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    /**
     * Add a new route.
     *
     * @param string $method
     * @param string $uri
     * @param array $action
     */
    protected function addRoute(string $method, string $uri, array $action): void
    {
        $this->routes[$method][$uri] = $action;
    }

    /**
     * Dispatch the incoming request.
     *
     * @param string $method
     * @param string $uri
     */
    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            [$controller, $methodAction] = $this->routes[$method][$uri];

            $controllerInstance = new $controller();
            call_user_func([$controllerInstance, $methodAction]);

            return;
        }

        // If route not found, render 404
        http_response_code(404);

        $errorPage = dirname(__DIR__, 2) . '/resources/views/errors/404.php';
        if (file_exists($errorPage)) {
            require $errorPage;
        } else {
            echo "<h1>404 Not Found</h1>";
        }

        exit;
    }
}
