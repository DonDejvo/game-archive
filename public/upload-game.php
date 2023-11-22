<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

$controller->loadGameGenres();

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->uploadGame();
        break;
}

echo $controller->uploadGameView();