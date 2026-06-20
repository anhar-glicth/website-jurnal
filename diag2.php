<?php
/**
 * OJS Backend Diagnostic
 * Upload to: /public_html/diag2.php
 * Access via: https://journalpradaya.com/diag2.php
 */
error_reporting(E_ALL);
ini_set("display_errors", 0); // Capture to variable instead

$errors = [];
set_error_handler(function($errno, $errstr, $errfile, $errline) use (&$errors) {
    $errors[] = "[E$errno] $errstr in $errfile:$errline";
    return true;
});

chdir(__DIR__);
header("Content-Type: text/plain");

echo "=== OJS DIAGNOSTIC ===\n\n";

// 1. Check critical files
echo "--- Critical Files ---\n";
$critical = [
    "config.inc.php",
    "lib/pkp/lib/vendor/autoload.php",
    "lib/pkp/lib/creditRoles/translations/en_Latn.json",
    "lib/pkp/lib/counterBots/COUNTER_Robots_list.json",
    "js/build.js",
    "styles/build.css",
];
foreach ($critical as $f) {
    echo (file_exists($f) ? "OK" : "MISSING") . " $f\n";
}

// 2. Bootstrap OJS
echo "\n--- OJS Bootstrap ---\n";
try {
    require_once("lib/pkp/lib/vendor/autoload.php");
    echo "PKP autoload: OK\n";
} catch(Throwable $e) {
    echo "PKP autoload FAILED: " . $e->getMessage() . "\n";
    exit;
}

// 3. Try to load OJS application
echo "\n--- OJS Application ---\n";
try {
    define('INDEX_FILE_LOCATION', __DIR__ . '/index.php');
    define('APP_ROOT_DIR', __DIR__);
    require_once("includes/bootstrap.inc.php");
    echo "OJS bootstrap: OK\n";
} catch(Throwable $e) {
    echo "OJS bootstrap FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}

// 4. Show captured errors
echo "\n--- Captured Errors ---\n";
if ($errors) {
    foreach ($errors as $err) {
        echo "$err\n";
    }
} else {
    echo "No errors captured\n";
}

// 5. Delete self
echo "\n=== END ===\n";
