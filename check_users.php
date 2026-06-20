<?php
/**
 * OJS User & Role Diagnostic Script
 * Upload to your server and run via: https://journalpradaya.com/check_users.php
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

echo "=== OJS USER & ROLE DIAGNOSTIC ===\n\n";

// 1. Get all users
echo "--- Users in Database ---\n";
$usersResult = $conn->query("SELECT user_id, username, email, disabled FROM users");
if ($usersResult) {
    while ($u = $usersResult->fetch_assoc()) {
        echo "ID: {$u['user_id']} | Username: {$u['username']} | Email: {$u['email']} | Disabled: " . ($u['disabled'] ? 'YES' : 'NO') . "\n";
    }
} else {
    echo "Error fetching users: " . $conn->error . "\n";
}
echo "\n";

// 2. Get user groups definitions
echo "--- User Groups (Roles) defined ---\n";
$groupsResult = $conn->query("SELECT user_group_id, role_id, context_id FROM user_groups");
$groups = [];
if ($groupsResult) {
    while ($g = $groupsResult->fetch_assoc()) {
        $groups[$g['user_group_id']] = $g;
        // Role mappings: 1 = Admin, 16 = Manager, etc.
        $roleName = 'Unknown';
        switch ($g['role_id']) {
            case 1: $roleName = 'Site Administrator (ROLE_ID_SITE_ADMIN)'; break;
            case 16: $roleName = 'Journal Manager (ROLE_ID_MANAGER)'; break;
            case 17: $roleName = 'Section Editor (ROLE_ID_SUB_EDITOR)'; break;
            case 4096: $roleName = 'Author (ROLE_ID_AUTHOR)'; break;
            case 65536: $roleName = 'Reviewer (ROLE_ID_REVIEWER)'; break;
            case 2048: $roleName = 'Assistant (ROLE_ID_ASSISTANT)'; break;
        }
        echo "Group ID: {$g['user_group_id']} | Role: {$roleName} (ID: {$g['role_id']}) | Context ID: {$g['context_id']}\n";
    }
} else {
    echo "Error fetching user groups: " . $conn->error . "\n";
}
echo "\n";

// 3. User Group Assignments
echo "--- User Group Assignments ---\n";
$assignmentsResult = $conn->query("
    SELECT uug.user_id, u.username, uug.user_group_id 
    FROM user_user_groups uug 
    JOIN users u ON uug.user_id = u.user_id
");
if ($assignmentsResult) {
    while ($a = $assignmentsResult->fetch_assoc()) {
        $gid = $a['user_group_id'];
        $groupInfo = isset($groups[$gid]) ? $groups[$gid] : null;
        $roleStr = '';
        if ($groupInfo) {
            $roleStr = "Group ID: {$gid} (Role ID: {$groupInfo['role_id']}, Context ID: {$groupInfo['context_id']})";
        } else {
            $roleStr = "Unknown Group ID: $gid";
        }
        echo "User ID: {$a['user_id']} ({$a['username']}) -> $roleStr\n";
    }
} else {
    echo "Error fetching assignments: " . $conn->error . "\n";
}
echo "\n";

// 4. Instructions for restoring roles if needed
echo "--- Action Utilities ---\n";
echo "To grant Site Administrator (Role ID 1) or Journal Manager (Role ID 16) access to a user, you can pass parameters, e.g.:\n";
echo "?action=grant_admin&username=YOUR_USERNAME\n";
echo "?action=grant_manager&username=YOUR_USERNAME&context_id=YOUR_CONTEXT_ID\n\n";

if (isset($_GET['action']) && isset($_GET['username'])) {
    $targetUsername = $conn->real_escape_string($_GET['username']);
    
    // Find user
    $userCheck = $conn->query("SELECT user_id FROM users WHERE username = '$targetUsername'");
    if ($userCheck && $userCheck->num_rows > 0) {
        $uRow = $userCheck->fetch_assoc();
        $targetUid = $uRow['user_id'];
        
        $action = $_GET['action'];
        if ($action === 'grant_admin') {
            // Find Site Admin group (role_id = 1, context_id = 0)
            $grpCheck = $conn->query("SELECT user_group_id FROM user_groups WHERE role_id = 1 AND context_id = 0 LIMIT 1");
            if ($grpCheck && $grpCheck->num_rows > 0) {
                $gRow = $grpCheck->fetch_assoc();
                $targetGid = $gRow['user_group_id'];
                
                // Check if already assigned
                $existCheck = $conn->query("SELECT 1 FROM user_user_groups WHERE user_id = $targetUid AND user_group_id = $targetGid");
                if ($existCheck && $existCheck->num_rows > 0) {
                    echo "Result: User '$targetUsername' already has Site Administrator role.\n";
                } else {
                    $insert = $conn->query("INSERT INTO user_user_groups (user_id, user_group_id) VALUES ($targetUid, $targetGid)");
                    if ($insert) {
                        echo "Result: Successfully granted Site Administrator role to user '$targetUsername'.\n";
                    } else {
                        echo "Result: Failed to grant role: " . $conn->error . "\n";
                    }
                }
            } else {
                echo "Result: Site Administrator group (role_id=1, context_id=0) not found in user_groups table.\n";
            }
        } elseif ($action === 'grant_manager') {
            $contextId = isset($_GET['context_id']) ? (int)$_GET['context_id'] : 1;
            // Find Journal Manager group (role_id = 16, context_id = $contextId)
            $grpCheck = $conn->query("SELECT user_group_id FROM user_groups WHERE role_id = 16 AND context_id = $contextId LIMIT 1");
            if ($grpCheck && $grpCheck->num_rows > 0) {
                $gRow = $grpCheck->fetch_assoc();
                $targetGid = $gRow['user_group_id'];
                
                // Check if already assigned
                $existCheck = $conn->query("SELECT 1 FROM user_user_groups WHERE user_id = $targetUid AND user_group_id = $targetGid");
                if ($existCheck && $existCheck->num_rows > 0) {
                    echo "Result: User '$targetUsername' already has Journal Manager role for context $contextId.\n";
                } else {
                    $insert = $conn->query("INSERT INTO user_user_groups (user_id, user_group_id) VALUES ($targetUid, $targetGid)");
                    if ($insert) {
                        echo "Result: Successfully granted Journal Manager role to user '$targetUsername' for context $contextId.\n";
                    } else {
                        echo "Result: Failed to grant role: " . $conn->error . "\n";
                    }
                }
            } else {
                echo "Result: Journal Manager group (role_id=16, context_id=$contextId) not found in user_groups table.\n";
            }
        }
    } else {
        echo "Result: User '$targetUsername' not found.\n";
    }
}

$conn->close();
?>
