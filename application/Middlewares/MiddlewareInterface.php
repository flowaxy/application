<?php

declare(strict_types=1);

namespace Application\Middlewares;

/**
 * Interface MiddlewareInterface
 *
 * Defines the structure for a middleware component.
 */
interface MiddlewareInterface
{
    /**
     * Handle an incoming request and call the next middleware or final handler.
     *
     * @param callable $next The next middleware or controller action.
     * @return void
     */
    public function handle(callable $next): void;
}
