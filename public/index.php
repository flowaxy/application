<?php

declare(strict_types=1);

# Autoload Composer dependencies
require __DIR__ . '/../vendor/autoload.php';

# Bootstrap the application
require __DIR__ . '/../application/Core/App.php';

# Run the application
$app = new \Application\Core\App();
$app->run();
