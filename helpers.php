<?php

use Evans\Models\Entity;
use Evans\Models\Document;
use Evans\Models\Friend;

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
        default:
            return '';
    }
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
