<?php

include("../vendor/bootstrap.php");

use App\Controllers\ProfileController;
use App\Middleware;

$controller = new ProfileController();

Middleware::protectedRoute();

$controller->loadUserDetails($controller->getUser()->getId());

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadParams();
        break;
    case 'POST':
        $controller->updateProfile();
        break;
}

echo $controller->editProfileView();