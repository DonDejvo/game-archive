<?php

namespace App;

use App\Auth\AuthContext;

class Middleware {

    public static function protectedRoute() {
        if(!AuthContext::isLogged()) {
            header("Location: login.php", true);
            exit();
        }
    }

    public static function guestRoute() {
        if(AuthContext::isLogged()) {
            header("Location: profile.php", true);
            exit();
        }
    }

}