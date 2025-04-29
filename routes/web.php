<?php

declare(strict_types=1);

use Application\Controllers\SiteController;

return [
    // Homepage
    '/' => [SiteController::class, 'index'],
];
