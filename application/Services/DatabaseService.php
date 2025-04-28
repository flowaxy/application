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

    /**
     * DatabaseService constructor.
     *
     * Initializes database connection and logger service.
     *
     * @throws PDOException If the database connection fails.
     */
    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $this->logger = new LoggerService('database');

        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            $this->connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            $this->logger->info('Database connection established successfully.');
        } catch (PDOException $e) {
            $this->logger->error('Failed to connect to the database.', [
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Executes a query and returns the first row.
     *
     * @param string $query The SQL query to execute.
     * @param array $params Query parameters.
     * @return array|null The first result row or null if none found.
     */
    public function fetchOne(string $query, array $params = []): ?array
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch() ?: null;
    }

    /**
     * Executes a query and returns all rows.
     *
     * @param string $query The SQL query to execute.
     * @param array $params Query parameters.
     * @return array List of all result rows.
     */
    public function fetchAll(string $query, array $params = []): array
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Executes a query and returns a single column value.
     *
     * @param string $query The SQL query to execute.
     * @param array $params Query parameters.
     * @return mixed The value of the first column of the first row.
     */
    public function fetchColumn(string $query, array $params = []): mixed
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}
