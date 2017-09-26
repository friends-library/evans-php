<?php

use Evans\Models\Document;

/**
 * Render a view template
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
 * Render a view template with basic whitespace stripping
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
 * Get a document title wrapped with responsive markup for shortening
 * on small screens
 *
 * @param Document $document
 * @return string
 */
function responsive_document_title(Document $document): string
{
    $originalTitle = $document->getTitle();
    if (strlen($originalTitle) <= 35) {
        return $originalTitle;
    }

    $replace = '<span class="d-none d-sm-inline">$0</span>';
    $title = preg_replace('/^The /', $replace, $originalTitle);
    if (strlen($originalTitle) <= 39 && preg_match('/^The /', $originalTitle)) {
        return $title;
    }

    $fullName = $document->getFriend()->getName();
    $names = [$fullName];

    $nameParts = explode(' ', $fullName);
    if (count($nameParts) === 3) {
        $names[] = $nameParts[0] . ' ' . $nameParts[2];
    }

    foreach ($names as $name) {
        $ofQuoted = '/' . preg_quote(" of {$name}") . '/';
        $title = preg_replace($ofQuoted, $replace, $title);
        $possessiveQuoted = '/' . preg_quote("{$name}'s ") . '/';
        $title = preg_replace($possessiveQuoted, $replace, $title);
    }

    return $title;
}
