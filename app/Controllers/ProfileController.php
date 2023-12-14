<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Models\UserModel;
use App\Auth\AuthContext;
use App\Models\GameModel;

/**
 * Kontroler pro práci s uživatelským profilem
 */
class ProfileController extends Controller {

    private ?int $userId;

    private bool $active;

    private string $username;

    private ?string $bio;

    private ?string $registerDate;

    private string $usernameError;

    private string $successMessage;

    private string $errorMessage;

    private int $countPerPage = 6;

    private int $page;

    private array $games = [];

    private int $gameCount = 0;

    private string $activeTabName;

    private string $oldPasswordError;

    private string $passwordError;

    private string $repeatPasswordError;

    public function __construct() {
        $this->page = $_GET['page'] ?? 1;

        $this->userId = null;
        $this->active = false;
        $this->username = "";
        $this->bio = "";
        $this->registerDate = null;
        $this->usernameError = "";
        $this->successMessage = "";
        $this->errorMessage = "";
        $this->activeTabName = "details";
        $this->oldPasswordError = "";
        $this->passwordError = "";
        $this->repeatPasswordError = "";
    }

    /**
     * Načte detaily uživatele
     */
    public function loadUserDetails($userId) {
        $userModel = new UserModel();

        $data = $userModel->getById($userId);

        if($data != null && $data['active']) {
            $this->userId = $data['id'];
            $this->username = $data['username'];
            $this->bio = $data['bio'];
            $this->registerDate = $data['created_at'];
        }
    }

    /**
     * Načte URL parametry
     */
    public function loadParams() {
        if(isset($_GET['username'])) {
            $this->username = urldecode($_GET['username']);
        }
        if(isset($_GET['bio'])) {
            $this->bio = urldecode($_GET['bio']);
        }
        if(isset($_GET['usernameError'])) {
            $this->usernameError = urldecode($_GET['usernameError']);
        }
        if(isset($_GET['successMessage'])) {
            $this->successMessage = urldecode($_GET['successMessage']);
        }
        if(isset($_GET['errorMessage'])) {
            $this->errorMessage = urldecode($_GET['errorMessage']);
        }
        if(isset($_GET['oldPasswordError'])) {
            $this->oldPasswordError = $_GET['oldPasswordError'];
        }
        if(isset($_GET['passwordError'])) {
            $this->passwordError = $_GET['passwordError'];
        }
        if(isset($_GET['repeatPasswordError'])) {
            $this->repeatPasswordError = $_GET['repeatPasswordError'];
        }
        if(isset($_GET['activeTabName'])) {
            $this->activeTabName = $_GET['activeTabName'];
        }
    }

    /**
     * Načte hry uživatele
     */
    public function loadGames() {
        $gameModel = new GameModel();

        if($this->userId == null) {
            return;
        }

        $result = $gameModel->getByParams("", $this->page, $this->countPerPage, 3, 0, $this->userId);
        $this->games = $result['data'];
        $this->gameCount = $result['count'];
    }

    /**
     * Načte profil
     */
    public function loadProfile() {

        if(empty($_GET['id'])) {
            
            $user = $this->getUser();
            
            if($user == null) {
                header("Location: profile.php?id=1", true);
                return;
            }

            header("Location: profile.php?id={$user->getId()}", true);
            return;

        }

        $userId = $_GET['id'];

        $this->loadUserDetails($userId);
    }

