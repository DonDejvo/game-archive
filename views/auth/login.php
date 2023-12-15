<div class="register-wrapper">
    <div class="register-container">
        <h2>Login</h2>
        <form class="form" id="login-form" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="form-control required" data-error="<?= htmlspecialchars($controller->getUsernameError(), ENT_QUOTES) ?>">
                    <input id="username" name="username" type="text"
                        value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="form-control required" data-error="<?= htmlspecialchars($controller->getPasswordError(), ENT_QUOTES) ?>">
                    <input id="password" name="password" type="password" required />
                </div>
            </div>
            <div>
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
        <p>Are you new? Register <a href="register.php">here</a></p>
    </div>
</div>