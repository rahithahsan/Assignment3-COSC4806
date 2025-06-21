<?php

class Login extends Controller {

    public function index() {		
	    $this->view('login/index');
    }

    public function verify(){
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('User');
            $user->authenticate($username, $password);
        } else {
            header('Location: /login');
            die;
        }
    }
}