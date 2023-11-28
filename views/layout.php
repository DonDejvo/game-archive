<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300;400;500&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/main.css" />
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
    <script src="js/custom-select.js"></script>
</body>
</html>