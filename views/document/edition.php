<div class="document-edition">
    <h3><?= ucfirst($edition->getType()) ?> edition:</h3>
    <?php if ($edition->getDescription()) { ?>
        <p class="document-edition__description">
            <?= $edition->getDescription() ?>
        </p>
    <?php } ?>
    <p class="document-edition__stats">
        <span>
            <i class="fa fa-book"></i>
            <?= $edition->getPages() ?> pages
        </span>
        <span>
            <i class="fa fa-search"></i>
            <?= number_format($edition->getWordCount()) ?> words
        </span>
        <span>
            <i class="fa fa-clock-o"></i>
            <?= duration($edition->getSeconds()) ?>
        </span>
    </p>
    <h4>Formats:</h4>
    <ul class="document-edition__formats">
        <?php foreach ($edition->getFormats() as $format) : ?>
            <li class="document-edition__formats__format">
                <a href="<?= url($format) ?>">
                    <?= $format->getType() ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
