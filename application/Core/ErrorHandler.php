<?php

declare(strict_types=1);

namespace Application\Core;

/**
 * Class ErrorHandler
 *
 * Centralized error and exception handling for the application.
 * 
 * Supports detailed debug output in development mode and user-friendly error pages in production.
 */
class ErrorHandler
{
    /**
     * Register global error and exception handlers.
     *
     * Should be called during the application bootstrap process.
     *
     * @return void
     */
    public static function register(): void
    {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
    }

    /**
     * Handle standard PHP errors.
     *
     * @param int    $errno   The level of the error raised.
     * @param string $errstr  The error message.
     * @param string $errfile The filename where the error was raised.
     * @param int    $errline The line number where the error was raised.
     *
     * @return void
     */
    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): void
    {
        $isDebug = env('APP_DEBUG', false);

        if ($isDebug) {
            self::renderDebugError([
                'type'    => 'Error',
                'message' => $errstr,
                'file'    => $errfile,
                'line'    => $errline,
            ]);
        } else {
            self::renderErrorPage(500);
        }
    }

    /**
     * Handle uncaught exceptions.
     *
     * @param \Throwable $exception The uncaught exception instance.
     *
     * @return void
     */
    public static function handleException(\Throwable $exception): void
    {
        $isDebug = env('APP_DEBUG', false);

        if ($isDebug) {
            self::renderDebugError([
                'type'    => 'Exception',
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'trace'   => $exception->getTraceAsString(),
            ]);
        } else {
            self::renderErrorPage(500);
        }
    }

    /**
     * Render detailed error information for debugging.
     *
     * @param array $context Error context containing type, message, file, line, and optional trace.
     *
     * @return void
     */
    protected static function renderDebugError(array $context): void
    {
        http_response_code(500);

        echo "<h1 style='color: red;'>[{$context['type']}] An error occurred</h1>";
        echo "<p><strong>Message:</strong> {$context['message']}</p>";
        echo "<p><strong>File:</strong> {$context['file']}</p>";
        echo "<p><strong>Line:</strong> {$context['line']}</p>";

        if (isset($context['trace'])) {
            echo "<h3>Stack trace:</h3>";
            echo "<pre>{$context['trace']}</pre>";
        }

        exit;
    }

    /**
     * Render a user-friendly error page.
     *
     * @param int $statusCode HTTP status code (e.g., 404, 500).
     *
     * @return void
     */
    protected static function renderErrorPage(int $statusCode): void
    {
        http_response_code($statusCode);

        $errorPage = dirname(__DIR__, 2) . "/resources/views/errors/{$statusCode}.php";

        if (file_exists($errorPage)) {
            require $errorPage;
        } else {
            echo "<h1>Error {$statusCode}</h1>";
            echo "<p>Something went wrong.</p>";
        }

        exit;
    }
}
