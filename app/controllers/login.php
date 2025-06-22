<?php

class Login extends Controller
{
    public function index(): void
    {
        $this->view('login/index');
    }

    public function verify(): void
    {
        $u = $_POST['username'] ?? '';
        $p = $_POST['password'] ?? '';

        $user = $this->model('User');

        if ($user->lockedOut($u)) {
            $_SESSION['flash'] = 'Too many failed attempts – try again in 60 s.';
            header('Location: /login'); exit;
        }

        if ($user->authenticate($u, $p)) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($u);
            header('Location: /home'); exit;
        }

        $_SESSION['flash'] = 'Invalid credentials.';
        header('Location: /login'); exit;
    }
}
