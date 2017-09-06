<a href="<?= url($document) ?>" class="document-summary uk-card uk-card-default uk-card-body uk-card-hover uk-grid">
    <div class="uk-width-1-6" style="background-color: red">

    </div>
    <div class="uk-width-5-6">
        <h3 class="document-summary__title uk-card-title">
            <?= $document->getTitle() ?>
        </h3>
        <p class="document-summary__meta">
            <span class="document-summary__meta__editions">
                <?= compress_view('badges/mini-editions', compact('editions')) ?>
                <?= count($editions) ?>
                <?= count($editions) > 1 ? t('editions') : t('edition') ?>
            </span>
            <span class="document-summary__meta__formats">
                <?= compress_view('badges/mini-formats', compact('formats')) ?>
                <?= count($formats) ?>
                <?= count($formats) > 1 ? t('formats') : t('format') ?>
            </span>
            <span class="document-summary__meta__length">
                <i class="fa fa-clock-o"></i>
                <?= $document->getShortestEdition()->getPages() ?> pages
            </span>
        </p>
    </div>

</a>
