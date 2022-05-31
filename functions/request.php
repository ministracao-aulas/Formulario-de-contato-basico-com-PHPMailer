<?php

if (!function_exists('requestGet')) {
    function requestGet($key, $default = null)
    {
        return $_GET[$key] ?? $default ?? null;
    }
}

if (!function_exists('requestPost')) {
    function requestPost($key, $default = null)
    {
        return $_POST[$key] ?? $default ?? null;
    }
}

if (!function_exists('requestAny')) {
    function requestAny($key, $default = null)
    {
        return $_REQUEST[$key] ?? $_POST[$key] ?? $_GET[$key] ?? $default ?? null;
    }
}

if (!function_exists('requestHeader')) {
    function requestHeader($key, $default = null)
    {
        return $_SERVER[$key] ?? $default ?? null;
    }
}

if (!function_exists('redirect')) {
    function redirect($target)
    {
        if (headers_sent()) {
            echo <<<"HTML"
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="refresh" content="0; url={$target}">
                    <script type="text/javascript">
                        window.location.href = "{$target}"
                    </script>

                    <noscript>
                        <meta http-equiv="refresh" content="0; url={$target}">
                    </noscript>
                    <title>Redirecting</title>
                </head>
                </html>
            HTML;

            die;
        }
        header('Location: ' . $target);
        die;
    }
}
