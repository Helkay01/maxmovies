<?php
// Get the requested URI path
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = __DIR__ . $uri;

// If the file exists (PHP, HTML, image, etc.), serve it directly
if ($uri !== '/' && file_exists($file)) {
    return false; // Let PHP's built-in web server handle it
}

// Otherwise, fallback to index.php (e.g. for custom 404 or SPA behavior)
require_once __DIR__ . '/index.php';
