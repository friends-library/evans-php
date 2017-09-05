<h5><?= $chapter->getTitle() ?></h5>
<ul class="chapter-formats">
    <?php foreach ($chapter->getFormats() as $format) : ?>
        <li class="chapter-formats__format">
            <a href="<?= url($format) ?>">
                <?= $format->getType() ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
