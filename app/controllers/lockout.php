<?php

class Lockout extends Controller {

    public function index() {		
      $this->view('lockout/index');
    }

    public function verify() {
        $user = $this->model('User');
        $user->checkLockout();
    }


}
