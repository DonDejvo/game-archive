<span class="brand">Profile</span>

<div class="profile-container">

<h1 class="title">
    <?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>
</h1>

<div class="tabs" data-default-tab-name="<?= $controller->getActiveTabName() ?>">
    <div class="tabs__menu">
        <div class="tabs-menu-item" data-tab-name="details">Details</div>
        <div class="tabs-menu-item" data-tab-name="password">Password</div>
    </div>
    <div class="tabs__panels">

        <div data-tab-name="details">
            <h2>Details</h2>

            <?php if($controller->getActiveTabName() == "details"): ?>
            <?php if($controller->getSuccessMessage() != ""): ?>
            <p class="text-success">
                <?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?>
            </p>
            <?php elseif($controller->getErrorMessage() != ""): ?>
            <p class="text-error">
                <?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?>
            </p>
            <?php endif; ?>
            <?php endif; ?>

            <form class="form" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="form-control required" data-error="<?= htmlspecialchars($controller->getUsernameError(), ENT_QUOTES) ?>">
                        <input id="username" name="username" type="text"
                            value="<?= htmlspecialchars($controller->getUsername(), ENT_QUOTES) ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <div class="form-control">
                        <textarea id="bio" name="bio" rows="8" cols="48"
                            maxlength="1000"><?= htmlspecialchars($controller->getBio(), ENT_QUOTES) ?></textarea>
                    </div>
                </div>

                <div>
                    <button name="save-details" type="submit" class="btn">Save</button>
                    <a href="edit-profile.php?activeTabName=details" class="btn">Reset</a>    
                </div>
    
            </form>
        </div>

        <div data-tab-name="password">
            <h2>Password</h2>

            <?php if($controller->getActiveTabName() == "password"): ?>
            <?php if($controller->getSuccessMessage() != ""): ?>
            <p class="text-success">
                <?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?>
            </p>
            <?php elseif($controller->getErrorMessage() != ""): ?>
            <p class="text-error">
                <?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?>
            </p>
            <?php endif; ?>
            <?php endif; ?>
            
            <form class="form" method="POST">
            <div class="form-group">
                <label for="old-password">Old password</label>
                <div class="form-control required" data-error="<?= htmlspecialchars($controller->getOldPasswordError(), ENT_QUOTES) ?>">
                    <input id="old-password" name="old-password" type="password" required />
                </div>
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <div class="form-control required" data-error="<?= htmlspecialchars($controller->getPasswordError(), ENT_QUOTES) ?>">
                    <input id="password" name="password" type="password" required />
                </div>
            </div>
            <div class="form-group">
                <label for="repeat-password">Repeat new password</label>
                <div class="form-control required" data-error="<?= htmlspecialchars($controller->getRepeatPasswordError(), ENT_QUOTES) ?>">
                    <input id="repeat-password" name="repeat-password" type="password" required />
                </div>
            </div>
            <div>
                <button name="change-password" type="submit" class="btn">Change password</button>
            </div>
            </form>
        </div>

    </div>
</div>

<div>
    <a href="<?= 'profile.php?id=' . $controller->getUserId() ?>">Back to profile</a>
</div>
</div>