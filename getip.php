<?php
function getClientIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    } else {
        return $_SERVER['REMOTE_ADDR']; // Fallback (could be ::1 or internal IP)
    }
}

$clientIP = getClientIP();
echo "User's IP: " . $clientIP;
