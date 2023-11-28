<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

$gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$controller->loadGameGenres();
$controller->loadGameDetails($gameId);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadParams();
        break;
    case 'POST':
        $controller->updateGame($gameId);
        break;
}

echo $controller->editGameView();