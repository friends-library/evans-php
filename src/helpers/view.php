<?php

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
