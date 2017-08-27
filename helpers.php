<?php

use Evans\Models\Entity;
use Evans\Models\Document;
use Evans\Models\Friend;
use Evans\Models\Format;
use Khill\Duration\Duration;

/**
 * Render a vew template
 *
 * @param string $template
 * @param array $vars
 * @return void
 */
function view(string $template, array $vars = []): void
{
    extract($vars);
    include APP_DIR . "views/{$template}.php";
}

/**
 * Render a vew template with basic whitespace stripping
 *
 * @param string $template
 * @param array $vars
 * @return void
 */
function compress_view(string $template, array $vars = []): void
{
    ob_start();
    view(...func_get_args());
    $markup = ob_get_clean();
    echo str_replace(["\n", "\t", '  '], '', $markup);
}

/**
 * Translate a string
 *
 * @param string $string
 * @return string
 */
function t(string $string): string
{
    return $string;
}

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
            if ($type === 'softcover') {
                return url($document) . "/{$editionType}/softcover";
            }
            $base = getenv('EXTERNAL_ASSET_URL_BASE') . url($document);
            $filename = filenameify($document->getTitle());
            return "{$base}/{$editionType}/{$filename}.{$type}";
        default:
            return '';
    }
}

/**
 * Get human readable audio duration from seconds
 *
 * @param int $seconds
 * @return string
 */
function duration(int $seconds): string
{
    $duration = new Duration($seconds);
    $human = $duration->humanize();
    return preg_replace('/ [0-9]+s$/', '', $human);
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
 * Gets the value of an environment variable.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env(string $key, $default = null)
{
    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return null;
    }

    return $value;
}
