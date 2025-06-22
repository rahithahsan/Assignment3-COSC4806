<?php
class Menu extends Controller
{
    /* /menu → just go back home */
    public function index(): void
    {
        header('Location: /home');
        exit;
    }

    public function loginInfo(): void
    {
        $this->view('menu/loginInfo');
    }

    public function registerInfo(): void
    {
        $this->view('menu/registerInfo');
    }
}