<?php
  class userModel extends model {
    private $username;
    private $password;
    private function getUserHash($username){
      try {
        //Using prepared statements with PDO
        $db = dbConn::getConnection();
	$stmt = $db->prepare('SELECT password, username, memberID, avatar_url FROM members WHERE username = :username');
        $stmt->execute(array('username' => $username));
	return $stmt->fetch();
      }catch(PDOException $e) {
        echo '<p class="bg-danger">'.$e->getMessage().'</p>';
      }
    }
    public function getUserInfomation($username){
      try {
        //Using prepared statements with PDO
        $db = dbConn::getConnection();
	$stmt = $db->prepare('SELECT first_name, last_name, memberID, avatar_url, email FROM members WHERE username = :username');
        $stmt->execute(array('username' => $username));
	return $stmt->fetch();
      }catch(PDOException $e) {
        echo '<p class="bg-danger">'.$e->getMessage().'</p>';
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
      if($this->passwordVerify($password,$line['password']) == 1){
        $_SESSION['loggedin'] = true;
	$_SESSION['username'] = $line['username'];
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
    public function register($first_name, $last_name, $username, $password, $email) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('INSERT INTO members (first_name,last_name,username,password,email) VALUES (:first, :last, :username, :password, :email)');
        $stmt->execute(array(
          ':first' => $first_name,
          ':last' => $last_name,
          ':username' => $username ,
          ':password' => $password,
          ':email' => $email
        ));
        header('Location: index.php?controller=userController&action=joined');
        exit;
      }catch(PDOException $e) {
        $error[] = $e->getMessage();
      }
    }

    public function update($oldusername, $first_name, $last_name, $username, $email, $avatar_url) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('UPDATE members SET first_name=:first, last_name=:last, username=:username, email=:email, avatar_url=:avtr_url WHERE username=:old');
        $stmt->execute(array(
          ':first' => $first_name,
          ':last' => $last_name,
          ':username' => $username,
          ':email' => $email,
          ':avatar_url' => $avatar_url,
          ':old' => $oldusername
        ));
        $_SESSION['username'] = $username;
        header('Location: index.php?controller=userController&action=profile');
        exit;
      }catch(PDOException $e) {
        echo '<script>console.log("'.$e->getMessage().'");</script>';
        $error[] = $e->getMessage();
      }
   }
}
?>
