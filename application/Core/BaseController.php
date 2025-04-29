<?php

namespace Application\Core;

/**
 * Class BaseController
 *
 * Provides core controller functionality including view rendering, redirection,
 * form error handling, and preservation of old input values.
 *
 * @package Application\Core
 */
abstract class BaseController
{
    /**
     * Redirects the user to a specified URL.
     *
     * @param string $url The URL to redirect to.
     * @return void
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    /**
     * Loads and renders a view with the given data.
     *
     * @param string $path The relative path to the view file (without `.php` extension).
     * @param array $data Associative array of data to be extracted into the view.
     * @return void
     */
    protected function view(string $path, array $data = []): void
    {
        extract($data);
        require base_path("resources/views/{$path}.php");
    }

    /**
     * Stores validation errors in the session and redirects the user.
     *
     * @param array $errors An array of validation errors.
     * @param string $redirectTo URL to redirect the user to.
     * @return void
     */
    protected function withErrors(array $errors, string $redirectTo): void
    {
        $_SESSION['errors'] = $errors;
        $this->redirect($redirectTo);
    }

    /**
     * Retrieves previously submitted form data from the session.
     *
     * @param string $key The form input name.
     * @param string $default Default value if input is not found.
     * @return string
     */
    protected function old(string $key, string $default = ''): string
    {
        return $_SESSION['_old'][$key] ?? $default;
    }

    /**
     * Stores the current POST data in the session for later retrieval.
     *
     * @return void
     */
    protected function flashOld(): void
    {
        $_SESSION['_old'] = $_POST;
    }

    /**
     * Clears previously stored form input data from the session.
     *
     * @return void
     */
    protected function clearOld(): void
    {
        unset($_SESSION['_old']);
    }
}
