<?php
  class userModel extends model {
    private $username;
    private $password;

    private function getUserHash($username){
      try {

        $db = dbConn::getConnection();
	       $stmt = $db->prepare('SELECT password, username, memberID, avatar_url FROM members WHERE username = :username');
         $stmt->execute(array('username' => $username));
	         return $stmt->fetch();
          }catch(PDOException $e) {
        echo '<p>'.$e->getMessage().'</p>';
      }
    }
    public function getUserInfomation($username){
      try {
        //Using prepared statements with PDO
        $db = dbConn::getConnection();
	      $stmt = $db->prepare('SELECT memberID, avtr_url, email FROM members WHERE username = :username');
        $stmt->execute(array('username' => $username));
	       return $stmt->fetch();
      }catch(PDOException $e) {
        echo '<p>'.$e->getMessage().'</p>';
      }
    }
      public function passwordHash($password){
      if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
      }
    }
    private function passwordVerify($password, $hash){
      return crypt($password, $hash) == $hash;
    }

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
    public function register($username, $password, $email) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('INSERT INTO members (username,password,email) VALUES (username, :password, :email)');
        $stmt->execute(array(
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

    public function update($oldusername, $username, $email, $avtr_url) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('UPDATE members SET username=:username, email=:email, avatar_url=:avatar_url WHERE username=:old');
        $stmt->execute(array(
          ':username' => $username,
          ':email' => $email,
          ':avatar_url' => $avtr_url,
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
