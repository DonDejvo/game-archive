<?php

namespace App;

use App\Auth\AuthContext;

abstract class Controller {

    public function getUser() {
        return AuthContext::getUser();
    }

}