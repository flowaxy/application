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

}
