<?php

$env = require_once __DIR__ . '/../../env.php';

return [
    'database' => [
        'host'     => $env['host'],
        'dbname'   => $env['dbname'],
        'username' => $env['username'],
        'password' => $env['password'],
        'charset'  => $env['charset'],
    ],
];
