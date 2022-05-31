<?php

if (!function_exists('saveLog')) {
    function saveLog($content, ?string $logPrefix = null, ?string $dateSufix = null)
    {
        $content = var_export($content, true);
        $content = date('Y-m-d H:i:s') . ' ' . $content . PHP_EOL;
        $logName = ($logPrefix ?: "log") . '-' . ($dateSufix ?: date('Y-m-d') . '.log');

        $logPath = APP_PATH . "/logs/{$logName}";
        file_put_contents($logPath, ($content . "\n"), FILE_APPEND);
    }
}
