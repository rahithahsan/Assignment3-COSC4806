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
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm'] ?? '';

        $user = $this->model('User');

        if ($user->register($username, $password, $confirm_password)) {
            header('Location: /login');
        } else {
            header('Location: /register');
        }
        exit;
    }
}