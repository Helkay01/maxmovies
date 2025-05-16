<?php
// router.php

// Parse the requested URL path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested file exists, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false; // serve the file as-is
}

// Otherwise, route all requests to index.php
require_once __DIR__ . '/index.php';
