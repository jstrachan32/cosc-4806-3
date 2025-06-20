<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function create(){
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];

      $user = $this->model('User');
      $user->signup($username, $password); 
    }
}
