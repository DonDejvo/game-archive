<?php

namespace App\Controllers;

use App\Controller;
use App\View;
use App\Models\GameModel;
use App\Models\GameGenreModel;
use App\Models\GameStarModel;
use App\Utils;

class GamesController extends Controller {

    private int $countPerPage = 10;

    private string $search;

    private int $page;

    private int $filter;

    private int $genre;

    private array $games = [];

    private int $gameCount = 0;

    private array $gameGenres = [];

    const MAX_COVER_IMAGE_SIZE = 50000;

    const COVER_IMAGE_FILE_TYPES = ["jpg", "jpeg", "gif"];

    const MAX_UPLOADS_SIZE = 5000000;

    const FILTER_OPTIONS = [
        'Most recent' => [1, false],
        'Most starred' => [2, false],
        'My games' => [3, true],
        'My stars' => [4, true],
    ];

    private ?int $gameId;

    private ?int $userId;

    private string $title;

    private string $titleError;

    private string $description;

    private string $uploadsError;

    private ?string $coverImageUrl;

    private string $coverImageError;

    private int $genreId;

    private ?string $genreName;

    private string $successMessage;

    private string $errorMessage;

    private int $starCount;

    private bool $starred;

    public function __construct() {

        $this->search = $_GET['search'] ?? "";
        $this->page = $_GET['page'] ?? 1;
        $this->filter = $_GET['filter'] ?? 1;
        $this->genre = $_GET['genre'] ?? 0;

        $this->gemeId = null;
        $this->userId = null;
        $this->title = "";
        $this->titleError = "";
        $this->description = "";
        $this->uploadsError = "";
        $this->coverImageUrl = null;
        $this->coverImageError = "";
        $this->genreId = 0;
        $this->genreName = null;
        $this->successMessage = "";
        $this->errorMessage = "";
        $this->starCount = 0;
        $this->starred = false;
    }

    public function loadGames() {
        $gameModel = new GameModel();

        $result = $gameModel->getByParams($this->search, $this->page, $this->countPerPage, $this->filter, $this->genre, $this->getUser()?->getId() ?? 0);
        $this->games = $result['data'];
        $this->gameCount = $result['count'];
    }

    public function loadGameGenres() {
        $gameGenreModel = new GameGenreModel();

        $this->gameGenres = $gameGenreModel->getAll();
    }

