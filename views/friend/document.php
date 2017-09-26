<div class="document-summary">
    <h3 class="document-summary__title">
        <?= responsive_document_title($document) ?>
    </h3>
    <ul class="document-summary__meta">
        <?php if ($document->hasAudio()) { ?>
            <li>
                <i class="fa fa-headphones"></i>
                Audio Available
            </li>
        <?php } ?>
        <?php if ($document->hasModernizedEdition()) { ?>
            <li>
                <i class="fa fa-rocket"></i>
                Modern Available
            </li>
        <?php } ?>
        <li>
            <i class="fa fa-clock-o"></i>
            <?= $document->getShortestEdition()->getPages() ?> Pages
        </li>
        <li>
            <i class="fa fa-tags"></i>
            Journal and Letters
        </li>
    </ul>
    <a class="document-summary__link" href="<?= url($document) ?>">
        View Document &rarr;
    </a>
</div>
