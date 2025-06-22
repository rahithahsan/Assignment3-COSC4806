
<?php
require_once 'app/init.php';

echo "Testing database connection...\n";
$db = db_connect();

if ($db) {
    echo "✓ Database connection successful\n";
    
    // Test if users table exists
    try {
        $stmt = $db->prepare("DESCRIBE users");
        $stmt->execute();
        echo "✓ Users table exists\n";
        
        $columns = $stmt->fetchAll();
        echo "Table structure:\n";
        foreach ($columns as $column) {
            echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
        }
    } catch (Exception $e) {
        echo "✗ Users table error: " . $e->getMessage() . "\n";
    }
} else {
    echo "✗ Database connection failed\n";
}
?>