    public function uploadGame() {

        $gameModel = new GameModel();

        $this->titleError = "";
        $this->uploadsError = "";
        $this->coverImageError = "";
        $this->successMessage = "";
        $this->errorMessage = "";

        $success = true;

        $user = $this->getUser();
        if($user == null) {
            $this->errorMessage = 'Unauthorized 401';
            $success = false;
        }

        if($success) {
            $this->title = $_POST['title'];
            $this->description = $_POST['description'];
            $this->genreId = $_POST['genre'];

            if(empty($_POST['title'])) {
                $this->titleError = 'Field is required';
                $success = false;
            }

            $fileCoverImage = $_FILES['cover-image'];

            if ($fileCoverImage['error'] == 4 || ($fileCoverImage['size'] == 0 && $fileCoverImage['error'] == 0)) {
                $this->coverImageError = 'Field is required';
                $success = false;
            } else {
                $coverImageFileType =  strtolower(pathinfo($fileCoverImage['name'], PATHINFO_EXTENSION));
                $coverImageUrl = (string)time() . (string)rand(10, 100) . '.' .$coverImageFileType;

                $coverImageCheck = getimagesize($_FILES["cover-image"]["tmp_name"]);
                if($coverImageCheck == false) {
                    $this->coverImageError = 'File is not an image';
                    $success = false;
                } elseif(!in_array($coverImageFileType, self::COVER_IMAGE_FILE_TYPES)) {
                    $this->coverImageError = 'Only JPG, JPEG & GIF files allowed';
                    $success = false;
                } elseif($fileCoverImage['size'] > self::MAX_COVER_IMAGE_SIZE) {
                    $this->coverImageError = 'Image size exceeds limit of 30KB';
                    $success = false;
                }
            }

            $fileUploads = $_FILES['uploads'];

            if ($fileUploads['error'] == 4 || ($fileUploads['size'] == 0 && $fileUploads['error'] == 0)) {
                $this->uploadsError = 'Field is required';
                $success = false;
            } else {
                $uploadsFileType =  strtolower(pathinfo($fileUploads['name'], PATHINFO_EXTENSION));

                if($uploadsFileType != "html") {
                    $this->uploadsError = 'Only HTML files allowed';
                    $success = false;
                } elseif($fileUploads['size'] > self::MAX_UPLOADS_SIZE) {
                    $this->coverImageError = 'File size exceeds limit of 5MB';
                    $success = false;
                }
            }

            if($success) {
                $gameId = $gameModel->create(
                    $user->getId(), 
                    $this->title, 
                    $this->description, 
                    $this->genreId,
                    $coverImageUrl
                );
    
                $path = UPLOADS_PATH . "/games/{$gameId}";
    
                if(!mkdir($path, 0777, true)) {
                    die('Failed to create directories');
                }
    
                mkdir($path . "/assets");
    
                $coverImageDest = $path . "/assets/" . $coverImageUrl;
            
                move_uploaded_file($fileCoverImage['tmp_name'], $coverImageDest);
    
                mkdir($path . "/dist");
    
                $uploadsFileDist = $path . "/dist/index.html";
    
                move_uploaded_file($fileUploads['tmp_name'], $uploadsFileDist);

            }
        }

        if($success) {
            header("Location: game-details.php?id={$gameId}", true);
        } else {
            $this->errorMessage = 'Game details failed to save!';

            $title = urlencode($this->title);
            $description = urlencode($this->description);
            $titleError = urlencode($this->titleError);
            $uploadsError = urlencode($this->uploadsError);
            $coverImageError = urlencode($this->coverImageError);
            $errorMessage = urlencode($this->errorMessage);
            $successMessage = urlencode($this->successMessage);
            $location = "edit-game.php?id={$gameId}&title={$title}&description={$description}&genreId={$this->genreId}&titleError={$titleError}&uploadsError={$uploadsError}&coverImageError={$coverImageError}&errorMessage={$errorMessage}&successMessage={$successMessage}";
            header("Location: {$location}", true);
        }

    }

    public function loadGameDetails($gameId) {
        $gameModel = new GameModel();
        $gameStarModel = new GameStarModel();

        $data = $gameModel->getById($gameId);

        $user = $this->getUser();
        if($user != null) {
            $this->starred = $gameStarModel->exists($user->getId(), $gameId);
        }

        if($data != null) {
            $this->gameId = $data['id'];
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->userId = $data['user_id'];
            $this->userName = $data['username'];
            $this->coverImageUrl = $data['cover_image_url'];
            $this->genreId = $data['genre_id'];
            $this->genreName = $data['genre_name'];
            $this->createdAt = $data['created_at'];
            $this->updatedAt = $data['updated_at'];
            $this->starCount = $data['star_count'];
        }
    }

    public function loadParams() {
        if(isset($_GET['title'])) {
            $this->title = urldecode($_GET['title']);
        }
        if(isset($_GET['description'])) {
            $this->description = urldecode($_GET['description']);
        }
        if(isset($_GET['genreId'])) {
            $this->genreId = $_GET['genreId'];
        }
        if(isset($_GET['titleError'])) {
            $this->titleError = urldecode($_GET['titleError']);
        }
        if(isset($_GET['coverImageError'])) {
            $this->coverImageError = urldecode($_GET['coverImageError']);
        }
        if(isset($_GET['uploadsError'])) {
            $this->uploadsError = urldecode($_GET['uploadsError']);
        }
        if(isset($_GET['successMessage'])) {
            $this->successMessage = urldecode($_GET['successMessage']);
        }
        if(isset($_GET['errorMessage'])) {
            $this->errorMessage = urldecode($_GET['errorMessage']);
        }
    }

