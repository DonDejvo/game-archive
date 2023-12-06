<?php

namespace App;

use App\Auth\AuthContext;

/**
 * Statická třída middleware
 */

class Middleware {

    /**
     * Přesměruje na přihlašovací stránku pokud uživatel není přihlášen
     */
    public static function protectedRoute() {
        if(!AuthContext::isLogged()) {
            header("Location: login.php", true);
            exit();
        }
    }

    /**
     * Přesměruje na profilovou stránku pokud uživatel je přihlášen
     */
    public static function guestRoute() {
        if(AuthContext::isLogged()) {
            header("Location: profile.php", true);
            exit();
        }
    }

}