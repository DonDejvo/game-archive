<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Edit profile</h2>
        <?php if($controller->getSuccessMessage() != ""): ?>
            <p style="color: green;"><?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?></p>
        <?php elseif($controller->getErrorMessage() != ""): ?>
            <p style="color: red;"><?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
            <span>* <?= $controller->getUsernameError() ?></span>
            <br />
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" type="text" rows="8" cols="48"><?= htmlspecialchars($controller->getBio(), ENT_QUOTES) ?></textarea>
            <br />
            <button type="submit">Save</button>
        </form>
        <div>
            <a href="<?= 'profile.php?id=' . $controller->getUserId() ?>">Back to profile</a>
        </div>
    </div>
</body>
</html>