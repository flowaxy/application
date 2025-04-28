<?php

declare(strict_types=1);

namespace Application\Services;

use PDO;
use PDOException;

/**
 * Class DatabaseService
 *
 * Provides database operations using PDO.
 */
class DatabaseService
{
    private PDO $connection;
    private LoggerService $logger;

}
