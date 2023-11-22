<div> 
    <ul class="pagination">
    <?php if($currentPage != 1): ?>
        <li class="pagination__item">
            <a href="javascript:void(0)" class="pagination-link" data-page="1">1</a>
        </li>
    <?php endif; ?>
    <?php if($currentPage > 3): ?>
        <li class="pagination__item">...</li>
    <?php endif; ?>
    <?php if($currentPage > 2): ?>
        <li class="pagination__item">
            <a href="javascript:void(0)" class="pagination-link" data-page="<?= $currentPage - 1 ?>"><?= $currentPage - 1 ?></a>
        </li>
    <?php endif; ?>
    <li class="pagination__item"><?= $currentPage ?></li>
    <?php if($lastPage - $currentPage > 1): ?>
        <li class="pagination__item">
            <a href="javascript:void(0)" class="pagination-link" data-page="<?= $currentPage + 1 ?>"><?= $currentPage + 1 ?></a>
        </li>
    <?php endif; ?>
    <?php if($lastPage - $currentPage > 2): ?>
        <li class="pagination__item">...</li>
    <?php endif; ?>
    <?php if($lastPage != $currentPage): ?>
        <li class="pagination__item">
            <a href="javascript:void(0)" class="pagination-link" data-page="<?= $lastPage ?>"><?= $lastPage ?></a>
        </li>
    <?php endif; ?>
    </ul>
</div>