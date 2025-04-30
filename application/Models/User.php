<?php

namespace Application\Models;

use Application\Services\DatabaseService;

class User
{
    public static function findByIdentifier(string $identifier): ?array
    {
        $db = new DatabaseService();
        return $db->fetchOne('SELECT * FROM users WHERE email = :id OR username = :id', ['id' => $identifier]);
    }

    public static function emailExists(string $email): bool
    {
        $db = new DatabaseService();
        return $db->fetchOne('SELECT 1 FROM users WHERE email = :email', ['email' => $email]) !== null;
    }

    public static function usernameExists(string $username): bool
    {
        $db = new DatabaseService();
        return $db->fetchOne('SELECT 1 FROM users WHERE username = :username', ['username' => $username]) !== null;
    }

    public static function create(string $name, string $username, string $email, string $password): int
    {
        $db = new DatabaseService();
        return $db->insert('INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)', [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    }
}
