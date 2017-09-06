<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>
                <?= $friend->getName() ?>
            </h1>

            <p>
                <?= $friend->getDescription() ?>
            </p>
        </div>
    </div>
    <hr class="divider-icon" />
    <div class="friend-documents row">
        <div class="col">
            <h2>
                Documents:
                <span class="badge">
                    <?= count($friend->getDocuments()) ?>
                </span>
            </h2>
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
