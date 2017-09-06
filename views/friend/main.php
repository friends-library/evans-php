<div class="uk-container">
    <h1 class="uk-heading-primary">
        <?= $friend->getName() ?>
    </h1>

    <p>
        <?= $friend->getDescription() ?>
    </p>

    <hr class="uk-divider-icon">

    <div class="friend-documents uk-background-secondary">
        <h2 class="uk-h3">
            Documents:
            <span class="uk-badge"><?= count($friend->getDocuments()) ?></span>
        </h2>
        <?php foreach ($friend->getDocuments() as $document) { ?>
            <?php view('friend/document', [
                'document' => $document,
                'editions' => $document->getEditions(),
                'formats' => $document->getUniqueFormatTypes(),
            ]) ?>
        <?php } ?>
    </div>
<div>
