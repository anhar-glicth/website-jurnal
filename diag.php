<?php
chdir(__DIR__);
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Check key files
$files = [
  "js/build.js",
  "js/build_frontend.js",
  "styles/build.css",
  "lib/pkp/lib/creditRoles/translations/en_US.json",
  "lib/pkp/lib/counterBots/bots.json",
  "lib/pkp/lib/vendor/autoload.php",
  "lib/vendor/autoload.php",
];
echo "=== FILE CHECK ===\n";
foreach ($files as $f) {
  echo (file_exists($f) ? "OK" : "MISSING") . " $f\n";
}

echo "\n=== AUTOLOAD CHECK ===\n";
try {
  require_once("lib/pkp/lib/vendor/autoload.php");
  echo "PKP vendor autoload: OK\n";
} catch(Throwable $e) {
  echo "PKP vendor autoload FAILED: " . $e->getMessage() . "\n";
}

try {
  require_once("lib/vendor/autoload.php");
  echo "OJS vendor autoload: OK\n";
} catch(Throwable $e) {
  echo "OJS vendor autoload FAILED: " . $e->getMessage() . "\n";
}

echo "Done\n";
