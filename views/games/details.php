<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $controller->getGameId() != null ?  "{$controller->getTitle()}" : "404 Game not found" ?></title>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <?php if($controller->getGameId() != null): ?>
        <h2><?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?></h2>
        <img width="128" height="128" src="<?= 'uploads/games/' . $controller->getGameId() . '/assets/' . $controller->getCoverImageUrl() ?>" alt="cover image" />
        <br />
        Author: <a href="<?= 'profile.php?id=' . $controller->getUserId() ?>"><?= htmlspecialchars($controller->getUserName(), ENT_QUOTES) ?></a>
        <br />
        Genre: <span><?= htmlspecialchars($controller->getGenreName(), ENT_QUOTES) ?></span>
        <br />
        Upload date: <span><?= date("m/d/Y", strtotime($controller->getCreatedAt())) ?></span>
        <br />
        Last modified: <span><?= date("m/d/Y", strtotime($controller->getUpdatedAt())) ?></span>
        <br />
        <p><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></p>
        <a href="<?= 'uploads/games/' . $controller->getGameId() . '/dist/index.html' ?>" target="_blank">Play game</a>
        <div>
            <?php if($controller->getUserId() == $controller->getUser()?->getId()): ?>
                <a href="<?= 'edit-game.php?id=' . $controller->getGameId() ?>">Edit game</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <h2>404 Game not found</h2>
    <?php endif; ?>
</body>
</html>