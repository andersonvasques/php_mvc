<?php

/**
 * Dump and die
 */
function dd()
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
