<h2>Games</h2>
<p>
    <a href="upload-game.php">Upload game</a>
</p>
<form method="GET">
    <label for="search">Search</label>
    <input id="search" name="search" type="search"
        value="<?= htmlspecialchars($controller->getSearch(), ENT_QUOTES) ?>">
    <button type="button" id="search-btn" class="btn">Search</button>
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
<?php
$games = $controller->getGames();
$currentPage = $controller->getCurrentPage();
$lastPage = $controller->getLastPage();
$showAuthor = true;
$userId = $controller->getUser()?->getId() ?? 0;
?>
<?php include(VIEW_PATH . '/games/components/game-list.php'); ?>