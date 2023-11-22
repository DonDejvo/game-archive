<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Register</h2>
        <form method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
            <span>* <?= $controller->getUsernameError() ?></span>
            <br />
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required />
            <span>* <?= $controller->getPasswordError() ?></span>
            <br />
            <label for="repeat-password">Repeat password</label>
            <input id="repeat-password" name="repeat-password" type="password" required />
            <span>* <?= $controller->getRepeatPasswordError() ?></span>
            <br />
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>