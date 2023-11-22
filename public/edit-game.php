<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

$controller->loadGameGenres();
$controller->loadGameDetails($_GET['id']);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadParams();
        break;
    case 'POST':
        $controller->updateGame($_GET['id']);
        break;
}

echo $controller->editGameView();