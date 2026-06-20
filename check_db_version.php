<?php
/**
 * OJS DB Version & Migration Checker
 * Upload to: https://journalpradaya.com/check_db_version.php
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

echo "=== OJS DATABASE VERSION CHECK ===\n\n";

// 1. Get versions table entries
$res = $conn->query("SELECT * FROM versions ORDER BY date_installed DESC");
if ($res && $res->num_rows > 0) {
    echo "--- Installed Versions ---\n";
    while ($row = $res->fetch_assoc()) {
        echo "Product: {$row['product']} | Type: {$row['product_type']} | Version: {$row['major']}.{$row['minor']}.{$row['revision']}.{$row['build']} | Status: " . ($row['current'] ? 'CURRENT' : 'OLD') . " | Date: {$row['date_installed']}\n";
    }
} else {
    echo "No version entries found in versions table.\n";
}
echo "\n";

// 2. Check PHP Error log or get last error if there's any table structure mismatches
// Let's try to query submissions and publications columns to see if they match OJS 3.6 schema!
echo "--- Submissions Table Columns ---\n";
$res2 = $conn->query("DESCRIBE submissions");
if ($res2) {
    while ($row = $res2->fetch_assoc()) {
        echo "Field: {$row['Field']} | Type: {$row['Type']} | Null: {$row['Null']} | Key: {$row['Key']}\n";
    }
} else {
    echo "Error describing submissions table: " . $conn->error . "\n";
}
echo "\n";

echo "--- Publications Table Columns ---\n";
$res3 = $conn->query("DESCRIBE publications");
if ($res3) {
    while ($row = $res3->fetch_assoc()) {
        echo "Field: {$row['Field']} | Type: {$row['Type']} | Null: {$row['Null']} | Key: {$row['Key']}\n";
    }
} else {
    echo "Error describing publications table: " . $conn->error . "\n";
}

$conn->close();
?>
