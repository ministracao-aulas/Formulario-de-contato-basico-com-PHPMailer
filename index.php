<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions/__enabledFunctions.php';

try {
    require_once __DIR__ . '/server.php';
} catch (\Throwable $th) {
    try {
        saveLog("\n" . __FILE__ . ':' . __LINE__ . "\n" . $th->getMessage(), 'error');
    } catch (\Throwable $th) {
        if (DEBUG) {
            throw $th;
        }

        die('An unexpected error has occurred. Please try again later.');
    }

    if (DEBUG) {
        throw $th;
    }

    die('An unexpected error has occurred. Please try again later.');
}
