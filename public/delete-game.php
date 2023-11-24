<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->deleteGame($_GET['id']);
        break;
}

echo $controller->deleteGameView();