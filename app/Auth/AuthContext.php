<?php

namespace App\Auth;

class AuthContext {

    const SESSION_AUTH = "user";

    private ?User $user = null;

    private static ?AuthContext $instance = null;
    
    public static function getInstance(): AuthContext {
        if (self::$instance == null) {
            self::$instance = new AuthContext();
        } 
        return self::$instance;
    }
    
    private function __construct() {

        if (isset($_SESSION[self::SESSION_AUTH])) {
            $this->user = $_SESSION[self::SESSION_AUTH];
        }
    }
    
    public static function isLogged(): bool {

        $instance = self::getInstance();

        return $instance->user != null && $instance->user->isActive();
    }
    
    public static function logIn (array $data): bool {

        $instance = self::getInstance();

        session_regenerate_id();

        $user = new User($data['id'], $data['username'], $data['active']);

        $instance->user = $user;
        $_SESSION[self::SESSION_AUTH] = $user;

        if ($instance->user == null) {
            return false;
        }

        return $instance->user->isActive();
    }
    
    public static function getUser(): ?User {
        return self::getInstance()->user;
    }
    
    public static function logOut() {
        self::getInstance()->user = null;
        unset($_SESSION[self::SESSION_AUTH]);
    }
}
?>
