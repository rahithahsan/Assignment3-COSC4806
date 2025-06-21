<?php

class Login extends Controller {

    public function index() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Bounce if already logged in
        if (!empty($_SESSION['authenticated'])) {
            $_SESSION['flash'] = 'ℹ️  You are already logged in.';
            header('Location: /home');
            exit;
        }
        
        $this->view('login/index');
    }

    public function verify() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->model('User');
            if ($user->authenticate($username, $password)) {
                // Success - redirect to home
                header('Location: /home');
                exit;
            } else {
                // Failed - redirect back to login with error (flash message already set in User model)
                header('Location: /login');
                exit;
            }
        } else {
            header('Location: /login');
            exit;
        }
    }
}