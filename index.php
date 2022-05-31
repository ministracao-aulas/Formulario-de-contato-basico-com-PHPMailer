<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions/__enabledFunctions.php';
require_once __DIR__ . '/routes.php';

$uri = trim(
    urldecode(
        parse_url(($_SERVER['REQUEST_URI'] ?? null), PHP_URL_PATH)
    )
);

$uri    = str_replace(['/index.php', '/', '//'], '/', $uri);
$routes = require __DIR__ . '/routes.php';

if ($routes[$uri] ?? null) {
    $routeAction = $routes[$uri];
    try {
        if (is_callable($routeAction)) {
            $routeAction();
            die;
        }

        $routeAction;
        die;
    } catch (Exception $e) {
        if (DEBUG) {
            echo '<pre>';
            echo $e->getMessage();
            echo '</pre>';
            die;
        }

        http_response_code(500);
        require __DIR__ . '/pages/errors/500.php';
        die;
    }
} else {
    http_response_code(404);
    require __DIR__ . '/pages/errors/404.php';
}
