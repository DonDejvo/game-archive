<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <style>
        .pagination {
            padding: 0;
            list-style: none;
        }
        .pagination__item {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
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
            <br />
            <label for="filter">Filter</label>
            <select id="filter" name="filter">
                <?php
                foreach($controller->getFilterOptions() as $filterName => $filterValue) {
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
            <br />
            <button type="submit">Apply</button>
        </form>
        <table>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Last modified</th>
                <th>Stars</th>
            </tr>
            <?php foreach($controller->getGames() as $game): ?>
                <tr>
                    <td>
                        <img width="64" height="64" src="<?= 'uploads/games/' . $game['id'] . '/assets/' . $game['cover_image_url'] ?>" alt="cover image" />
                    </td>
                    <td>
                        <a href="<?= 'game-details.php?id=' . $game['id'] ?>"><?= $game['title'] ?></a>
                    </td>
                    <td>
                        <?= $game['genre_name'] ?>
                    </td>
                    <td>
                        <a href="<?= 'profile.php?id=' . $game['user_id'] ?>"><?= $game['username'] ?></a>
                    </td>
                    <td>
                        <?= date("m/d/Y", strtotime($game['updated_at'])) ?>
                    </td>
                    <td>0</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
        $currentPage = $controller->getCurrentPage(); 
        $lastPage = 10;
        include(VIEW_PATH . '/partials/pagination.php'); 
        ?>
    </div>
    <script>
        const paginationLinks = document.querySelectorAll(".pagination__item > a");
        for(let i = 0; i < paginationLinks.length; ++i) {
            const elem = paginationLinks[i];
            elem.addEventListener("click", () => changePage(elem.dataset.page));
        }
        function changePage(page) {
            const searchParams = new URLSearchParams(location.search);
            searchParams.set('page', page);
            location.search = searchParams.toString();
        }
    </script>
</body>
</html>