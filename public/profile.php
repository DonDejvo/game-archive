<?php

include("../vendor/bootstrap.php");

use App\Controllers\ProfileController;
use App\Middleware;

$controller = new ProfileController();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadProfile();
        $controller->loadGames();
        break;
}

echo $controller->profileView();