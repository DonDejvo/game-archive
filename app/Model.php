<?php

namespace App;

/**
 * Rodičovská třída pro databázové modely
 */
abstract class Model {

    protected Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

}