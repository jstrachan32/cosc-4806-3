<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function register(){
      unset($_SESSION['failedAuth']);
      $user = $this->model('User');
      
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];

      $user->checkUsername($username);

      if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || strlen($password) < 8) {
        $_SESSION['passwordError'] = 1;
        header('Location: /create');
        die;
      } else {
        unset($_SESSION['passwordError']);
      }
      
      $user->signup($username, $password); 
    }
}
