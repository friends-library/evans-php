<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1><?= $document->getTitle() ?></h1>
            <h2>
                by <a href="/friend/<?= $document->getFriend()->getSlug() ?>">
                    <?= $document->getFriend()->getName() ?>
                </a>
            </h2>

            <p>
                <?= $document->getDescription() ?>
            </p>

            <h3>Editions:</h3>

            <?php foreach ($document->getEditions() as $edition): ?>
                <div>
                    <h4><?= $edition->getType() ?></h4>

                    <h3>Chapters:</h3>

                    <ul>
                        <?php foreach ($edition->getChapters() as $chapter): ?>
                            <li><?= $chapter->getTitle() ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <ul>
                        <?php foreach ($edition->getFormats() as $format): ?>
                            <li><?= $format->getType() ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<div>
