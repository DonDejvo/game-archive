<?php

namespace App;

abstract class Model {

    protected Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

}