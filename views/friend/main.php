<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>
                <a href="<?= url($friend) ?>">
                    <?= $friend->getName() ?>
                </a>
            </h1>

            <p>
                <?= $friend->getDescription() ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Documents:</h2>
            <?php foreach ($friend->getDocuments() as $document) { ?>
                <?php view('friend/document', [
                    'document' => $document,
                    'editions' => $document->getEditions(),
                    'formats' => $document->getUniqueFormatTypes(),
                ]) ?>
            <?php } ?>
        </div>
    </div>
<div>
