
<?php
require_once 'app/init.php';

echo "Testing registration process...\n\n";

// Test database connection
echo "1. Testing database connection...\n";
try {
    $db = db_connect();
    if ($db) {
        echo "✓ Database connection successful\n";
    } else {
        echo "✗ Database connection failed\n";
        exit;
    }
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
    exit;
}

// Test if users table exists and has correct structure
echo "\n2. Testing users table...\n";
try {
    $stmt = $db->prepare("DESCRIBE users");
    $stmt->execute();
    $columns = $stmt->fetchAll();
    echo "✓ Users table exists with columns:\n";
    foreach ($columns as $column) {
        echo "  - " . $column['Field'] . " (" . $column['Type'] . ")\n";
    }
} catch (Exception $e) {
    echo "✗ Users table error: " . $e->getMessage() . "\n";
}

// Test User model
echo "\n3. Testing User model...\n";
session_start();
$user = new User();

// Test password policy function
$testPassword = "TestPass123!";
if ($user->password_meets_policy($testPassword)) {
    echo "✓ Password policy function works\n";
} else {
    echo "✗ Password policy function failed\n";
}

echo "\n4. Testing registration with test data...\n";
$testResult = $user->register("testuser123", $testPassword, $testPassword);
if ($testResult) {
    echo "✓ Registration test successful\n";
} else {
    echo "✗ Registration test failed\n";
    if (isset($_SESSION['flash'])) {
        echo "Error: " . $_SESSION['flash'] . "\n";
    }
}

echo "\nDone!\n";
?>
