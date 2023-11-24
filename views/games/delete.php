<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Game</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php include(VIEW_PATH . '/partials/header.php'); ?>
    <div>
        <?php if($controller->getSuccessMessage() != ""): ?>
            <p class="text-success"><?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?></p>
        <?php elseif($controller->getErrorMessage() != ""): ?>
            <p class="text-error"><?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>