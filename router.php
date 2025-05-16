<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$fullPath = __DIR__ . $uri;

// ✅ If requested path is a file, serve it directly (e.g., Movies/test.php)
if (is_file($fullPath)) {
    // This will execute PHP files and allow access to media, images, etc.
    return false;
}

// ✅ If it’s a directory with index.php (e.g., /Movies/)
if (is_dir($fullPath) && is_file($fullPath . '/index.php')) {
    require $fullPath . '/index.php';
    exit;
}

// ❌ If file/folder doesn't exist, fallback to main index
require __DIR__ . '/index.php';
