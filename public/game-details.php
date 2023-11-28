<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

$gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadGameDetails($gameId);
        break;
}

echo $controller->gameDetailsView();