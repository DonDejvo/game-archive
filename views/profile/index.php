<?php if($controller->getUserId() != null): ?>
<h2>
    <?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>
</h2>
Register date: <span>
    <?= date("m/d/Y", strtotime($controller->getRegisterDate())) ?>
</span>
<br />
Bio: <p class="profile__bio">
    <?= htmlspecialchars($controller->getBio(), ENT_QUOTES) ?>
</p>
<?php if($controller->getUserId() == $controller->getUser()?->getId()): ?>
<a href="edit-profile.php">Edit profile</a>
<br />
<?php endif; ?>
<h3>Games</h3>
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