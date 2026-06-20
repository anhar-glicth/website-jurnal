<?php
/**
 * OJS publication_categories table creator
 * Upload to: https://journalpradaya.com/create_table.php
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

echo "=== CHECK AND CREATE publication_categories ===\n\n";

// 1. Check if tables exist
$tables = ['categories', 'category_settings', 'publication_categories'];
foreach ($tables as $t) {
    $res = $conn->query("SHOW TABLES LIKE '$t'");
    if ($res && $res->num_rows > 0) {
        echo "Table '$t' exists.\n";
    } else {
        echo "Table '$t' DOES NOT exist.\n";
    }
}
echo "\n";

// 2. Create publication_categories table if it doesn't exist
$res_check = $conn->query("SHOW TABLES LIKE 'publication_categories'");
if ($res_check && $res_check->num_rows == 0) {
    echo "Creating table 'publication_categories'...\n";
    
    // First, let's make sure the categories table exists.
    // If categories table doesn't exist, we should create it too!
    $check_cat = $conn->query("SHOW TABLES LIKE 'categories'");
    if ($check_cat && $check_cat->num_rows == 0) {
        echo "Creating table 'categories' first...\n";
        $sql_cat = "CREATE TABLE categories (
            category_id BIGINT NOT NULL AUTO_INCREMENT,
            context_id BIGINT NOT NULL,
            parent_id BIGINT NULL,
            path VARCHAR(255) NOT NULL,
            image TEXT NULL,
            PRIMARY KEY (category_id),
            KEY category_context_id (context_id),
            KEY category_parent_id (parent_id),
            KEY category_context_parent_id (context_id, parent_id),
            UNIQUE KEY category_path (context_id, path)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        if ($conn->query($sql_cat)) {
            echo "SUCCESS: Created table 'categories'.\n";
        } else {
            echo "FAILED: " . $conn->error . "\n";
        }
    }
    
    $sql = "CREATE TABLE publication_categories (
        publication_category_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        publication_id BIGINT NOT NULL,
        category_id BIGINT NOT NULL,
        PRIMARY KEY (publication_category_id),
        UNIQUE KEY publication_categories_id (publication_id, category_id),
        KEY publication_categories_publication_id (publication_id),
        KEY publication_categories_category_id (category_id),
        CONSTRAINT fk_publication_categories_publication_id FOREIGN KEY (publication_id) REFERENCES publications (publication_id) ON DELETE CASCADE,
        CONSTRAINT fk_publication_categories_category_id FOREIGN KEY (category_id) REFERENCES categories (category_id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if ($conn->query($sql)) {
        echo "SUCCESS: Created table 'publication_categories'.\n";
    } else {
        echo "FAILED: " . $conn->error . "\n";
    }
} else {
    echo "Table 'publication_categories' already exists, no action needed.\n";
}

$conn->close();
?>
