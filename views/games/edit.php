<span class="brand">Games</span>

<div class="game-details-container">
<?php if($controller->getGameId() != null): ?>


<h1 class="title">
    <?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>
</h1>

<div class="tabs" data-default-tab-name="<?= $controller->getActiveTabName() ?>">
    <div class="tabs__menu">
        <div class="tabs-menu-item" data-tab-name="details">Details</div>
        <div class="tabs-menu-item" data-tab-name="cover-image">Cover image</div>
        <div class="tabs-menu-item" data-tab-name="uploads">Uploads</div>
        <div class="tabs-menu-item" data-tab-name="delete">Delete game</div>
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
            <form method="POST" enctype="multipart/form-data" class="form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="form-control required" data-error="<?= htmlspecialchars($controller->getTitleError(), ENT_QUOTES) ?>">
                        <input id="title" name="title" type="text" value="<?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <div class="custom-select">
                        <select id="genre" name="genre">
                        <?php
                        foreach($controller->getGameGenres() as $gameGenre) {
                            echo '<option value="' . $gameGenre['id'] . '" ' . 
                            ($gameGenre['id'] == $controller->getGenreId() ? 'selected' : '') . '>' . 
                            htmlspecialchars($gameGenre['name'], ENT_QUOTES) . 
                        '</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="form-control">
                        <textarea id="description" name="description" rows="8" cols="48" maxlength="1000"><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></textarea>
                    </div>
                </div>
                
                <div>
                    <button name="save-details" type="submit" class="btn">Save</button>
                    <a href="edit-game.php?id=<?= $controller->getGameId() ?>&activeTabName=details" class="btn">Reset</a>    
                </div>
            </form>
        </div>

        <div data-tab-name="cover-image">
            <h2>Cover image</h2>

            <?php if($controller->getActiveTabName() == "cover-image"): ?>
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
            <form method="POST" enctype="multipart/form-data" class="form">
                <div class="cover-image-container">
                    <img class="cover-image-container__image"
                        data-url="<?= 'uploads/games/' . $controller->getGameId() . '/assets/' . $controller->getCoverImageUrl() ?>"
                        alt="cover image" src="#" hidden 
                    />
                </div>
                <div class="form-group">
                    <label for="cover-image">Cover Image</label>
                    <div class="form-control required" data-error="<?= htmlspecialchars($controller->getCoverImageError(), ENT_QUOTES) ?>">
                        <input id="cover-image" name="cover-image" type="file" required />
                    </div>
                    <ul>
                        <li>Max image size 50KB</li>
                        <li>Only JPG, JPEG or GIF</li>
                    </ul>
                </div>
                <div>
                    <button name="update-cover-image" type="submit" class="btn">Change</button>
                    <button id="reset-image-btn" type="reset" hidden class="btn">Reset</button>
                </div>
            </form>
        </div>
        
        <div data-tab-name="uploads">
            <h2>Uploads</h2>

            <?php if($controller->getActiveTabName() == "uploads"): ?>
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
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-control" data-error="<?= htmlspecialchars($controller->getUploadsError(), ENT_QUOTES) ?>">
                        <label for="uploads">Uploads</label>
                        <input id="uploads" name="uploads" type="file" required />
                    </div>
                    <ul>
                        <li>Max file size 5MB</li>
                        <li>Only HTML</li>
                    </ul>
                </div>
                <div>
                    <button name="update-uploads" type="submit" class="btn">Upload</button>
                </div>
            </form>
        </div>

        <div data-tab-name="delete">
            <h2>Delete game</h2>

            <button class="btn delete-game-btn" data-game-id="<?= $controller->getGameId() ?>" href="#">Delete</button>
        </div>
    </div>
</div>
<div class="edit-game-back-btn-wrapper">
    <a href="<?= 'game-details.php?id=' . $controller->getGameId() ?>">Back to the game</a>
</div>
<?php else: ?>
<h2>404 Game not found</h2>
<?php endif; ?>
</div>