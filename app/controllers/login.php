<?php

class Login extends Controller {

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

        $this->view('login/index');
    }

    public function authenticate() {
        // Check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model('User');

        try {
            $result = $user->authenticate($username, $password);

            if ($result) {
                // Login successful - redirect to home
                error_log("Login successful, redirecting to home");
                header('Location: /home');
                exit;
            } else {
                // Login failed - flash message already set in User model
                error_log("Login failed, redirecting back to login");
                header('Location: /login');
                exit;
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $_SESSION['flash'] = 'An error occurred during login. Please try again.';
            header('Location: /login');
            exit;
        }
    }
}