<?php

namespace App;

use App\Exceptions\ViewNotFoundException;


/**
 * Třída pro vytvoření obsahu stránky 
 */
class View {

    public function __construct(
        private string $view,
        private mixed $controller
    ) {

    }

    public function __toString(): string {
        return $this->render();
    }

    public static function make(string $view, mixed $controller) {
        return new static($view, $controller);
    }

    /**
     * Vytvoří obsah pomocí templatu
     */
    public function render(): string {
        
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';
        $controller = $this->controller;

        if(!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        ob_start();

        include VIEW_PATH . '/layout.php';

        return (string) ob_get_clean();
    }

}