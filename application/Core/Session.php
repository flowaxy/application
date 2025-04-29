<?php

namespace Application\Core;

class Session
{
    // Ключи для хранения флеш-сообщений и CSRF-токенов
    private const FLASH_KEY = '_flash';
    private const CSRF_TOKEN_KEY = '_csrf_token';

    // Запускаем сессию, если она ещё не была запущена
    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Устанавливаем значение в сессии по ключу
    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Получаем значение из сессии по ключу
    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    // Удаляем значение из сессии по ключу
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    // Проверяем, существует ли ключ в сессии
    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Сохраняем флеш-сообщение в сессии (сообщения исчезают после первого обращения)
    public static function flash(string $key, mixed $message): void
    {
        self::start();
        $_SESSION[self::FLASH_KEY][$key] = $message;
    }

    // Получаем и удаляем флеш-сообщение из сессии
    public static function getFlash(string $key, mixed $default = null): mixed
    {
        self::start();
        $message = $_SESSION[self::FLASH_KEY][$key] ?? $default;

        if (isset($_SESSION[self::FLASH_KEY][$key])) {
            unset($_SESSION[self::FLASH_KEY][$key]);
        }

        return $message;
    }

    // Генерация CSRF токена, если его нет в сессии
    public static function generateToken(): string
    {
        self::start();
        if (!isset($_SESSION[self::CSRF_TOKEN_KEY])) {
            // Генерация случайного токена, если его нет
            self::set(self::CSRF_TOKEN_KEY, bin2hex(random_bytes(32)));
        }

        return self::get(self::CSRF_TOKEN_KEY);
    }

    // Проверка CSRF токена с переданным значением
    public static function checkToken(string $token): bool
    {
        self::start();
        // Проверка на совпадение текущего токена с переданным
        return self::has(self::CSRF_TOKEN_KEY) && hash_equals(self::get(self::CSRF_TOKEN_KEY), $token);
    }

    // Регенирация ID сессии для предотвращения атак фиксации сессий
    public static function regenerate(): void
    {
        self::start();
        session_regenerate_id(true);
    }
}
