<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Archive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300;400;500&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/print.css" media="print" />
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div class="content">
        <div id="lightbox" class="lightbox"></div>
        <div class="container">
            <?php include(VIEW_PATH . '/partials/sidebar.php'); ?>
            <main>
                <section>
                    <article><?php include($viewPath); ?></article>
                </section>
            </main>
        </div>
    </div>
    <script src="js/sidebar.js"></script>
    <script src="js/custom-select.js"></script>
    <script src="js/cover-image.js"></script>
    <script src="js/form-control.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/game-stars.js"></script>
    <script src="js/comments.js"></script>
    <script src="js/delete-game.js"></script>
    <script src="js/register.js"></script>
</body>
</html>