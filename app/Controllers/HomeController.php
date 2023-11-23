<?php

namespace App\Controllers;

use App\Controller;
use App\View;

class HomeController extends Controller {

    public function homeView(): string {
        return View::make("home/index", $this);
    }

}