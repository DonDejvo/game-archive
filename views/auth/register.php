<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Register</h2>
        <form id="register-form" method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
            <span class="text-warn">* </span>
            <span id="username-error" class="text-error"><?= $controller->getUsernameError() ?></span>
            <br />
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required />
            <span class="text-warn">* </span>
            <span id="password-error" class="text-error"><?= $controller->getPasswordError() ?></span>
            <br />
            <label for="repeat-password">Repeat password</label>
            <input id="repeat-password" name="repeat-password" type="password" required />
            <span class="text-warn">* </span>
            <span id="repeat-password-error" class="text-error"><?= $controller->getRepeatPasswordError() ?></span>
            <br />
            <button type="submit">Register</button>
        </form>
    </div>
    <script src="js/register.js"></script>
</body>
</html>