<?php

namespace Application\Core;

/**
 * Class Session
 *
 * Manages session data, flash messages, CSRF protection, and session regeneration.
 * Encapsulates PHP session handling with utility methods for secure and organized access.
 *
 * @package Application\Core
 */
class Session
{
    /**
     * Key used for storing flash messages in the session.
     */
    private const FLASH_KEY = '_flash';

    /**
     * Key used for storing the CSRF token in the session.
     */
    private const CSRF_TOKEN_KEY = '_csrf_token';

    /**
     * Starts the session if it has not already been started.
     *
     * @return void
     */
    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Stores a value in the session under the specified key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieves a value from the session by key.
     *
     * @param string $key
     * @param mixed|null $default Value to return if the key is not found.
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Removes a key and its associated value from the session.
     *
     * @param string $key
     * @return void
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Checks if a given key exists in the session.
     *
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Stores a flash message in the session.
     * Flash messages are removed after being read once.
     *
     * @param string $key
     * @param mixed $message
     * @return void
     */
    public static function flash(string $key, mixed $message): void
    {
        self::start();
        $_SESSION[self::FLASH_KEY][$key] = $message;
    }

    /**
     * Retrieves a flash message by key and removes it from the session.
     *
     * @param string $key
     * @param mixed|null $default Value to return if the key is not found.
     * @return mixed
     */
    public static function getFlash(string $key, mixed $default = null): mixed
    {
        self::start();
        $message = $_SESSION[self::FLASH_KEY][$key] ?? $default;

        if (isset($_SESSION[self::FLASH_KEY][$key])) {
            unset($_SESSION[self::FLASH_KEY][$key]);
        }

        return $message;
    }

    /**
     * Generates and stores a CSRF token if it doesn't already exist.
     *
     * @return string The CSRF token.
     * @throws \Exception If random_bytes fails.
     */
    public static function generateToken(): string
    {
        self::start();
        if (!isset($_SESSION[self::CSRF_TOKEN_KEY])) {
            self::set(self::CSRF_TOKEN_KEY, bin2hex(random_bytes(32)));
        }

        return self::get(self::CSRF_TOKEN_KEY);
    }

    /**
     * Validates a CSRF token against the one stored in the session.
     *
     * @param string $token
     * @return bool
     */
    public static function checkToken(string $token): bool
    {
        self::start();
        return self::has(self::CSRF_TOKEN_KEY) && hash_equals(self::get(self::CSRF_TOKEN_KEY), $token);
    }

}
