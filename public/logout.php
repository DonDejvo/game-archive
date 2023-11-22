<?php

include("../vendor/bootstrap.php");

use App\Controllers\AuthController;
use App\Middleware;

$controller = new AuthController();

Middleware::protectedRoute();

$controller->logout();