    /**
     * Upraví a uloží uživatelský profil
     */
    public function updateProfile() {

        $this->usernameError = "";
        $this->successMessage = "";
        $this->errorMessage = "";
        $this->oldPasswordError = "";
        $this->passwordError = "";
        $this->repeatPasswordError = "";

        $success = true;
        $activeTabName = $this->activeTabName;

        $user = $this->getUser();
        if($user == null) {
            header("Location: login.php", true);
        }

        if($success) {
            if(isset($_POST['save-details'])) {
                $success = $this->updateDetails();
                $activeTabName = "details";
            } elseif(isset($_POST['change-password'])) {
                $success = $this->updatePassword();
                $activeTabName = "password";
            }
        }

        $username = urlencode($this->username);
        $bio = urlencode($this->bio);
        $usernameError = urlencode($this->usernameError);
        $oldPasswordError = urlencode($this->oldPasswordError);
        $passwordError = urlencode($this->passwordError);
        $repeatPasswordError = urlencode($this->repeatPasswordError);
        $errorMessage = urlencode($this->errorMessage);
        $successMessage = urlencode($this->successMessage);
        $location = "edit-profile.php?username={$username}&bio={$bio}&usernameError={$usernameError}&oldPasswordError={$oldPasswordError}&passwordError={$passwordError}&repeatPasswordError={$repeatPasswordError}&errorMessage={$errorMessage}&successMessage={$successMessage}&activeTabName={$activeTabName}";
        header("Location: {$location}", true);
    }

    /**
     * Upraví a uloží detaily uživatele
     */
    private function updateDetails() {
        $userModel = new UserModel();

        $user = $this->getUser();

        $this->username = $_POST['username'];
        $this->bio = $_POST['bio'];

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

        if($success) {
            $existingUser = $userModel->getByUsername($this->username);

            if($existingUser != null && $existingUser['id'] != $user->getId()) {
                $this->usernameError = 'This username is already used';
                $success = false;
            }
        }

        if($success) {
            $userModel->update($user->getId(), $this->username, $this->bio);
            AuthContext::logIn($userModel->getById($user->getId()));

            $this->successMessage = 'User details saved successfully!';
        } else {
            $this->errorMessage = 'User details failed to save!';
        }

        return $success;
        
    }

    /**
     * Změní heslo
     */
    private function updatePassword() {
        $userModel = new UserModel();

        $user = $this->getUser();

        $success = true;

        $oldPassword = $_POST['old-password'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat-password'];

        if(empty($_POST['old-password'])) {
            $this->oldPasswordError = 'Field is reuqired';
            $success = false;
        }

        if(empty($_POST['password'])) {
            $this->passwordError = 'Field is reuqired';
            $success = false;
        } else {
            $passwordLength = strlen($password);

            if($passwordLength < 8) {
                $this->passwordError = 'Password must have at least 8 characters';
                $success = false;
            }
        }

        if(empty($_POST['repeat-password'])) {
            $this->repeatPasswordError = 'Field is reuqired';
            $success = false;
        } else {
            if($password != $repeatPassword) {
                $this->repeatPasswordError = 'Passwords does not match';
                $success = false;
            }
        }

        if($success) {
            $existingUser = $userModel->getById($user->getId());

            if($existingUser == null || !password_verify($oldPassword, $existingUser['password'])) {
                $this->oldPasswordError = 'Password is not correct';
                $success = false;
                $this->errorMessage = "Password failed to change!";
            } else {
                $userModel->updatePassword($user->getId(), $password);
                $this->successMessage = "Password changed successfully!";
            }
        }

        return $success;
    }

    /**
     * Vytvoří a vrátí view pro uživatelský profil
     */
    public function profileView(): string {
        return View::make("profile/index", $this);
    }

    /**
     * Vytvoří a vrátí view pro upravování profilu
     */
    public function editProfileView(): string {
        return View::make("profile/edit", $this);
    }

    public function getUsernameError() {
        return $this->usernameError;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function getBio() {
        return $this->bio;
    }
    
    public function getRegisterDate() {
        return $this->registerDate;
    }

    public function getSuccessMessage() {
        return $this->successMessage;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getGames() {
        return $this->games;
    }

    public function getGameCount() {
        return $this->gameCount;
    }

    public function getCurrentPage() {
        return $this->page;
    }

    public function getLastPage() {
        return (int)(max($this->gameCount - 1, 0) / $this->countPerPage) + 1;
    }

    public function getActiveTabName() {
        return $this->activeTabName;
    }

    public function getPasswordError() {
        return $this->passwordError;
    }

    public function getRepeatPasswordError() {
        return $this->repeatPasswordError;
    }

    public function getOldPasswordError() {
        return $this->oldPasswordError;
    } 
}