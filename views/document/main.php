<div class="document uk-container">
    <h1 class="uk-heading-primary"><?= $document->getTitle() ?></h1>
    <h2 class="document__byline uk-h3">
        by <a href="/friend/<?= $document->getFriend()->getSlug() ?>">
            <?= $document->getFriend()->getName() ?>
        </a>
    </h2>

    <p>
        <?= $document->getDescription() ?>
    </p>

    <hr class="uk-divider-icon">

    <div class="document-editions">
        <?php foreach ($document->getEditions() as $edition): ?>
            <?php view('document/edition', compact('edition')) ?>
        <?php endforeach; ?>
    </div>
<div>
