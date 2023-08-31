<div class="breadcrumbs">
    <?php foreach ($breadcrumbs as $index => $item) : ?>
        <?php if ($index) : ?>
            <span class="breadcrump-separator"> / </span>
        <?php endif; ?>
        <span class="breadcrump-item">
            <?php if (!empty($item['url'])) : ?>
                <a href="<?= $item['url'] ?>"><?= $item['display_name'] ?></a>
            <?php else : ?>
                <?= $item['display_name'] ?>
            <?php endif; ?>
        </span>
    <?php endforeach; ?>
</div>