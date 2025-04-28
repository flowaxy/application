<?php

declare(strict_types=1);

if (!function_exists('view')) {
    /**
     * Render a view template with provided data.
     *
     * This function extracts the given data array into variables
     * and includes the corresponding PHP view file.
     *
     * @param string $view The name of the view (dot notation supported, e.g., 'auth.login').
     * @param array $data An associative array of data to pass to the view.
     *
     * @return void
     */
    function view(string $view, array $data = []): void
    {
        extract($data);

        $path = dirname(__DIR__, 3) . '/resources/views/' . str_replace('.', '/', $view) . '.php';

        if (file_exists($path)) {
            include $path;
        } else {
            echo "View [$view] not found.";
        }
    }
}
