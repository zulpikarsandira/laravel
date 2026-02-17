<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// --- VERCEL RUNTIME FIX: BYPASS BOOTSTRAP CACHE ---
// Vercel filesystem is Read-Only. We cannot delete bad cache files.
// Instead, we point Laravel to look for cache files in /tmp (which are empty).
// This forces a fresh boot, ignoring the corrupt build-time cache.
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_ROUTES_CACHE=/tmp/routes-v7.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
// -------------------------------------------------

// --- VERCEL ENV INJECTION START ---
// Inject critical env vars if missing (Fallback for Vercel)
if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:pfSB8aGrWJLi82K7siZdmzmVybvdDsacmrYTAFZ7D2A=');
    $_ENV['APP_KEY'] = 'base64:pfSB8aGrWJLi82K7siZdmzmVybvdDsacmrYTAFZ7D2A=';
    $_SERVER['APP_KEY'] = 'base64:pfSB8aGrWJLi82K7siZdmzmVybvdDsacmrYTAFZ7D2A=';
}

if (!getenv('APP_DEBUG')) {
    putenv('APP_DEBUG=true');
    $_ENV['APP_DEBUG'] = true;
    $_SERVER['APP_DEBUG'] = true;
}

if (!getenv('APP_URL')) {
    putenv('APP_URL=https://ng-loco.vercel.app');
}

// Force specific drivers to avoid DB/View dependency issues during boot
if (!getenv('LOG_CHANNEL')) {
    putenv('LOG_CHANNEL=stderr');
}
if (!getenv('SESSION_DRIVER')) {
    putenv('SESSION_DRIVER=cookie');
}
if (!getenv('CACHE_STORE')) {
    putenv('CACHE_STORE=array');
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
// Set storage path to /tmp (writable in Lambda)
$storagePath = '/tmp/storage';
$app->useStoragePath($storagePath);

// Ensure storage subdirectories exist
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/framework/cache', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
}

// Create empty database for Vercel (prevents "Database not found" errors)
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}
// --- VERCEL STORAGE FIX END ---

try {
    $app->handleRequest(Request::capture());
}
catch (\Throwable $e) {
    // Fallback error handler if Laravel fails to boot
    http_response_code(500);
    echo "<h1>🔥 Vercel Boot Error</h1>";

    $count = 1;
    do {
        echo "<h2>Exception #{$count}</h2>";
        echo "<p><strong>Message:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Class:</strong> " . get_class($e) . "</p>";
        echo "<p><strong>File:</strong> " . $e->getFile() . ":" . $e->getLine() . "</p>";

        // Show truncated trace
        $trace = explode("\n", $e->getTraceAsString());
        echo "<pre>" . implode("\n", array_slice($trace, 0, 10)) . "\n... (truncated)</pre>";

        echo "<hr>";
        $e = $e->getPrevious();
        $count++;
    } while ($e);
}