<?php

namespace App;

use PDO;
use App\Dotenv;

/**
 * Třída s jedinou instancí pokytující interface pro práci s databází v aplikaci
 */

class Database {

    private static ?Database $instance = null;

    private PDO $pdo;

    private function __construct() {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/..');

        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $dsn = "mysql:dbname={$dotenv->get('DB_NAME')};host={$dotenv->get('DB_HOST')}";
        $user = $dotenv->get('DB_USER');
        $password = $dotenv->get('DB_PASSWORD');

        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch(\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function __call(string $name, array $arguments) {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

    public static function getInstance(): Database {
        if(self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

}