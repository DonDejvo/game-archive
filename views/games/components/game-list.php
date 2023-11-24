<?php if(count($games) > 0): ?>
<div>
    <table>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Genre</th>
            <?php if($showAuthor): ?>
            <th>Author</th>
            <?php endif; ?>
            <th>Last modified</th>
            <th>Stars</th>
            <th></th>
        </tr>
        <?php foreach($games as $game): ?>
            <tr>
                <td>
                    <img width="64" height="64" src="<?= 'uploads/games/' . $game['id'] . '/assets/' . $game['cover_image_url'] ?>" alt="cover image" />
                </td>
                <td>
                    <a href="<?= 'game-details.php?id=' . $game['id'] ?>"><?= htmlspecialchars($game['title'], ENT_QUOTES) ?></a>
                </td>
                <td>
                    <?= htmlspecialchars($game['genre_name'], ENT_QUOTES) ?>
                </td>
                <?php if($showAuthor): ?>
                <td>
                    <a href="<?= 'profile.php?id=' . $game['user_id'] ?>"><?= htmlspecialchars($game['username'], ENT_QUOTES) ?></a>
                </td>
                <?php endif; ?>
                <td>
                    <?= date("m/d/Y", strtotime($game['updated_at'])) ?>
                </td>
                <td><?= $game['star_count'] ?></td>
                <td>
                    <?php if($game['user_id'] == $userId): ?>
                        <button class="delete-btn">Delete</button>
                        <div class="delete-dialog" data-game-id="<?= $game['id'] ?>" hidden>
                            Are you sure?
                            <button class="confirm-delete-btn">Yes</button>
                            <button class="cancel-delete-btn">No</button>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
    include(VIEW_PATH . '/partials/pagination.php'); 
    ?>
    <?php else: ?>
        <h4>No matching results</h4>
    <?php endif; ?>
</div>
<script src="js/game-list.js"></script>