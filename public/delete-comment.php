<?php

include("../vendor/bootstrap.php");

use App\Controllers\GamesController;
use App\Middleware;

$controller = new GamesController();

Middleware::protectedRoute();

$commentId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : 0;

$controller->deleteComment($commentId, $gameId);