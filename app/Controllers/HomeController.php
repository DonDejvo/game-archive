<?php

namespace App\Controllers;

use App\Controller;
use App\View;

/**
 * Kontroler pro domovskou stránku
 */
class HomeController extends Controller {

    /**
     * Vytvoří a vrátí view pro domovskou stránku
     */
    public function homeView(): string {
        return View::make("home/index", $this);
    }

}