<h2>Edit game</h2>
<?php if($controller->getSuccessMessage() != ""): ?>
<p class="text-success">
    <?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?>
</p>
<?php elseif($controller->getErrorMessage() != ""): ?>
<p class="text-error">
    <?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?>
</p>
<?php endif; ?>
<h3>Details</h3>
<form method="POST" enctype="multipart/form-data">
    <label for="title">Title</label>
    <input id="title" name="title" type="text" value="<?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>"
        required />
    <span class="text-warn">* </span>
    <span class="text-error">
        <?= htmlspecialchars($controller->getTitleError(), ENT_QUOTES) ?>
    </span>
    <br />
    <label for="genre">Genre</label>
    <select id="genre" name="genre">
        <?php
                foreach($controller->getGameGenres() as $gameGenre) {
                    echo '<option value="' . 
                        $gameGenre['id'] . 
                        '" ' .
                        ($gameGenre['id'] == $controller->getGenreId() ? 'selected' : '') .
                        '>' . 
                        htmlspecialchars($gameGenre['name'], ENT_QUOTES) . 
                    '</option>';
                }
                ?>
    </select>
    <br />
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="8" cols="48"
        maxlength="1000"><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></textarea>
    <br />
    <button name="save-details" type="submit" class="btn">Save</button>
</form>
<h3>Cover image</h3>
<form method="POST" enctype="multipart/form-data">
    <div class="cover-image-container">
        <img class="cover-image-container__image"
            data-url="<?= 'uploads/games/' . $controller->getGameId() . '/assets/' . $controller->getCoverImageUrl() ?>"
            alt="cover image" src="#" hidden />
    </div>
    <label for="cover-image">Cover Image</label>
    <input id="cover-image" name="cover-image" type="file" required />
    <span class="text-warn">* </span>
    <span class="text-error">
        <?= htmlspecialchars($controller->getCoverImageError(), ENT_QUOTES) ?>
    </span>
    <br />
    <ul>
        <li>Max image size 50KB</li>
        <li>Only JPG, JPEG or GIF</li>
    </ul>
    <button name="update-cover-image" type="submit" class="btn">Change</button>
    <button id="reset-image-btn" type="reset" hidden class="btn">Reset</button>
</form>
<h3>Uploads</h3>
<form method="POST" enctype="multipart/form-data">
    <label for="uploads">Uploads</label>
    <input id="uploads" name="uploads" type="file" required />
    <span class="text-warn">* </span>
    <span class="text-error">
        <?= htmlspecialchars($controller->getUploadsError(), ENT_QUOTES) ?>
    </span>
    <br />
    <ul>
        <li>Max file size 5MB</li>
        <li>Only HTML</li>
    </ul>
    <button name="update-uploads" type="submit" class="btn">Upload</button>
</form>
<a href="<?= 'game-details.php?id=' . $controller->getGameId() ?>">Back to game</a>
<script src="js/cover-image.js"></script>