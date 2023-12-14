<span class="brand">Games</span>

<div class="game-details-container">
<h1 class="title">Upload game</h1>

<?php if($controller->getSuccessMessage() != ""): ?>
<p class="text-success">
    <?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?>
</p>
<?php elseif($controller->getErrorMessage() != ""): ?>
<p class="text-error">
    <?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?>
</p>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data" class="form">
    <div class="form-group">
        <div class="cover-image-container">
            <img class="cover-image-container__image" alt="cover image" src="#" hidden />
        </div>
        <label for="cover-image">Cover Image</label>
        <div class="form-control required" data-error="<?= htmlspecialchars($controller->getCoverImageError(), ENT_QUOTES) ?>">
            <input id="cover-image" name="cover-image" type="file" required />
        </div>
        <ul>
            <li>Max image size 150KB</li>
            <li>Only JPG, JPEG or GIF</li>
        </ul>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <div class="form-control required" data-error="<?= htmlspecialchars($controller->getTitleError(), ENT_QUOTES) ?>">
            <input id="title" name="title" type="text" value="<?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>"
            required />
        </div>    
    </div>
    <div class="form-group">
        <label for="genre">Genre</label>
        <div class="custom-select">
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
        </div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <div class="form-control">
            <textarea id="description" name="description" rows="8" cols="48"
        maxlength="1000"><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="uploads">Uploads</label>
        <div class="form-control required" data-error="<?= htmlspecialchars($controller->getUploadsError(), ENT_QUOTES) ?>">
            <input id="uploads" name="uploads" type="file" required />
        </div>
        <ul>
            <li>Max file size 5MB</li>
            <li>Only ZIP or HTML</li>
        </ul>
    </div>
    <div>
        <button type="submit" class="btn">Upload</button>
    </div>
</form>
</div>