    public function deleteGame(int $gameId) {

        $gameModel = new GameModel();

        $game = $gameModel->getById($gameId);
        if($game == null) {
            $this->errorMessage = 'Resource not found 404';
            return;
        }

        $user = $this->getUser();
        if($user == null || $user->getId() != $game['user_id']) {
            $this->errorMessage = 'Unauthorized 401';
            return;
        }

        $gameModel->delete($gameId);

        $path = UPLOADS_PATH . "/games/{$gameId}";

        Utils::rrmdir($path);

        $this->successMessage = 'Game deleted successfully';
        
    }

    public function updateGame(int $gameId) {

        $this->titleError = "";
        $this->uploadsError = "";
        $this->coverImageError = "";
        $this->successMessage = "";
        $this->errorMessage = "";

        $success = true;

        $user = $this->getUser();
        if($user == null || $user->getId() != $this->userId) {
            $this->errorMessage = 'Unauthorized 401';
            $success = false;
        }

        if($success) {
            if(isset($_POST['save-details'])) {
                $success = $this->updateDetails($gameId);
            } elseif(isset($_POST['update-cover-image'])) {
                $success = $this->updateCoverImage($gameId);
            } elseif(isset($_POST['update-uploads'])) {
                $success = $this->updateUploads($gameId);
            }
        }

        $title = urlencode($this->title);
        $description = urlencode($this->description);
        $titleError = urlencode($this->titleError);
        $uploadsError = urlencode($this->uploadsError);
        $coverImageError = urlencode($this->coverImageError);
        $errorMessage = urlencode($this->errorMessage);
        $successMessage = urlencode($this->successMessage);
        $location = "edit-game.php?id={$gameId}&title={$title}&description={$description}&genreId={$this->genreId}&titleError={$titleError}&uploadsError={$uploadsError}&coverImageError={$coverImageError}&errorMessage={$errorMessage}&successMessage={$successMessage}";
        header("Location: {$location}", true);
    }

    public function updateDetails(int $gameId) {
        $gameModel = new GameModel();
        $success = true;

        $this->title = $_POST['title'];
        $this->description = $_POST['description'];
        $this->genreId = $_POST['genre'];

        if(empty($_POST['title'])) {
            $this->titleError = 'Field is required';
            $success = false;
        }

        if($success) {
            $gameModel->update($gameId, $this->title, $this->description, $this->genreId, $this->coverImageUrl);
            $this->successMessage = 'Game details saved successfully!';
        } else {
            $this->errorMessage = 'Game details failed to save!';
        }

        return $success;
    }

    public function updateCoverImage(int $gameId) {
        $gameModel = new GameModel();
        $success = true;

        $fileCoverImage = $_FILES['cover-image'];

        if ($fileCoverImage['error'] == 4 || ($fileCoverImage['size'] == 0 && $fileCoverImage['error'] == 0)) {
            $this->coverImageError = 'Field is required';
            $success = false;
        } else {
            $coverImageFileType =  strtolower(pathinfo($fileCoverImage['name'], PATHINFO_EXTENSION));
            $coverImageUrl = (string)time() . (string)rand(10, 100) . '.' .$coverImageFileType;

            $coverImageCheck = getimagesize($_FILES["cover-image"]["tmp_name"]);
            if($coverImageCheck == false) {
                $this->coverImageError = 'File is not an image';
                $success = false;
            } elseif(!in_array($coverImageFileType, self::COVER_IMAGE_FILE_TYPES)) {
                $this->coverImageError = 'Only JPG, JPEG & GIF files allowed';
                $success = false;
            } elseif($fileCoverImage['size'] > self::MAX_COVER_IMAGE_SIZE) {
                $this->coverImageError = 'Image size exceeds limit of 30KB';
                $success = false;
            }
        }

        if($success) {
            $gameModel->update($gameId, $this->title, $this->description, $this->genreId, $coverImageUrl);

            $path = UPLOADS_PATH . "/games/{$gameId}";

            if(!is_dir($path . "/assets")) {
                if(!mkdir($path . "/assets", 0777, true)) {
                    die('Failed to create directories');
                }
            }

            $oldCoverImageDest = $path . "/assets/" . $this->coverImageUrl;

            if(file_exists($oldCoverImageDest)) {
                unlink($oldCoverImageDest);
            }

            $coverImageDest = $path . "/assets/" . $coverImageUrl;
        
            move_uploaded_file($fileCoverImage['tmp_name'], $coverImageDest);

            $this->coverImageUrl = $coverImageUrl;
            $this->successMessage = 'Cover image uploaded successfully!';
        } else {
            $this->errorMessage = 'Cover image failed to upload!';
        }

        return $success;
    }

