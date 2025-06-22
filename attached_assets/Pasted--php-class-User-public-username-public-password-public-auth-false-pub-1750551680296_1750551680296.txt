
<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    /**
     * Checks very basic password strength
     *  - ≥8 chars
     *  - at least one upper, lower, digit, and special char
     */
    public function password_meets_policy(string $p): bool
    {
        return strlen($p) >= 8
            && preg_match('/[A-Z]/', $p)
            && preg_match('/[a-z]/', $p)
            && preg_match('/\d/'  , $p)
            && preg_match('/[^A-Za-z0-9]/', $p);
    }

    public function test () {
        $db = db_connect();
        $statement = $db->prepare("select * from users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
        $username = strtolower(trim($username));
        $now = time();

        // Ensure session arrays exist
        $_SESSION['failed'] = is_array($_SESSION['failed'] ?? null) ? $_SESSION['failed'] : [];
        $_SESSION['lockout_until'] = is_array($_SESSION['lockout_until'] ?? null) ? $_SESSION['lockout_until'] : [];

        $userFailed = $_SESSION['failed'][$username] ?? 0;
        $userLockout = $_SESSION['lockout_until'][$username] ?? 0;

        // Check if user is currently locked out
        if ($now < $userLockout) {
            $remaining = $userLockout - $now;
            $_SESSION['flash'] = "Too many failed attempts. Try again in {$remaining} seconds.";
            return false;
        }

        // Reset counter if lockout period has expired
        if ($userLockout && $now >= $userLockout) {
            $userFailed = 0;
            unset($_SESSION['lockout_until'][$username]);
        }

        // Database lookup
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :name");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Check authentication
        $auth_ok = $user && password_verify($password, $user['password_hash']);

        if ($auth_ok) {
            // Success - clear failed attempts and login
            session_regenerate_id(true);
            $_SESSION['auth'] = 1;
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = ucwords($username);
            unset($_SESSION['failed'][$username], $_SESSION['lockout_until'][$username]);
            unset($_SESSION['failedAuth']);
            return true;
        } else {
            // Failure - only increment counter for existing users
            if ($user) {
                $userFailed++;
                $_SESSION['failed'][$username] = $userFailed;
                
                if ($userFailed >= MAX_FAILED) {
                    $_SESSION['lockout_until'][$username] = $now + LOCKOUT_SECONDS;
                    $_SESSION['flash'] = "Too many failed attempts. Locked for " . LOCKOUT_SECONDS . " seconds.";
                } else {
                    $tries = MAX_FAILED - $userFailed;
                    $_SESSION['flash'] = "Invalid password. {$tries} attempt(s) left.";
                }
            } else {
                $_SESSION['flash'] = "User not found.";
            }
            
            // Set legacy failedAuth for compatibility
            $_SESSION['failedAuth'] = isset($_SESSION['failedAuth']) ? $_SESSION['failedAuth'] + 1 : 1;
            return false;
        }
    }

    public function register($username, $password, $confirm_password) {
        $username = strtolower(trim($username));
        
        // Validation
        if ($username === '' || $password === '' || $confirm_password === '') {
            $_SESSION['flash'] = 'All fields are required.';
            return false;
        }

        if ($password !== $confirm_password) {
            $_SESSION['flash'] = 'Passwords do not match.';
            return false;
        }

        if (!$this->password_meets_policy($password)) {
            $_SESSION['flash'] = 'Password must be at least 8 characters with uppercase, lowercase, digit, and special character.';
            return false;
        }

        // Check if username already exists
        $db = db_connect();
        if (!$db) {
            $_SESSION['flash'] = 'Database connection failed. Please try again later.';
            return false;
        }
        $statement = $db->prepare("SELECT username FROM users WHERE username = :name");
        $statement->bindValue(':name', $username);
        $statement->execute();
        
        if ($statement->fetch()) {
            $_SESSION['flash'] = 'Username already exists.';
            return false;
        }

        // Create user
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare("INSERT INTO users (username, password_hash, created_at) VALUES (:name, :hash, NOW())");
        $statement->bindValue(':name', $username);
        $statement->bindValue(':hash', $password_hash);
        
        if ($statement->execute()) {
            $_SESSION['flash'] = 'Account created successfully! Please log in.';
            return true;
        } else {
            $_SESSION['flash'] = 'Error creating account. Please try again.';
            return false;
        }
    }

    public function isLoggedIn() {
        return !empty($_SESSION['authenticated']) || !empty($_SESSION['auth']);
    }

    public function getCurrentUsername() {
        return $_SESSION['username'] ?? '';
    }
}
