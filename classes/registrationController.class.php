<?php
    class registrationController extends controller {

    public function get() {
      $form = new registrationformview;
  	}
      public function post() {

        if($_POST['form']){
            $db = dbConn::getConnection();
  	         $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
  	          $stmt->execute(array(':username' => $_POST['user_name']));
  	          $line = $stmt->fetch(PDO::FETCH_ASSOC);

  	  if(!empty($line['username'])){
  	    $error[] = 'UNVALID USERNAME!';
  	  }

      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
         	    $error[] = 'Please enter a valid email address';
  	  } else {
              $db = dbConn::getConnection();
  	    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
  	    $stmt->execute(array(':email' => $_POST['email']));
  	    $line = $stmt->fetch(PDO::FETCH_ASSOC);

  	    if(!empty($line['email'])){
  	      $error[] = 'Email provided is already in use.';
  	    }
      }
   }
}
      public function put() {}
      public function delete() {}
  }


 ?>
