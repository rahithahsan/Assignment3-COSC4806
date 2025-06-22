<?php

class Secret extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['auth'])) { header('Location:/login'); exit; }
        $this->view('secret/index');
    }
}
