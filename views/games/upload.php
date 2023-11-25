<h2>Upload game</h2>
<?php if($controller->getSuccessMessage() != ""): ?>
<p class="text-success">
    <?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?>
</p>
<?php elseif($controller->getErrorMessage() != ""): ?>
<p class="text-error">
    <?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?>
</p>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data">
    <div class="cover-image-container">
        <img class="cover-image-container__image" alt="cover image" src="#" hidden />
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
    <button type="submit" class="btn">Upload</button>
</form>
<script src="js/cover-image.js"></script>