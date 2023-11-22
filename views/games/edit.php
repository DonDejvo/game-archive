<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <style>
        .cover-image-container {
            width: 128px;
            height: 128px;
        }
        .cover-image-container__image {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <h2>Edit game</h2>
        <a href="<?= 'game-details.php?id=' . $controller->getGameId() ?>">Back to game</a>
        <?php if($controller->getSuccessMessage() != ""): ?>
            <p style="color: green;"><?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?></p>
        <?php elseif($controller->getErrorMessage() != ""): ?>
            <p style="color: red;"><?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?></p>
        <?php endif; ?>
        <h3>Details</h3>
        <form method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" value="<?= htmlspecialchars($controller->getTitle(), ENT_QUOTES) ?>" required />
            <span>* <?= $controller->getTitleError() ?></span>
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
            <textarea id="description" name="description" type="text" rows="8" cols="48"><?= htmlspecialchars($controller->getDescription(), ENT_QUOTES) ?></textarea>
            <br />
            <button name="save-details" type="submit">Save</button>
        </form>
        <h3>Cover image</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="cover-image-container">
                <img class="cover-image-container__image" data-url="<?= 'uploads/games/' . $controller->getGameId() . '/assets/' . $controller->getCoverImageUrl() ?>" alt="cover image" hidden />
            </div>
            <label for="cover-image">Cover Image</label>
            <input id="cover-image" name="cover-image" type="file" required />
            <span>* <?= $controller->getCoverImageError() ?></span>
            <br />
            <button name="update-cover-image" type="submit">Change</button>
            <button id="reset-image-btn" type="reset" hidden>Reset</button>
        </form>
        <h3>Uploads</h3>
        <form method="POST" enctype="multipart/form-data">
        <label for="uploads">Uploads</label>
            <input id="uploads" name="uploads" type="file" required />
            <span>* <?= $controller->getUploadsError() ?></span>
            <br />
            <button name="update-uploads" type="submit">Upload</button>
        </form>
    </div>
    <script>
        const coverImageInput = document.getElementById("cover-image");
        const coverImage = document.querySelector(".cover-image-container__image");
        const resetImageBtn = document.getElementById("reset-image-btn");

        coverImageInput.addEventListener("change", readFileToImage);
        if(resetImageBtn) {
            resetImageBtn.addEventListener("click", resetImage);
        }

        if(coverImage.dataset.url) {
            resetImage();
        }

        function readFileToImage() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    coverImage.hidden = false;
                    coverImage.src = e.target.result;
                    if(resetImageBtn) {
                        resetImageBtn.hidden = false;
                    }
                });
                reader.readAsDataURL(this.files[0]);
            }
        }

        function resetImage() {
            coverImage.src = coverImage.dataset.url;
            coverImage.hidden = false;
            resetImageBtn.hidden = true;
        }
    </script>
</body>
</html>