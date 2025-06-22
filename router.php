
<?php
// router.php - handles URL rewriting for PHP built-in server

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Remove query string if present
$path = strtok($path, '?');

// If the file exists and is not a directory, serve it directly
if ($path !== '/' && file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false; // Let PHP serve the file directly
}

// Set the REQUEST_URI for the application
$_SERVER['REQUEST_URI'] = $request_uri;

// Route through index.php
require_once 'index.php';
