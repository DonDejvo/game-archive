<?php
$comments = $controller->getComments();
$currentPage = $controller->getCurrentPage();
$lastPage = (int)(max($controller->getCommentCount() - 1, 0) / $controller->getCommentsPerPage()) + 1;
?>
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
            <?php if($controller->getUser() != null): ?>
            <button class="btn game-details-btn" id="toggle-star-btn">
                <?= $controller->isStarred() ? 'Unstar' : 'Star' ?>
            </button>
            <?php endif; ?>
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
            <a href="<?= 'download-game.php?id=' . $controller->getGameId() ?>">Download source</a>
        </div>
        <h2>Comments</h2>
        <div>
            <?php if($controller->getUser() != null): ?>
            <form method="POST" class="form" action="<?= 'create-comment.php?gameId=' . $controller->getGameId() ?>">
                <div class="form-group">
                    <label for="message">Write comment</label>
                    <div class="form-control">
                        <textarea name="message" id="message" rows="4" cols="48" maxlength="1000" required></textarea>
                    </div>
                </div>
                <div>
                    <button name="create-comment" type="submit" class="btn">Post</button>
                </div>
            </form>
            <?php endif; ?>
            <ul class="comment-list">
            <?php if($controller->getCommentCount() > 0): ?>
                <?php foreach($comments as $comment): ?>
                <li class="comment">
                    <div class="comment__header">
                        <a class="comment__author" href="<?= 'profile.php?id=' . $comment['user_id'] ?>">
                            <?= htmlspecialchars($comment['username'], ENT_QUOTES) ?>
                        </a>
                        <span class="comment__date">
                            <?= date("m/d/Y", strtotime($comment['created_at'])) ?>
                        </span>
                    </div>
                    <div class="comment__body">
                        <div class="comment__message"><?= htmlspecialchars($comment['message'], ENT_QUOTES) ?></div>
                    </div>
                    <div>
                        <?php if($comment['user_id'] == $controller->getUser()?->getId() || $controller->getUserId() == $controller->getUser()?->getId()): ?>
                        <a class="delete-comment-btn" data-game-id="<?= $controller->getGameId() ?>" data-comment-id="<?= $comment['id'] ?>" href="#">Delete</a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="pagination-wrapper">
                <?php include(VIEW_PATH . '/partials/pagination.php'); ?>
            </div>
            <?php else: ?>
            <p>No comments yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php else: ?>
<h2>404 Game not found</h2>
<?php endif; ?>
</div>