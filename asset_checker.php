<?php
/**
 * OJS Asset & Javascript Diagnostic and Fixer Script
 * Upload to your server and run via: https://journalpradaya.com/asset_checker.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== OJS ASSET CHECKER ===\n\n";

$baseDir = __DIR__;

// 1. Check compiled assets
$compiledAssets = [
    "js/build.js",
    "js/build_frontend.js",
    "styles/build.css",
];

echo "--- Compiled Assets Check ---\n";
foreach ($compiledAssets as $file) {
    $path = $baseDir . '/' . $file;
    if (file_exists($path)) {
        echo "[OK] $file exists (Size: " . filesize($path) . " bytes)\n";
    } else {
        echo "[MISSING] $file is missing!\n";
    }
}
echo "\n";

// 2. Check jQuery & library files
$jqueryFiles = [
    'js/build/jquery/jquery.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js',
    'js/build/jquery/jquery.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
    'js/build/jquery-ui/jquery-ui.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.js',
    'js/build/jquery-ui/jquery-ui.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js',
    'js/build/jquery-validation/jquery.validate.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js',
    'js/build/jquery-validation/jquery.validate.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js',
];

echo "--- jQuery & Library Files Check ---\n";
$missingJQuery = [];
foreach ($jqueryFiles as $file => $url) {
    $path = $baseDir . '/' . $file;
    if (file_exists($path)) {
        echo "[OK] $file exists (Size: " . filesize($path) . " bytes)\n";
    } else {
        echo "[MISSING] $file is missing!\n";
        $missingJQuery[$file] = $url;
    }
}
echo "\n";

// Auto-fix: Download missing jQuery files
if (!empty($missingJQuery)) {
    echo "--- Auto-fixing Missing jQuery Files ---\n";
    foreach ($missingJQuery as $file => $url) {
        $path = $baseDir . '/' . $file;
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        echo "Downloading $url ... ";
        $content = @file_get_contents($url);
        if ($content !== false) {
            file_put_contents($path, $content);
            echo "SUCCESS (Saved to $file)\n";
        } else {
            echo "FAILED\n";
        }
    }
    echo "\n";
}

// 3. Check TinyMCE assets
echo "--- TinyMCE Files Check ---\n";
$tinymcePaths = [
    "lib/pkp/lib/vendor/tinymce/tinymce/tinymce.js",
    "lib/pkp/lib/vendor/tinymce/tinymce/tinymce.min.js",
    "plugins/generic/tinymce/langs/id.js",
    "lib/pkp/styles/tinymce/skins/ui/oxide/skin.min.css",
    "lib/pkp/styles/tinymce/skins/content/default/content.min.css",
];

foreach ($tinymcePaths as $file) {
    $path = $baseDir . '/' . $file;
    if (file_exists($path)) {
        echo "[OK] $file exists (Size: " . filesize($path) . " bytes)\n";
    } else {
        echo "[MISSING] $file is missing!\n";
    }
}
echo "\n";

echo "=== END OF DIAGNOSTIC ===\n";
?>
