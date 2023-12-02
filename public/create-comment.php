<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : 0;

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->createComment($gameId);
        break;
    default:
        echo 'Forbidden 403';
}