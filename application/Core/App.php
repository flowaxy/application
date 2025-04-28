<?php

declare(strict_types=1);

namespace Application\Core;

use Application\Services\DatabaseService;
use Application\Services\LoggerService;

/**
 * Class App
 *
 * Core Application class responsible for bootstrapping and running the application.
 */
class App
{
    private DatabaseService $db;
    private LoggerService $logger;

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
        ErrorHandler::register();
        $this->connectDatabase();
        $this->registerServices();
        $this->loadRoutes();
    }

    /**
     * Run the application.
     *
     * Executes the middleware stack and dispatches the router.
     */
    public function run(): void
    {
        $dispatcher = array_reduce(
            array_reverse($this->middlewares),
            function ($next, MiddlewareInterface $middleware) {
                return fn() => $middleware->handle($next);
            },
            function () {
                /** @var Router|null $router */
                $router = self::get(Router::class);

                $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
                $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

                if (!$router) {
                    http_response_code(500);
                    echo 'Router not found.';
                    return;
                }

                $router->dispatch($method, $uri);
            }
        );

        $dispatcher();
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
        try {
            $this->db = new DatabaseService();
        } catch (\PDOException $e) {
            echo 'Failed to connect to the database.';
            exit(1);
        }
    }

    /**
     * Register core application services.
     *
     * (Currently a placeholder for future service registration.)
     */
    protected function registerServices(): void
    {
        $this->logger = new LoggerService('application/register');

        self::set(LoggerService::class, $this->logger);
        self::set(DatabaseService::class, $this->db);
    }

    /**
     * Register all service providers.
     */
    protected function registerProviders(): void
    {
        (new RouteServiceProvider())->register();
    }

    /**
     * Register all global middlewares.
     */
    protected function registerMiddlewares(): void
    {
        $this->middlewares[] = new \Application\Middlewares\ExampleMiddleware();
    }
     */
    public static function get(string $key): mixed
    {
        return self::$container[$key] ?? null;
    }
}
