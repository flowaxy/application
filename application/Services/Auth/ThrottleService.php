<?php

namespace Application\Services\Auth;

use Application\Services\DatabaseService;

class ThrottleService
{
    private const MAX_ATTEMPTS = 5;
    private const BLOCK_DURATION = 300; // 5 минут

    public function isBlocked(string $identifier): bool
    {
        $db = new DatabaseService();
        $user = $db->fetchOne(
            'SELECT login_attempts, last_attempt FROM users WHERE email = :id OR username = :id',
            ['id' => $identifier]
        );

        if ($user && $user['login_attempts'] >= self::MAX_ATTEMPTS && $user['last_attempt']) {
            return (time() - strtotime($user['last_attempt'])) < self::BLOCK_DURATION;
        }

        return false;
    }

    public function incrementAttempts(string $identifier): void
    {
        $db = new DatabaseService();
        $db->execute(
            'UPDATE users SET login_attempts = login_attempts + 1, last_attempt = NOW() WHERE email = :id OR username = :id',
            ['id' => $identifier]
        );
    }

    public function clearAttempts(string $identifier): void
    {
        $db = new DatabaseService();
        $db->execute(
            'UPDATE users SET login_attempts = 0, last_attempt = NULL WHERE email = :id OR username = :id',
            ['id' => $identifier]
        );
    }

    public function remainingAttempts(string $identifier): int
    {
        $db = new DatabaseService();
        $user = $db->fetchOne(
            'SELECT login_attempts FROM users WHERE email = :id OR username = :id',
            ['id' => $identifier]
        );

        $attempts = $user['login_attempts'] ?? 0;
        return max(0, self::MAX_ATTEMPTS - $attempts);
    }
}
