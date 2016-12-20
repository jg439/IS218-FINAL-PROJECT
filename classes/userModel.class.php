<?php

  class userModel extends model {

    private $username;
    private $password;

    private function getUserHash($username){
		  try {

        //Using prepared statements with PDO
        $db = dbConn::getConnection();
			  $stmt = $db->prepare('SELECT user_pass, user_name, user_ID, profile FROM users WHERE user_name = :user_name');
        $stmt->execute(array('user_name' => $username));
		  	return $stmt->fetch();
		  } catch(PDOException $e) {
		    echo '<p>'.$e->getMessage().'</p>';
		  }
	  }

    public function getUserInfomation($username){
		  try {
        //Using prepared statements with PDO
        $db = dbConn::getConnection();
			  $stmt = $db->prepare('SELECT user_name, user_email, profile FROM users WHERE user_name = :user_name');
        $stmt->execute(array('user_name' => $username));
		  	return $stmt->fetch();
		  } catch(PDOException $e) {
		    echo '<p>'.$e->getMessage().'</p>';
		  }
	  }
    //Using BCrypt for secure storage:
    //https://www.sitepoint.com/password-hashing-in-php/

    public function passwordHash($password){
      if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
      }
    }

    private function passwordVerify($password, $hash){
      return crypt($password, $hash) == $hash;
    }
    //main class file contains register(),login(),is_loggedin(),redirect()
    //http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html

  	public function login($username,$password){
  		$line = $this->getUserHash($username);
  		if($this->passwordVerify($password,$line['user_pass']) == 1){
  		    $_SESSION['loggedin'] = true;
  		    $_SESSION['user_name'] = $line['user_name'];
  		    return true;
  		}
  	}
    public function logout(){
      session_destroy();
    }
    public function isLoggedIn(){
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        return true;
      }
    }
    public function register($username,$email,$password) {
      try {
        //Get database
        $db = dbConn::getConnection();
        //insert into database with a prepared statement
        $stmt = $db->prepare('INSERT INTO users (user_name,user_email,user_pass) VALUES (:user_name,:user_email,:user_pass)');
        $stmt->execute(array(
          ':user_name' => $username,
          ':user_email' => $email,
          ':user_pass' => $password

        ));
        //redirect to index page
        header('Location: index.php?controller=userController&action=joined');
        exit;
    } catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
  }
  public function update($oldusername,$username, $email, $profile {
    try {
      $db = dbConn::getConnection();
      $stmt = $db->prepare('UPDATE users SET user_name=:user_name, user_email=:user_email, profile=:profile WHERE user_name=:old');
      $stmt->execute(array(

        ':user_name' => $username,
        ':user_email' => $email,
        ':profile' => $profile,
        ':old' => $oldusername
      ));
      $_SESSION['user_name'] = $username;
      header('Location: index.php?controller=userController&action=profile');
      exit;
  } catch(PDOException $e) {
      echo '<script>console.log("'.$e->getMessage().'");</script>';
      $error[] = $e->getMessage();
  }
}
}
?>
