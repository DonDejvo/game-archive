<?php

/**
 * Kořenový adresář pro nahrané soubory
 */
define("UPLOADS_PATH", __DIR__ . '/../public/uploads');
/**
 * Kořenový adresář pro view
 */
define("VIEW_PATH", __DIR__ . '/../views');

spl_autoload_register(function($class) {
    $path =  __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';

    if(file_exists($path)) {
        require $path;
    }
});

session_set_cookie_params([ 'secure' => true, 'httponly' => true ]);

session_start();