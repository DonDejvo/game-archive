<?php

include("../vendor/bootstrap.php");

use App\Controllers\ProfileController;
use App\Middleware;

$controller = new ProfileController();

Middleware::protectedRoute();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->loadUserDetails($controller->getUser()->getId());
        $controller->loadParams();
        break;
    case 'POST':
        $controller->updateProfile();
        break;
}

echo $controller->editProfileView();