<?php

namespace Application\Services\Auth;

use Application\Core\Session;
use Application\Models\User;

class AuthService
{
    public function attempt(string $identifier, string $password): bool
    {
        $user = User::findByIdentifier($identifier);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('cabinet_user_id', $user['id']);
            Session::remove('_csrf_token');
            return true;
        }

        return false;
    }
}
