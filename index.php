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
    saveLog("\n" . __FILE__ . ':' . __LINE__ . "\n" . $th->getMessage(), 'error');

    if (DEBUG) {
        echo '<pre>';
        echo $th->getMessage();
        echo '</pre>';
        die;
    }
}
