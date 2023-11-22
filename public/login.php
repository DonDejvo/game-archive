<?php

include("../vendor/bootstrap.php");

use App\Controllers\AuthController;
use App\Middleware;

$controller = new AuthController();

Middleware::guestRoute();

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->login();
        break;
}

echo $controller->loginView();