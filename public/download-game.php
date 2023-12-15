<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

$gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$controller->loadGameDetails($gameId);
$controller->downloadSource();