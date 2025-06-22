
<?php
/* ---------- database.php ---------- */
require_once __DIR__ . '/core/config.php';

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
            DB_HOST,
            DB_PORT,
            DB_NAME
        );

        try {
            $pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ],
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            // For debugging - remove in production
            echo "Database connection error: " . $e->getMessage();
            throw $e;
        }
    }

    return $pdo;
}

// Keep the old function name for backward compatibility
function db_connect() {
    return db();
}
