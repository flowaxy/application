<?php

namespace Application\Core;

class EnvLoader
{
    /**
     * Load environment variables from a file.
     *
     * @param string|null $path Path to the .env file. If null, defaults to project root.
     */
    public static function load(?string $path = null): void
    {
        if ($path === null) {
            $path = dirname(__DIR__, 2) . '/.env';
        }

        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments and invalid lines
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            // Remove quotes if value is quoted
            if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                $value = substr($value, 1, -1);
            }

            // Cast common types (true, false, null, int, float)
            $value = self::castValue($value);

            // Set environment variables
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    /**
     * Attempt to cast the value to its appropriate type.
     *
     * @param string $value
     * @return mixed
     */
    protected static function castValue(string $value): mixed
    {
        $lower = strtolower($value);

        return match ($lower) {
            'true' => true,
            'false' => false,
            'null' => null,
            default => self::castNumber($value),
        };
    }

    /**
     * Cast numeric values to int or float if possible.
     *
     * @param string $value
     * @return string|int|float
     */
    protected static function castNumber(string $value): string|int|float
    {
        if (is_numeric($value)) {
            return str_contains($value, '.') ? (float) $value : (int) $value;
        }

        return $value;
    }
}
