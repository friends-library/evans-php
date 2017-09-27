<?php

use Evans\Models\Entity;
use Evans\Models\Document;
use Evans\Models\Friend;
use Evans\Models\Format;
use Evans\Models\Tag;

/**
 * Get the url for an entity
 *
 * @param Entity $entity
 * @param ?Entity $modifier
 * @return string
 */
function url(Entity $entity, ?Entity $modifier = null): string
{
    switch (get_class($entity)) {
        case Friend::class:
            return '/friend/' . $entity->getSlug();
        case Document::class:
            $friendSlug = $entity->getFriend()->getSlug();
            $documentSlug = $entity->getSlug();
            return "/{$friendSlug}/{$documentSlug}";
        case Tag::class:
            return '/tags/' . $entity->getName();
        case Format::class:
            $type = $entity->getType();
            $edition = $entity->getEdition();
            $document = $edition->getDocument();
            $editionType = $edition->getType();
            if (in_array($type, ['softcover', 'audio'], true)) {
                return url($document) . "/{$editionType}/{$type}";
            }
            $url = '/download' . url($document) . "/{$editionType}/{$type}";
            if ($modifier) {
                $url .= '/' . slugify($modifier->getTitle());
            }
            return $url;
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

/**
 * Transorm a title into a url slug
 *
 * @param string $string
 * @return string
 */
function slugify(string $string): string
{
    $string = str_replace(array( "'", "’" ), '', stripslashes($string));
    $string = strtolower(preg_replace('`[^A-Za-z0-9]+`', '-', $string));
    $string = preg_replace("/^the-/", '', $string);
    return trim($string, '-');
}
