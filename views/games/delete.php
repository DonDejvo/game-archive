<span class="brand">Games</span>

<?php if($controller->getSuccessMessage() != ""): ?>
    <p class="text-success"><?= htmlspecialchars($controller->getSuccessMessage(), ENT_QUOTES) ?></p>
<?php elseif($controller->getErrorMessage() != ""): ?>
    <p class="text-error"><?= htmlspecialchars($controller->getErrorMessage(), ENT_QUOTES) ?></p>
<?php endif; ?>