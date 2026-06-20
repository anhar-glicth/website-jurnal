<?php
/**
 * OJS TinyMCE Plugin Status Check
 * Upload to: https://journalpradaya.com/check_tinymce.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'u609332033_oai_jurnal';
$pass = 'oai_jurnaL8';
$db   = 'u609332033_oai_jurnal';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error . "\n");
}

echo "=== TinyMCE Plugin Status ===\n\n";

// Query plugin_settings for tinymce
$res = $conn->query("SELECT * FROM plugin_settings WHERE plugin_name LIKE '%tinymce%'");
if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        echo "Plugin Name: {$row['plugin_name']} | Setting Name: {$row['setting_name']} | Setting Value: {$row['setting_value']} | Type: {$row['setting_type']}\n";
    }
} else {
    echo "No settings found in plugin_settings for TinyMCE.\n";
}

echo "\n--- Querying versions table for TinyMCE ---\n";
$res2 = $conn->query("SELECT * FROM versions WHERE product = 'tinymce'");
if ($res2 && $res2->num_rows > 0) {
    while ($row = $res2->fetch_assoc()) {
        echo "Product: {$row['product']} | Type: {$row['product_type']} | Version: {$row['major']}.{$row['minor']}.{$row['revision']}.{$row['build']} | Status: " . ($row['current'] ? 'Active' : 'Inactive') . "\n";
    }
} else {
    echo "No version entries found in versions table for TinyMCE.\n";
}

// Auto-fix: Enable tinymce plugin if disabled
if (isset($_GET['action']) && $_GET['action'] == 'enable') {
    echo "\n--- Attempting to Enable TinyMCE ---\n";
    // Check if entry exists in plugin_settings for tinymceplugin and setting_name = 'enabled'
    // In OJS, context_id = 0 for site, or context_id = 1 for specific journal.
    // Let's enable it for both site (0) and journal (1).
    $contexts = [0, 1];
    foreach ($contexts as $contextId) {
        $check = $conn->query("SELECT 1 FROM plugin_settings WHERE plugin_name = 'tinymceplugin' AND setting_name = 'enabled' AND context_id = $contextId");
        if ($check && $check->num_rows > 0) {
            $update = $conn->query("UPDATE plugin_settings SET setting_value = '1', setting_type = 'bool' WHERE plugin_name = 'tinymceplugin' AND setting_name = 'enabled' AND context_id = $contextId");
            echo "Context ID $contextId: Updated existing setting. Result: " . ($update ? "SUCCESS" : "FAILED: " . $conn->error) . "\n";
        } else {
            $insert = $conn->query("INSERT INTO plugin_settings (plugin_name, context_id, setting_name, setting_value, setting_type) VALUES ('tinymceplugin', $contextId, 'enabled', '1', 'bool')");
            echo "Context ID $contextId: Inserted new setting. Result: " . ($insert ? "SUCCESS" : "FAILED: " . $conn->error) . "\n";
        }
    }
}

$conn->close();
?>
