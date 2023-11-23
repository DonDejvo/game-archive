<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Models\UserModel;
use App\Auth\AuthContext;

class AuthController extends Controller {

    private string $username;

    private string $usernameError;

    private string $password;

    private string $passwordError;

    private string $repeatPassword;

    private string $repeatPasswordError;

    public function __construct() {
        $this->username = $_GET['username'] ?? "";
        $this->usernameError = $_GET['usernameError'] ?? "";
        $this->passwordError = $_GET['passwordError'] ?? "";
        $this->repeatPasswordError = $_GET['repeatPasswordError'] ?? "";
        $this->password = "";
        $this->repeatPassword = "";
    }

    public function register() {

        $userModel = new UserModel();

        $this->usernameError = "";
        $this->passwordError = "";
        $this->repeatPasswordError = "";

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $this->repeatPassword = $_POST['repeat-password'];

        $success = true;

        if(empty($_POST['username'])) {
            $this->usernameError = 'Field is reuqired';
            $success = false;
        } else {
            $usernameLength = strlen($this->username);

            if($usernameLength < 3 || $usernameLength > 20) {
                $this->usernameError = 'Username must have 3 - 20 characters';
                $success = false;
            }
        }

        if(empty($_POST['password'])) {
            $this->passwordError = 'Field is reuqired';
            $success = false;
        } else {
            $passwordLength = strlen($this->password);

            if($passwordLength < 8) {
                $this->passwordError = 'Password must have at least 8 characters';
                $success = false;
            }
        }

        if(empty($_POST['repeat-password'])) {
            $this->repeatPasswordError = 'Field is reuqired';
            $success = false;
        } else {
            if($this->password != $this->repeatPassword) {
                $this->repeatPasswordError = 'Passwords does not match';
                $success = false;
            }
        }

        if($success) {
            $existingUser = $userModel->getByUsername($this->username);

            if($existingUser != null) {
                $this->usernameError = 'This username is already used';
                $success = false;
            }
        }

        if($success) {
            $userId = $userModel->create($this->username, $this->password);

            $user = $userModel->getById($userId);

            if($user != null) {
                AuthContext::logIn($user);
            }

            header("Location: profile.php", true);
        } else {

            header("Location: register.php?username={$this->username}&usernameError={$this->usernameError}&passwordError={$this->passwordError}&repeatPasswordError={$this->repeatPasswordError}", true);
        }
    }

    public function login() {

        $userModel = new UserModel();

        $this->usernameError = "";
        $this->passwordError = "";
        $this->repeatPasswordError = "";

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];

        $success = true;

        if(empty($_POST['username'])) {
            $this->usernameError = 'Field is reuqired';
            $success = false;
        }

        if(empty($_POST['password'])) {
            $this->passwordError = 'Field is reuqired';
            $success = false;
        }

        if($success) {
            $user = $userModel->getByUsername($this->username);

            if($user == null || !password_verify($this->password, $user['password'])) {
                $this->usernameError = 'Username or password is not correct';
                $success = false;
            }
        }

        if($success) {
            AuthContext::logIn($user);

            header("Location: profile.php", true);
        } else {

            header("Location: login.php?username={$this->username}&usernameError={$this->usernameError}&passwordError={$this->passwordError}", true);
        }
    }

    public function logout() {

        AuthContext::logOut();

        header("Location: login.php", true);
    }

    public function registerView() {
        return View::make("auth/register", $this);
    }

    public function loginView() {
        return View::make("auth/login", $this);
    }

    public function getUsername() {
        return $this->username;
    }

    public function getUsernameError() {
        return $this->usernameError;
    }

    public function getPasswordError() {
        return $this->passwordError;
    }

    public function getRepeatPasswordError() {
        return $this->repeatPasswordError;
    }

}