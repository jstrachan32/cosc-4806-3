<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function insertLog($username, $success) {
        $username = strtolower($username);
        $db = db_connect();

        $statement = $db->prepare("INSERT INTO login_attempts (username, attempt_success, attempt_dt) VALUES (:username,:success, NOW())");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':success', $success);
        $statement->execute();
    }

     public function lockoutTime() {
         $db = db_connect();
         $statement = $db->prepare("SELECT DATE_ADD(attempt_dt, INTERVAL 60 SECOND) AS attempt_plus_60 FROM login_attempts ORDER BY attempt_dt DESC LIMIT 1;");
         $statement->execute();
         $rows = $statement->fetch(PDO::FETCH_ASSOC);

         return $rows['attempt_plus_60'];
     }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$username = strtolower($username);
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);
      // insert into login_attempts table
      $this->insertLog($username, 1);
			header('Location: /home');
			die;
		} else {
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
			} else {
				$_SESSION['failedAuth'] = 1;
			}
      // insert failed login attempt
      $this->insertLog($username, 0);
      if ($_SESSION['failedAuth'] >= 3) {
          $lockout_time = $this->lockoutTime();
          $_SESSION['lockout_time'] = $lockout_time;
          header('Location: /lockout');
          die;
      } else {
          header('Location: /login');
          die;
      }
			
		}
    }

    public function signup($username, $password){
      // create new user
      $username = strtolower($username);
      // hash password before storing to db
      $hash = password_hash($password, PASSWORD_DEFAULT);
      
      $db = db_connect();

      // check if username already exists
      $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
      $statement->bindValue(':username', $username); 
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);

      if ($rows) {
        $_SESSION['usernameExists'] = 1;
        header('Location: /create');
        die;
      } else {
        unset($_SESSION['usernameExists']);
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :hash)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':hash', $hash);
        $statement->execute();

        header('Location: /login');
        die;
      }
      

    }

     public function checkLockout(){
        $sessionLockoutTime = $_SESSION['lockout_time'];
        $currentTime = time();
        $lockoutTime = strtotime($sessionLockoutTime);

       if ($currentTime > $lockoutTime) {
           unset($_SESSION['lockout_time']);
           unset($_SESSION['failedAuth']);
           header('Location: /login');
           die;
       } else {
           header('Location: /lockout');
           die;
       }
     }


}
