<span class="brand">Profile</span>

<div class="profile-container">
<?php if($controller->getUserId() != null): ?>
<h1 class="title">
    <?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>
</h1>
<div class="profile__bio__wrapper">
<div class="profile__bio"><?= htmlspecialchars($controller->getBio(), ENT_QUOTES) ?></div>
</div>
<div>
<?php if($controller->getUserId() == $controller->getUser()?->getId()): ?>
<a class="btn" href="upload-game.php">Upload game</a>
<a class="btn" href="edit-profile.php">Edit profile</a>
<?php endif; ?>
</div>
<h2 class="profile-games-title">Games</h2>
<?php
$games = $controller->getGames();
$currentPage = $controller->getCurrentPage();
$lastPage = $controller->getLastPage();
$showAuthor = false;
$userId = $controller->getUser()?->getId() ?? 0;
?>
<?php include(VIEW_PATH . '/games/components/game-list.php'); ?>
<?php else: ?>
<h2>404 Profile not found</h2>
<?php endif; ?>
</div>