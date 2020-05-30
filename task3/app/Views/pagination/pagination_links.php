
<?php
    $pager->setSurroundCount(1);
?>

<nav class="mt-2 mb-2">
    <ul class="pagination justify-content-center">

        <?php if ($pager->hasPreviousPage()) : ?>

            <li class="page-item">
                <a href="<?=$pager->getFirst() ?>" class="page-link">
                    first
                </a>
            </li>

            <li class="page-item">
                <a href="<?=$pager->getPreviousPage() ?>" class="page-link">
                    <
                </a>
            </li>

        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active page-item"' : 'page-item' ?>>
                <a href="<?= $link['uri'] ?>" class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>

            <li class="page-item">
                <a href="<?=$pager->getNextPage(); ?>" class="page-link">
                    >
                </a>
            </li>

            <li class="page-item">
                <a href="<?=$pager->getLast() ?>" class="page-link">
                    last
                </a>
            </li>

        <?php endif ?>

    </ul>
</nav>