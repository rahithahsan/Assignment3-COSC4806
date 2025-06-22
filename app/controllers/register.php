<?php

class Register extends Controller {

    public function index() {
        // Check if already logged in
        session_start();
        $user = $this->model('User');

        if ($user->isLoggedIn()) {
            $_SESSION['flash'] = 'ℹ️ You are already logged in.';
            header('Location: /home');
            exit;
        }

        $this->view('register/index');
    }

    public function create() {
        // Start output buffering to prevent header issues
        if (!ob_get_level()) {
            ob_start();
        }
        
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

        // Basic validation
        if (empty($username) || empty($password) || empty($confirm_password)) {
            $_SESSION['flash'] = 'All fields are required.';
            header('Location: /register');
            exit;
        }

        if ($password !== $confirm_password) {
            $_SESSION['flash'] = 'Passwords do not match.';
            header('Location: /register');
            exit;
        }

        $user = $this->model('User');

        try {
            if ($user->register($username, $password, $confirm_password)) {
                $_SESSION['flash'] = 'Account created successfully! Please log in.';
                header('Location: /login');
            } else {
                $_SESSION['flash'] = 'Registration failed. Please try again.';
                header('Location: /register');
            }
        } catch (Exception $e) {
            $_SESSION['flash'] = 'An error occurred during registration. Please try again.';
            header('Location: /register');
        }
        exit;
    }
}