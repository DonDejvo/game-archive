<span class="brand">Games</span>

<div class="game-details-container">

<?php if($controller->getGameId() != null): ?>
<h1 class="title">
    <?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>
</h1>
<div class="game-details-row">
    <div class="game-details-row__cover-image">
        <div class="game-details__image-wrapper">
            <img src="<?= 'uploads/games/' . $controller->getGameId() . '/assets/' . $controller->getCoverImageUrl() ?>" alt="cover image" />
        </div>
    </div>
    <div class="game-details-row__details">
        <div class="game-details__description"><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></div>
        <div class="game-details-btn-wrapper">
            <a href="<?= 'uploads/games/' . $controller->getGameId() . '/dist/index.html' ?>" target="_blank" class="btn game-details-btn">Play</a>
            <button class="btn game-details-btn" id="toggle-star-btn">
                <?= $controller->isStarred() ? 'Unstar' : 'Star' ?>
            </button>
            <?php if($controller->getUserId() == $controller->getUser()?->getId()): ?>
                <a class="btn game-details-btn" href="<?= 'edit-game.php?id=' . $controller->getGameId() ?>">Edit</a>
            <?php endif; ?>
        </div>
        <h2>More information</h2>
        <ul class="game-details">
            <li>
            <span class="game-details-label">Genre</span>
                <span><?= htmlspecialchars($controller->getGenreName(), ENT_QUOTES) ?></span>
            </li>
            <li>
                <span class="game-details-label">Published</span>
                <span><?= date("m/d/Y", strtotime($controller->getCreatedAt())) ?></span>
            </li>
            <li>
                <span class="game-details-label">Last modified</span>
                <span><?= date("m/d/Y", strtotime($controller->getUpdatedAt())) ?></span>
            </li>
            <li>
                <span class="game-details-label">Stars</span>
                <div class="game-details__stars">
                    <span class="game-details__stars__star">★</span>
                    <span id="star-count" class="game-details__stars__count"><?= $controller->getStarCount() ?></span>
                </div>
            </li>
            <li>
                <span class="game-details-label">Author</span>
                <a href="<?= 'profile.php?id=' . $controller->getUserId() ?>">
    <?= htmlspecialchars($controller->getUserName(), ENT_QUOTES) ?>
</a>
            </li>
        </ul>
        <h2>Download</h2>
        <div>
            <a href="<?= 'uploads/games/' . $controller->getGameId() . '/dist/index.html' ?>"
            download="<?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) . '.html' ?>">Download source</a>
        </div>
    </div>
</div>
<?php else: ?>
<h2>404 Game not found</h2>
<?php endif; ?>
</div>
<script src="js/game-stars.js"></script>