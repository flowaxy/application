<?php

declare(strict_types=1);

if (!function_exists('env')) {
    /**
     * Get environment variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, mixed $default = null): mixed
    {
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }

        $value = getenv($key);

        return $value !== false ? $value : $default;
    }
}
