<?php

include("../vendor/bootstrap.php");

use App\Controllers\AuthController;
use App\Middleware;

Middleware::guestRoute();

$controller = new AuthController();

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->register();
        break;
}

echo $controller->registerView();