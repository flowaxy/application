<?php

use Application\Controllers\SiteController;
use Application\Controllers\Cabinet\DashboardController as CabinetDashboardController;
use Application\Controllers\Cabinet\AuthController as CabinetAuthController;
use Application\Controllers\Cabinet\RecoverController as CabinetRecoverController;

return [
    // Homepage
    '/' => [SiteController::class, 'index'],

    // Client cabinet
    '/cabinet'                      => [CabinetDashboardController::class, 'index'],
    '/cabinet/login'                => [CabinetAuthController::class, 'login'],
    '/cabinet/register'             => [CabinetAuthController::class, 'register'],
    '/cabinet/logout'               => [CabinetAuthController::class, 'logout'],
    '/cabinet/recover-request'      => [CabinetRecoverController::class, 'request'],
    '/cabinet/recover-sent'         => [CabinetRecoverController::class, 'sent'],
    '/cabinet/recover-reset'        => [CabinetRecoverController::class, 'reset'],
    '/cabinet/recover-done'         => [CabinetRecoverController::class, 'done'],
];
