<?php

use Evans\Models\Entity;
use Evans\Models\Document;
use Evans\Models\Friend;
use Evans\Models\Format;

/**
 * Get the url for an entity
 *
 * @param Entity $entity
 * @return string
 */
function url(Entity $entity): string
{
    switch (get_class($entity)) {
        case Friend::class:
            return '/friend/' . $entity->getSlug();
        case Document::class:
            $friendSlug = $entity->getFriend()->getSlug();
            $documentSlug = $entity->getSlug();
            return "/{$friendSlug}/{$documentSlug}";
        case Format::class:
            $type = $entity->getType();
            $edition = $entity->getEdition();
            $document = $edition->getDocument();
            $editionType = $edition->getType();
            if (in_array($type, ['softcover', 'audio'], true)) {
                return url($document) . "/{$editionType}/{$type}";
            }
            return '/download' . url($document) . "/{$editionType}/{$type}";
        default:
            return '';
    }
}

/**
 * Transform a title into a filename
 *
 * @param string $title
 * @return string
 */
function filenameify(string $title): string
{
    $filename = preg_replace('/[^A-Za-z0-9 ]./', '', $title);
    $filename = preg_replace('/^The /', '', $filename);
    $filename = str_replace(' ', '_', $filename);
    return $filename;
}
