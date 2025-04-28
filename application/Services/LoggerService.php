<?php

declare(strict_types=1);

namespace Application\Services;

/**
 * Class LoggerService
 *
 * Advanced logger for writing log messages by levels,
 * depending on the application environment settings.
 *
 * @package Application\Services
 */
class LoggerService
{
    /**
     * @var string Base directory path for storing logs.
     */
    protected string $basePath;

    /**
     * @var string Log type (e.g., "app", "error").
     */
    protected string $type;

    /**
     * @var string Path to the current log file.
     */
    protected string $logPath;

    /**
     * @var bool Whether debug mode is enabled (from .env).
     */
    protected bool $debug;

    /**
     * LoggerService constructor.
     *
     * @param string $type The type/category of the logger (default: "app").
     */
    public function __construct(string $type = 'app')
    {
        $this->type = trim($type, '/');
        $this->basePath = dirname(__DIR__, 2) . '/storage/logs/' . $this->type;
        $this->prepareDirectory();
        $this->logPath = $this->basePath . '/' . date('Y-m-d') . '.log';
        $this->debug = env('APP_DEBUG', false);

        $this->clearOldLogs(30);
    }

    /**
     * Prepare the log directory if it does not exist.
     *
     * @return void
     */
    protected function prepareDirectory(): void
    {
        if (!is_dir($this->basePath)) {
            if (!mkdir($this->basePath, 0777, true) && !is_dir($this->basePath)) {
                throw new \RuntimeException(sprintf('Directory "%s" could not be created.', $this->basePath));
            }
        }
    }

    /**
     * Write a message to the log file.
     *
     * @param string $level The log level (INFO, DEBUG, WARNING, ERROR).
     * @param string $message The log message.
     * @param array $context Optional additional context data.
     *
     * @return void
     */
    public function log(string $level, string $message, array $context = []): void
    {
        if (!$this->debug && $level !== 'ERROR') {
            return;
        }

        $time = date('Y-m-d H:i:s');
        $contextStr = $context ? json_encode($context, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '';
        $formatted = "[{$time}] {$level}: {$message} {$contextStr}" . PHP_EOL;

        file_put_contents($this->logPath, $formatted, FILE_APPEND | LOCK_EX);
    }

    /**
     * Log an informational message.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->log('INFO', $message, $context);
    }

    /**
     * Log an error message.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->log('ERROR', $message, $context);
    }

    /**
     * Log a warning message.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->log('WARNING', $message, $context);
    }

    /**
     * Log a debug message.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->log('DEBUG', $message, $context);
    }

    /**
     * Delete log files older than the specified number of days.
     *
     * @param int $days Number of days to keep logs.
     *
     * @return void
     */
    protected function clearOldLogs(int $days): void
    {
        $files = glob($this->basePath . '/*.log');
        $expire = time() - ($days * 86400);

        foreach ($files as $file) {
            if (filemtime($file) < $expire) {
                @unlink($file);
            }
        }
    }
}
