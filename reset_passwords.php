<?php
/**
 * OJS User Password Resetter
 * Upload to: https://journalpradaya.com/reset_passwords.php
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

echo "=== OJS USER PASSWORD RESETTER ===\n\n";

$targetUsers = [
    'manager_pradaya',
    'editor_pradaya',
    'reviewer_pradaya',
    'author_pradaya',
    'reader_pradaya'
];

$newPassword = 'Pradaya2026!';
$newHash = password_hash($newPassword, PASSWORD_BCRYPT);

echo "New Password: $newPassword\n";
echo "New Hash: $newHash\n\n";

foreach ($targetUsers as $username) {
    $username_escaped = $conn->real_escape_string($username);
    
    // Check if user exists
    $check = $conn->query("SELECT user_id FROM users WHERE username = '$username_escaped'");
    if ($check && $check->num_rows > 0) {
        $row = $check->fetch_assoc();
        $userId = $row['user_id'];
        
        // Update password hash
        $update = $conn->query("UPDATE users SET password = '$newHash' WHERE user_id = $userId");
        if ($update) {
            echo "SUCCESS: Reset password for username '$username' (ID: $userId) to '$newPassword'.\n";
        } else {
            echo "FAILED: Could not update password for username '$username': " . $conn->error . "\n";
        }
    } else {
        echo "NOTICE: Username '$username' does not exist in the database.\n";
    }
}

$conn->close();
?>
