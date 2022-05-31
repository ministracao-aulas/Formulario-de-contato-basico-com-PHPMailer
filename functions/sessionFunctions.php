<?php

if (!function_exists('getFlash')) {
    function getFlash($key)
    {
        $flash = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $flash ?? null;
    }
}

if (!function_exists('old')) {
    function old($key, $default = null)
    {
        $old = $_SESSION['old'][$key] ?? null;
        unset($_SESSION['old'][$key]);
        return $old ?? $default ?? null;
    }
}

if (!function_exists('putOld')) {
    function putOld($key, $value)
    {
        $_SESSION['old'][$key] = $value;
    }
}

if (!function_exists('setFlash')) {
    function setFlash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }
}

if (!function_exists('setSession')) {
    function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('getSession')) {
    function getSession($key, $default = null)
    {
        return $_SESSION[$key] ?? $default ?? null;
    }
}

if (!function_exists('removeSession')) {
    function removeSession($key)
    {
        unset($_SESSION[$key]);
    }
}

if (!function_exists('clearOld')) {
    function clearOld()
    {
        unset($_SESSION['old']);
    }
}

if (!function_exists('clearFlash')) {
    function clearFlash()
    {
        unset($_SESSION['flash']);
    }
}
