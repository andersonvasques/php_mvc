<?php

/**
 * Dump and die
 */
function dd(): never
{
    $args = func_get_args();

    echo '<pre>';
    foreach ($args as $arg) {
        echo '<pre>';
        var_dump($arg);
        echo '</pre>';
    }

    $backtrace = debug_backtrace()[0];
    echo 'File: ' . $backtrace['file'];
    echo '<br>';
    echo 'Line: ' . $backtrace['line'];
    echo '<pre>';

    die();
}

function config(string $key, $default = null): string | array
{
    $config = require_once __DIR__ . '/../config/config.php';
    return $config[$key] ?? $default;
}
