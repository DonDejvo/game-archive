<?php

include("../vendor/bootstrap.php");

use App\Controllers\HomeController;

$controller = new HomeController();

echo $controller->homeView();