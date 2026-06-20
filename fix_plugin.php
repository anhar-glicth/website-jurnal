<?php
$host = 'localhost';
$user = 'u609332033_oai_jurnal';
$pass = 'oai_jurnaL8';
$db   = 'u609332033_oai_jurnal';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}
echo "Connected to DB\n";

// Show all plugin entries related to 'ojs' theme
$result = $conn->query("SELECT major, minor, revision, build, product_type, product FROM versions WHERE product LIKE '%ojs%' OR product_type LIKE '%theme%'");
echo "\n=== VERSIONS TABLE (themes) ===\n";
while ($row = $result->fetch_assoc()) {
    echo json_encode($row) . "\n";
}

// Show all plugin_settings related to 'ojs'
$result2 = $conn->query("SELECT DISTINCT plugin_name FROM plugin_settings WHERE plugin_name LIKE '%ojs%'");
echo "\n=== PLUGIN_SETTINGS (ojs) ===\n";
while ($row = $result2->fetch_assoc()) {
    echo json_encode($row) . "\n";
}

// Delete ojs theme from versions
$del1 = $conn->query("DELETE FROM versions WHERE product = 'ojs' AND product_type = 'plugins.themes'");
echo "\n=== DELETE versions ojs theme: " . ($del1 ? "OK, rows=" . $conn->affected_rows : $conn->error) . "\n";

// Delete ojs plugin settings
$del2 = $conn->query("DELETE FROM plugin_settings WHERE plugin_name = 'ojsthemeplugin'");
echo "=== DELETE plugin_settings ojsthemeplugin: " . ($del2 ? "OK, rows=" . $conn->affected_rows : $conn->error) . "\n";

$conn->close();
echo "\nDone!\n";
