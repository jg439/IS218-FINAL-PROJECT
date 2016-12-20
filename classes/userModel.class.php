<?php
  class userModel extends model {
    private $username;
    private $password;

    public function setUsername($username) {
      $this->username = $username;
    }
    public function getUsername() {
      return $this->username;
    }
    public function setPassword($password) {
      $this->password = $password;
    }
    public function getPassword() {
      return $this->password;
    }

    public function save(){

      $array = array($username->getUsername,$password->getPassword);

      print_r $array;
    }


  }

?>
