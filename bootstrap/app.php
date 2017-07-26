<?php

use Dotenv\DotEnv;
use Evans\Application;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Load the environment
 */
$env = new Dotenv(__DIR__ . '/../');
$env->load();

/**
 * Create the application
 */
$app = new Application(__DIR__ . '/../');

/**
 * Register the routes
 */
$app->routes(function (Application $app): void {
    $language = env('EVANS_LANG', 'en');
    require __DIR__ . "/../routes/{$language}.php";
});

return $app;
