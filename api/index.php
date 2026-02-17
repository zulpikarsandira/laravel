<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// --- VERCEL RUNTIME FIX: BYPASS BOOTSTRAP CACHE ---
$cacheDir = __DIR__ . '/../bootstrap/cache';
$filesToDelete = ['packages.php', 'services.php', 'config.php', 'routes-v7.php'];
foreach ($filesToDelete as $file) {
    if (file_exists("$cacheDir/$file")) {
        @unlink("$cacheDir/$file");
    }
}
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes-v7.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
// -------------------------------------------------

// --- VERCEL ENV INJECTION START ---
if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:pfSB8aGrWJLi82K7siZdmzmVybvdDsacmrYTAFZ7D2A=');
}

if (!getenv('APP_DEBUG')) {
    putenv('APP_DEBUG=true');
}

// Dynamic APP_URL based on request (Fixes CSS/Assets on different domains)
if (!getenv('APP_URL')) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    putenv("APP_URL={$protocol}{$host}");
}

// Force specific drivers
if (!getenv('LOG_CHANNEL'))
    putenv('LOG_CHANNEL=stderr');
if (!getenv('SESSION_DRIVER'))
    putenv('SESSION_DRIVER=cookie');
if (!getenv('CACHE_STORE'))
    putenv('CACHE_STORE=array');

// Force HTTPS for assets (Vercel is always HTTPS)
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
// --- VERCEL ENV INJECTION END ---

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__ . '/../bootstrap/app.php';

// --- VERCEL STORAGE FIX START ---
$storagePath = '/tmp/storage';
$app->useStoragePath($storagePath);
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/framework/cache', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
}
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}
// --- VERCEL STORAGE FIX END ---

try {
    $app->handleRequest(Request::capture());
}
catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>🔥 Vercel Boot Error</h1>";
    $count = 1;
    do {
        echo "<h2>Exception #{$count}</h2>";
        echo "<p><strong>Message:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Class:</strong> " . get_class($e) . "</p>";
        echo "<p><strong>File:</strong> " . $e->getFile() . ":" . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
        echo "<hr>";
        $e = $e->getPrevious();
        $count++;
    } while ($e);
}