<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $controller->getUserId() != null ? "{$controller->getUsername()}'s profile" : "404 Profile not found" ?></title>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <?php if($controller->getUserId() != null): ?>
        <h2><?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?></h2>
        Registered from: <span><?= date("m/d/Y", strtotime($controller->getRegisterDate())) ?></span>
        <br />
        <p><?= htmlspecialchars($controller->getBio(), ENT_QUOTES) ?></p>
        <?php if($controller->getUserId() == $controller->getUser()?->getId()): ?>
            <a href="edit-profile.php">Edit profile</a>
        <?php endif; ?>
    <?php else: ?>
        <h2>404 Profile not found</h2>
    <?php endif; ?>
</body>
</html>