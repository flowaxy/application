<?php

declare(strict_types=1);

namespace Application\Middlewares;

/**
 * Class ExampleMiddleware
 *
 * Example middleware for processing logic before and after a request.
 */
class ExampleMiddleware implements MiddlewareInterface
{
    /**
     * Handle an incoming request and call the next middleware or final handler.
     *
     * @param callable $next The next middleware or controller action.
     * @return void
     */
    public function handle(callable $next): void
    {
        // Logic before the request is processed
        // For example: authentication check, logging, security measures, etc.
        // echo "Middleware: Before request handling.<br>";

        $next(); // Be sure to call the next layer!

        // Logic after the request is processed
        // For example: cleaning up, saving logs, adding response headers
        // echo "Middleware: After request handling.<br>";
    }
}
