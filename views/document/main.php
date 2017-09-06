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

            <hr class="divider-icon" />

            <?php foreach ($document->getEditions() as $edition): ?>
                <?php view('document/edition', compact('edition')) ?>
            <?php endforeach; ?>
        </div>
    </div>
<div>
