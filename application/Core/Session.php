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

}
