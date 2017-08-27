<?php

use Khill\Duration\Duration;

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
