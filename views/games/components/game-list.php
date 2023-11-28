<div style="margin-top: 1.5rem;">
<?php if(count($games) > 0): ?>
    <div class="games-grid">
        <?php foreach($games as $game): ?>
            <div class="games-card">
                <div class="games-card-row">
                    <a class="games-card__image-wrapper" href="<?= 'game-details.php?id=' . $game['id'] ?>">
                        <img src="<?= 'uploads/games/' . $game['id'] . '/assets/' . $game['cover_image_url'] ?>" alt="cover image" />
                    </a>
                </div>
                <div class="games-card-row">
                    <span class="games-card__genre"><?= htmlspecialchars($game['genre_name'], ENT_QUOTES) ?></span>
                    <span>•</span>
                    <span class="games-card__date"><?= date("m/d/Y", strtotime($game['updated_at'])) ?></span>
                </div>
                <div class="games-card-row">
                    <a class="games-card__title" href="<?= 'game-details.php?id=' . $game['id'] ?>">
                        <?= htmlspecialchars($game['title'], ENT_QUOTES) ?>
                    </a>
                </div>
                <div class="games-card-row">
                    <a class="games-card__author" href="<?= 'profile.php?id=' . $game['user_id'] ?>">
                        <?= htmlspecialchars($game['username'], ENT_QUOTES) ?>
                    </a>
                    <div class="games-card__stars">
                        <span class="games-card__stars__star">★</span>
                        <span class="games-card__stars__count"><?= $game['star_count'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination-wrapper">
    <?php include(VIEW_PATH . '/partials/pagination.php'); ?>
    </div>
    <?php else: ?>
        <div class="games-grid-empty">
            <p class="games-grid-empty__text">No matching results</p>
        </div>
    <?php endif; ?>
</div>
<script src="js/game-list.js"></script>
<script src="js/pagination.js"></script>