    public function updateUploads(int $gameId) {
        $fileUploads = $_FILES['uploads'];
        $success = true;

        if ($fileUploads['error'] == 4 || ($fileUploads['size'] == 0 && $fileUploads['error'] == 0)) {
            $this->uploadsError = 'Field is required';
            $success = false;
        } else {
            $uploadsFileType =  strtolower(pathinfo($fileUploads['name'], PATHINFO_EXTENSION));

            if($uploadsFileType != "html") {
                $this->uploadsError = 'Only HTML files allowed';
                $success = false;
            }

            if($fileUploads['size'] > self::MAX_UPLOADS_SIZE) {
                $this->uploadsError = 'File size exceeds limit of 5MB';
                $success = false;
            }
        }

        if($success) {
            $path = UPLOADS_PATH . "/games/{$gameId}";

            if(!is_dir($path . "/dist")) {
                if(!mkdir($path . "/dist", 0777, true)) {
                    die('Failed to create directories');
                }
            }

            $uploadsFileDist = $path . "/dist/index.html";

            if(file_exists($uploadsFileDist)) {
                unlink($uploadsFileDist);
            }

            move_uploaded_file($fileUploads['tmp_name'], $uploadsFileDist);
            $this->successMessage = 'Uploads updated successfully!';
        } else {
            $this->errorMessage = 'Uploads failed to update!';
        }

        return $success;
    }

    public function toggleStar() {
        $gameStarModel = new GameStarModel();

        $success = true;
        $result = [ 'data' => null ];

        $user = $this->getUser();
        if($user == null) {
            $result['errorMessage'] = 'Unauthorized 401';
            $success = false;
        } elseif(empty($_POST['gameId'])) {
            $result['errorMessage'] = 'Some fields are missing';
            $success = false;
        }

        if($success) {
            $userId = $user->getId();
            $gameId = $_POST['gameId'];

            $starred = $gameStarModel->exists($userId, $gameId);
            if($starred) {
                $gameStarModel->delete($userId, $gameId);
            } else {
                $gameStarModel->create($userId, $gameId);
            }
            $result['data'] = [ 'starred' => $starred == false ];

            $this->starred = $starred == false;
        }

        echo json_encode($result);
    }

    public function gamesView(): string {
        return View::make('games/index', $this);
    }

    public function uploadGameView(): string {
        return View::make('games/upload', $this);
    }

    public function gameDetailsView(): string {
        return View::make('games/details', $this);
    }

    public function editGameView(): string {
        return View::make('games/edit', $this);
    }

    public function deleteGameView(): string {
        return View::make('games/delete', $this);
    }

    public function getGameId() {
        return $this->gameId;
    }

    public function getGames() {
        return $this->games;
    }

    public function getGameCount() {
        return $this->gameCount;
    }

    public function getGameGenres() {
        return $this->gameGenres;
    }

    public function getSearch() {
        return $this->search;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getCountPerPage() {
        return $this->countPerPage;
    }

    public function getFilterOptions() {
        return self::FILTER_OPTIONS;
    }

    public function getCurrentPage() {
        return $this->page;
    }

    public function getLastPage() {
        return (int)($this->gameCount / $this->countPerPage) + 1;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getTitleError() {
        return $this->titleError;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUploadsError() {
        return $this->uploadsError;
    }

    public function getCoverImageError() {
        return $this->coverImageError;
    }

    public function getCoverImageUrl() {
        return $this->coverImageUrl;
    }

    public function getGenreId() {
        return $this->genreId;
    }

    public function getGenreName() {
        return $this->genreName;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getSuccessMessage() {
        return $this->successMessage;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getStarCount() {
        return $this->starCount;
    }

    public function isStarred() {
        return $this->starred;
    }
}