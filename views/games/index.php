<?php
$games = $controller->getGames();
$currentPage = $controller->getCurrentPage();
$lastPage = $controller->getLastPage();
$showAuthor = true;
$userId = $controller->getUser()?->getId() ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <link rel="stylesheet" href="css/pagination.css" />
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Games</h2>
        <p>
            <a href="upload-game.php">Upload game</a>
        </p>
        <form method="GET">
            <label for="search">Search</label>
            <input id="search" name="search" type="search" value="<?= htmlspecialchars($controller->getSearch(), ENT_QUOTES) ?>">
            <button type="button" id="search-btn">Search</button>
            <br />
            <label for="filter">Filter</label>
            <select id="filter" name="filter">
                <?php
                foreach($controller->getFilterOptions() as $filterName => $filter) {
                    [$filterValue, $userRequired] = $filter;
                    if($userRequired && $controller->getUser() == null) {
                        continue;
                    }
                    echo '<option value="' . 
                        $filterValue . 
                        '" ' .
                        ($filterValue == $controller->getFilter() ? 'selected' : '') . 
                        '>' . 
                        htmlspecialchars($filterName, ENT_QUOTES) . 
                    '</option>';
                }
                ?>
            </select>
            <label for="genre">Genre</label>
            <select id="genre" name="genre">
                <option value="0">All</option>
                <?php
                foreach($controller->getGameGenres() as $gameGenre) {
                    echo '<option value="' . 
                        $gameGenre['id'] . 
                        '" ' .
                        ($gameGenre['id'] == $controller->getGenre() ? 'selected' : '') .
                        '>' . 
                        htmlspecialchars($gameGenre['name'], ENT_QUOTES) . 
                    '</option>';
                }
                ?>
            </select>
        </form>
        <?php include(VIEW_PATH . '/games/components/game-list.php'); ?>
    </div>
    <script src="js/pagination.js">
    </script>
</body>
</html>