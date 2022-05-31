<?php

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
        saveLog("\n" . __FILE__ . ':' . __LINE__ . "\n" . $th->getMessage(), 'error');

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
