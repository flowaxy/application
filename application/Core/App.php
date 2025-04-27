<?php

declare(strict_types=1);

namespace Application\Core;

/**
 * Class App
 *
 * Core Application class responsible for bootstrapping and running the application.
 */
class App
{
    /**
     * App constructor.
     *
     * Initializes the application:
     * - Loads environment variables
     * - Loads global helper functions
     * - Connects to the database (TODO)
     * - Registers services (TODO)
     * - Loads application routes (TODO)
     */
    public function __construct()
    {
        $this->loadEnvironment();
        $this->loadHelperFunctions();
        $this->connectDatabase();      // (Optional: stub for future)
        $this->registerServices();
        $this->loadRoutes();
    }

    /**
     * Run the application.
     *
     * Dispatches the current HTTP request.
     */
    public function run(): void
    {
        // TODO: Implement request dispatcher (e.g., Router::dispatch())
    }

    /**
     * Load environment variables.
     */
    protected function loadEnvironment(): void
    {
        EnvLoader::load();
    }

    /**
     * Load all global helper functions.
     *
     * Recursively loads all PHP files from Helpers/Functions directory.
     */
    protected function loadHelperFunctions(): void
    {
        $functionsPath = dirname(__DIR__) . '/Helpers/Functions';

        if (!is_dir($functionsPath)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($functionsPath)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                require_once $file->getPathname();
            }
        }
    }

    /**
     * Connect to the database.
     *
     * (Currently a placeholder for future database connection logic.)
     */
    protected function connectDatabase(): void
    {
        // TODO: Database::connect();
    }

    /**
     * Register core application services.
     *
     * (Currently a placeholder for future service registration.)
     */
    protected function registerServices(): void
    {
        // TODO: Register service providers (e.g., AuthServiceProvider, EventServiceProvider)
    }

    /**
     * Load application route definitions.
     *
     * (Currently a placeholder for future route loading.)
     */
    protected function loadRoutes(): void
    {
        // TODO: Load route files from /routes directory
    }
}
