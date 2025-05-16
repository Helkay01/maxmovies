<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Redirect folder URLs missing trailing slash
if (is_dir(__DIR__ . $uri) && substr($uri, -1) !== '/') {
    header('Location: ' . $uri . '/');
    exit;
}

// Serve existing files directly (including PHP files)
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;  // Serve the requested resource as-is
}

// Otherwise route to main index.php
require_once __DIR__ . '/index.php';
