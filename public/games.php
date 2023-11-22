<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadGames();
        $controller->loadGameGenres();
        break;
}

echo $controller->gamesView();