<?php

declare(strict_types=1);

# Bootstrap the application
use Application\Core\App;

# Autoload Composer dependencies
require __DIR__ . '/../vendor/autoload.php';

# Run the application
$app = new App();

$app->run();
