<span class="brand">Games</span>
<h1 class="title">Game List</h1>

<div class="games-upload-btn-wrapper">
    <a class="btn" href="upload-game.php">Upload game</a>
</div>

<form method="GET" class="games-filter-widget">
    <div class="games-filter-widget-group">
        <label for="search"></label>
        <div class="form-control">
            <input id="search"  name="search" type="search" value="<?= htmlspecialchars($controller->getSearch(), ENT_QUOTES) ?>" placeholder="Search by title">
        </div>
        <button type="button" id="search-btn" class="btn">Search</button>
    </div>
    <div class="games-filter-widget-group">
        <label for="filter">Filter</label>
        <div class="custom-select">
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
        </div>
    </div>
    <div class="games-filter-widget-group">
    <label for="genre">Genre</label>
    <div class="custom-select">
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
    </div>
    </div>
</form>
<?php
$games = $controller->getGames();
$currentPage = $controller->getCurrentPage();
$lastPage = $controller->getLastPage();
$showAuthor = true;
$userId = $controller->getUser()?->getId() ?? 0;
?>
<?php include(VIEW_PATH . '/games/components/game-list.php'); ?>