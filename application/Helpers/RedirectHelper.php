<?php

namespace Application\Helpers;

use Application\Core\Session;

/**
 * Class RedirectHelper
 *
 * Provides methods for HTTP redirection with optional flash messaging.
 *
 * @package App\Helpers
 */
class RedirectHelper
{
    /**
     * Redirects the user to a specified URL and optionally sets a flash message.
     *
     * @param string $url The URL to redirect to.
     * @param string $message Optional message to be stored in session as flash data.
     * @param string $type The flash message type (e.g., 'error', 'success').
     * @return void
     */
    public static function redirect(string $url, string $message = '', string $type = 'error'): void
    {
        if ($message !== '') {
            Session::flash($type, $message);
        }
        header('Location: ' . $url);
        exit;
    }

    /**
     * Redirects the user back to the referring page and optionally sets a flash message.
     * Falls back to '/' if no referrer is available.
     *
     * @param string $message Optional message to be stored in session as flash data.
     * @param string $type The flash message type (e.g., 'error', 'success').
     * @return void
     */
    public static function redirectBack(string $message = '', string $type = 'error'): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        self::redirect($referer, $message, $type);
    }
}
