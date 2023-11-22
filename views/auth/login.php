<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Login</h2>
        <form method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required />
            <span>* <?= $controller->getUsernameError() ?></span>
            <br />
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required />
            <span>* <?= $controller->getPasswordError() ?></span>
            <br />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>