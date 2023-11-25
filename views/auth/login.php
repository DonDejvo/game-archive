<h2>Login</h2>
<form method="POST">
    <label for="username">Username</label>
    <input id="username" name="username" type="text"
        value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
    <span class="text-warn">* </span>
    <span class="text-error">
        <?= htmlspecialchars($controller->getUsernameError(), ENT_QUOTES) ?>
    </span>
    <br />
    <label for="password">Password</label>
    <input id="password" name="password" type="password" required />
    <span class="text-warn">* </span>
    <span class="text-error">
        <?= htmlspecialchars($controller->getPasswordError(), ENT_QUOTES) ?>
    </span>
    <br />
    <button type="submit" class="btn">Login</button>
</form>