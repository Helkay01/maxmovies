<?php
function getClientIp() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]); // First IP is the real client IP
    }

    return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
}

echo getClientIp();
