<?php

namespace Application\Controllers\Cabinet;

use Application\Core\BaseController;
use Application\Core\Session;
use Application\Models\User;
use Application\Services\Auth\AuthService;
use Application\Services\Auth\ThrottleService;

class AuthController extends BaseController
{
    private AuthService $authService;
    private ThrottleService $throttle;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->throttle = new ThrottleService();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['identifier'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $csrfToken = $_POST['_csrf_token'] ?? '';

            if (!$this->checkCsrfToken($csrfToken)) {
                $this->flash('error', 'Неверный CSRF токен.');
                $this->redirect('/cabinet/login');
                return;
            }

            if ($this->validateRequiredFields([$identifier, $password])) {
                $this->flash('error', 'Введите логин/email и пароль.');
                $this->redirect('/cabinet/login');
                return;
            }

            if ($this->throttle->isBlocked($identifier)) {
                $this->flash('error', 'Слишком много неудачных попыток. Попробуйте через 5 минут.');
                $this->redirect('/cabinet/login');
                return;
            }

            if ($this->authService->attempt($identifier, $password)) {
                $this->throttle->clearAttempts($identifier);
                $this->redirect('/cabinet');
                return;
            }

            $this->throttle->incrementAttempts($identifier);
            $remaining = $this->throttle->remainingAttempts($identifier);

            $message = 'Неверный логин/email или пароль.';
            if ($remaining > 0) {
                $message .= " Осталось попыток: {$remaining}.";
            } else {
                $message .= " Вы заблокированы на 5 минут.";
            }

            $this->flash('error', $message);
            $this->redirect('/cabinet/login');
            return;
        }

        $content = $this->view('cabinet/login', [], true);
        $this->view('cabinet/layouts/auth', ['content' => $content]);
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $csrfToken = $_POST['_csrf_token'] ?? '';

            if (!$this->checkCsrfToken($csrfToken)) {
                $this->flash('error', 'Неверный CSRF токен.');
                $this->redirect('/cabinet/register');
                return;
            }

            if ($this->validateRequiredFields([$name, $username, $email, $password])) {
                $this->flash('error', 'Все поля обязательны.');
                $this->redirect('/cabinet/register');
                return;
            }

            if (User::emailExists($email)) {
                $this->flash('error', 'Email уже используется.');
                $this->redirect('/cabinet/register');
                return;
            }

            if (User::usernameExists($username)) {
                $this->flash('error', 'Логин уже занят.');
                $this->redirect('/cabinet/register');
                return;
            }

            $userId = User::create($name, $username, $email, $password);
            Session::set('cabinet_user_id', $userId);
            $this->flash('success', 'Регистрация прошла успешно.');
            $this->redirect('/cabinet');
            return;
        }

        $content = $this->view('cabinet/register', [], true);
        $this->view('cabinet/layouts/auth', ['content' => $content]);
    }

    public function logout(): void
    {
        Session::remove('cabinet_user_id');
        Session::remove('_csrf_token');
        $this->redirect('/cabinet/login');
    }

    private function checkCsrfToken(string $token): bool
    {
        return Session::checkToken($token);
    }

    private function validateRequiredFields(array $fields): bool
    {
        return array_filter($fields, fn($f) => empty($f)) !== [];
    }
}
