<?php

class Create extends Controller
{
    public function index(): void
    {
        $this->view('create/index');
    }

    public function store(): void
    {
        $u  = trim($_POST['username'] ?? '');
        $p  = $_POST['password'] ?? '';
        $cp = $_POST['confirm']  ?? '';

        if ($u === '' || $p === '' || $cp === '') {
            $_SESSION['flash'] = 'All fields are required.';
            header('Location: /create'); exit;
        }

        if ($p !== $cp) {
            $_SESSION['flash'] = 'Passwords do not match.';
            header('Location: /create'); exit;
        }

        /* ---------- LOAD MODEL FIRST ---------- */
        $user = $this->model('User');

        if (!$user::passwordMeetsPolicy($p)) {
            $_SESSION['flash'] =
              'Password must be ≥8 chars and include upper/lower/number/special.';
            header('Location: /create'); exit;
        }

        /* ---------- register ---------- */
        $user->register($u, $p);

        $_SESSION['flash'] = 'Account created — log in!';
        header('Location: /login'); exit;
    }
}
