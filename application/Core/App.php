<?php

declare(strict_types=1);

namespace Application\Core;

use Application\Services\DatabaseService;
use Application\Services\LoggerService;
use Application\Providers\RouteServiceProvider;
use Application\Middlewares\MiddlewareInterface;
use Application\Routing\Router;

/**
 * Class App
 *
 * Core Application class responsible for bootstrapping and running the application.
 */
class App
{
    private DatabaseService $db;
    private LoggerService $logger;
    private static array $container = [];
    private array $middlewares = [];

    /**
     * App constructor.
     *
     * Initializes the application components.
     */
    public function __construct()
    {
        $this->loadEnvironment();
        $this->loadHelperFunctions();
        ErrorHandler::register();
        $this->connectDatabase();
        $this->registerServices();
        $this->registerProviders();
        $this->registerMiddlewares();
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
     * Load environment variables from .env file.
     */
    protected function loadEnvironment(): void
    {
        EnvLoader::load();
    }

    /**
     * Load all global helper functions.
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
     */
    protected function connectDatabase(): void
    {
        try {
            $this->db = new DatabaseService();
        } catch (\PDOException $e) {
            echo 'Failed to connect to the database: ' . $e->getMessage();
            exit(1);
        }
    }

    /**
     * Register core application services into the container.
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

    /**
     * Store a service in the container.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, mixed $value): void
    {
        self::$container[$key] = $value;
    }

    /**
     * Retrieve a service from the container.
     *
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key): mixed
    {
        return self::$container[$key] ?? null;
    }
}
