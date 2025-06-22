
<?php

class Register extends Controller {

    public function index() {
        // Check if already logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $user = $this->model('User');

        if ($user->isLoggedIn()) {
            $_SESSION['flash'] = 'ℹ️ You are already logged in.';
            header('Location: /home');
            exit;
        }

        $this->view('register/index');
    }

    public function create() {
        // Check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm'] ?? '';

        $user = $this->model('User');

        try {
            $result = $user->register($username, $password, $confirm_password);
            
            if ($result) {
                // Registration successful - redirect to login
                error_log("Registration successful, redirecting to login");
                header('Location: /login');
                exit;
            } else {
                // Registration failed - flash message already set in User model
                error_log("Registration failed, redirecting back to register");
                header('Location: /register');
                exit;
            }
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $_SESSION['flash'] = 'An error occurred during registration. Please try again.';
            header('Location: /register');
            exit;
        }
    }
}
