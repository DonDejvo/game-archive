<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Models\UserModel;
use App\Auth\AuthContext;
use App\Models\GameModel;

class ProfileController extends Controller {

    private ?int $userId;

    private bool $active;

    private string $username;

    private ?string $bio;

    private ?string $registerDate;

    private string $usernameError;

    private string $successMessage;

    private string $errorMessage;

    private int $countPerPage = 10;

    private int $page;

    private array $games = [];

    private int $gameCount = 0;

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
    }

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
    }

    public function loadGames() {
        $gameModel = new GameModel();

        if($this->userId == null) {
            return;
        }

        $result = $gameModel->getByParams("", $this->page, $this->countPerPage, 3, 0, $this->userId);
        $this->games = $result['data'];
        $this->gameCount = $result['count'];
    }

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

    public function updateProfile() {
        $userModel = new UserModel();

        $this->usernameError = "";
        $this->successMessage = "";
        $this->errorMessage = "";

        $user = $this->getUser();
        if($user == null) {
            header("Location: login.php", true);
        }

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

            $successMessage = urlencode($this->successMessage);
            header("Location: edit-profile.php?successMessage={$successMessage}", true);
        } else {
            $this->errorMessage = 'User details failed to save!';

            $username = urlencode($this->username);
            $bio = urlencode($this->bio);
            $usernameError = urlencode($this->usernameError);
            $errorMessage = urlencode($this->errorMessage);
            header("Location: edit-profile.php?username={$username}&bio={$bio}&usernameError={$usernameError}&errorMessage={$errorMessage}", true);
        }
        
    }

    public function profileView(): string {
        return View::make("profile/index", $this);
    }

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
        return (int)($this->gameCount / $this->countPerPage) + 1;
    }
}