<div class="register-wrapper">
    <div class="register-container">
        <h2>Register</h2>
        <form id="register-form" method="POST">

        </form>
    </div>
<div>
<script src="js/register.js"></script>


<form id="register-form" method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" type="text"
                value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
            <span class="text-warn">* </span>
        <span id="username-error" class="text-error">
        <?= htmlspecialchars($controller->getUsernameError(), ENT_QUOTES) ?>
    </span>
    <br />
    <label for="password">Password</label>
    <input id="password" name="password" type="password" required />
    <span class="text-warn">* </span>
    <span id="password-error" class="text-error">
        <?= htmlspecialchars($controller->getPasswordError(), ENT_QUOTES) ?>
    </span>
    <br />
    <label for="repeat-password">Repeat password</label>
    <input id="repeat-password" name="repeat-password" type="password" required />
    <span class="text-warn">* </span>
    <span id="repeat-password-error" class="text-error">
        <?= htmlspecialchars($controller->getRepeatPasswordError(), ENT_QUOTES) ?>
    </span>
    <br />
    <button type="submit" class="btn">Register</button>
</form>