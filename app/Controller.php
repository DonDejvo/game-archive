<?php

namespace App;

use App\Auth\AuthContext;

/**
 * Rodičovská třída pro kontrolery
 */
abstract class Controller {

    public function getUser() {
        return AuthContext::getUser();
    }

}