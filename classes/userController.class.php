<?php
    class userController extends controller {
      public function get() {


	if(isset($_GET['action'])){
          $get = $_GET;
          $action = $_GET['action'];


	  if($action=="myprofile"){
                $user = new userModel;
                if($user->isLoggedIn()){
                  $profile = new userProfileView;
                  $profileHTML = $profile->getHTML();
                  $this->html .= $profileHTML;
                } else {
                  $error = 'PLEASE LOGIN !';
                }
            }
            elseif($action=="edit"){
              $user = new userModel;
              if($user->isLoggedIn()){
                $profile = new userProfileView;
                $profileHTML = $profile->getHTML(true);
                $this->html .= $profileHTML;
              } else {
                $error = 'PLEASE LOGIN !';
              }
            }
            elseif($action=="usertable"){
              $table = new userTableView;
              $tableHTML = $table->getHTML();
              $this->html .= $tableHTML;
            }

            elseif($action=="logout"){
	      $user = new userModel;
	      $logoutpage = new userLogoutPageView;
	      $logoutHTML = $logoutpage->getHTML();
	      $this->html .= $logoutHTML;

	    }
            elseif($action=="joined"){

              $form = new userLoginPageView;
              $form_html = $form->getHTML();
              $this->html .= $form_html;
            }
      }

    elseif(isset($_GET['errors'])) {

	    if($_GET['form'] == 'edit') {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $profile = new userProfileView;
              $profileHTML = $profile->getHTML(true,$errors);
              $this->html .= $profileHTML;
            } else {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $form = new userLoginPageView;
              $form_html = $form->getHTML($errors, $formtype);
              $this->html .= $form_html;
            }
          }
	  else{
            $formtype = '';
            $errors = '';
            $form = new userLoginPageView;
            $form_html = $form->getHTML($errors, $formtype);
            $this->html .= $form_html;
          }
        }

      public function post() {

        if($_POST['form'] == 'sign_up'){
              $db = dbConn::getConnection();
       		    $stmt = $db->prepare('SELECT user_name FROM users WHERE user_name = :user_name');
       		    $stmt->execute(array(':user_name' => $_POST['user_name']));
		          $line = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($line['user_name'])){
		  $error[] = 'UNVALID USERNAME!';
          	}

            if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
          	    $error[] = 'Please enter a valid email address';
          	} else {
              $db = dbConn::getConnection();
          		$stmt = $db->prepare('SELECT user_email FROM users WHERE user_email = :user_email');
          		$stmt->execute(array(':user_email' => $_POST['user_email']));
          		$line = $stmt->fetch(PDO::FETCH_ASSOC);
          		if(!empty($line['email'])){
          			$error[] = 'Email provided is already in use.';
          		}
          	}
          }



	  elseif($_POST['form'] == 'edit') {
            $oldusername = $_POST['oldusername'];
            $user = new userModel;
            $reset = $user->getUserInfomation($oldusername);
            $oldemail = $reset['user_email'];
            $username = $_POST['user_name'];
            $email = $_POST['user_email'];
            $profile = $reset['profile'];
            $check = false;

            while($check == false) {
              $db = dbConn::getConnection();
              $stmt = $db->prepare('SELECT user_name FROM users WHERE user_name = :user_name');
              $stmt->execute(array(':user_name' => $username));
              $line = $stmt->fetch(PDO::FETCH_ASSOC);
              if(!empty($line['user_name']) && $line['user_name'] !== $oldusername){
                $error[] = 'Username provided is already in use.';
                goto end;
              }
              $db = dbConn::getConnection();
          		$stmt = $db->prepare('SELECT user_email FROM users WHERE user_email = :user_email');
          		$stmt->execute(array(':user_email' => $email));
          		$line = $stmt->fetch(PDO::FETCH_ASSOC);
          		if(!empty($line['user_email']) && $line['user_email'] !== $oldemail){
          			$error[] = 'Email provided is already in use.';
                goto end;
          		}
              $check = true;
            }
            define("UPLOAD_DIR", "/afs/cad.njit.edu/u/j/g/jg439/public_html/IS218FINAL/images/");

	    if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["tmp_name"] != ""){
            	$fileName = $_FILES["avatar"]["name"];
              $fileTmpLoc = $_FILES["avatar"]["tmp_name"];
            	$fileType = $_FILES["avatar"]["type"];
            	$fileSize = $_FILES["avatar"]["size"];
            	$fileErrorMsg = $_FILES["avatar"]["error"];
            	$kaboom = explode(".", $fileName);
            	$fileExt = end($kaboom);
            	$db_file_name = rand(100000000000,999999999999).".".$fileExt;

              if($fileSize > 1048576) {
            		$error[] = "Your image file was larger than 1mb";
            		goto end;
            	} else if (!preg_match("/\.(gif|jpg|png)$/i", $fileName) ) {
            		$error[] = "Your image file was not jpg, gif or png type";
            		goto end;
            	} else if ($fileErrorMsg == 1) {
            		$error[] = "An unknown error occurred";
            		goto end;
            	}
              $profile = "images/$db_file_name";
              $moveResult = move_uploaded_file($fileTmpLoc, UPLOAD_DIR . "/$db_file_name");

		if ($moveResult != true) {
            		$error[] = "File upload failed";
            		goto end;
            	}
            }
            $user->update($oldusername, $username, $email, $profile);
            end:
          }

          if(!isset($error)){
            try {
                if(isset($_POST['user_name']) && isset($_POST['user_pass'])){
                  $user = new userModel;
                  if($user->login($_POST['user_name'], $_POST['user_pass'])){
  		              header('Location: index.php?controller=userController&action=profile');
                    exit;
                  } else{
                    $error[] = 'Wrong username or password';
                  }
                } else {
                $user = new userModel;
                $hashedpassword = $user->passwordHash($_POST['user_pass']);
                $user->register($_POST['user_name'], $hashedpassword, $_POST['user_email']);
              }
        		} catch(Exception $e) {
        		    $error[] = $e->getMessage();
        		}
        	}
          if(isset($error)){
            echo '<script>console.log("before $errors");</script>';
            $err_url = 'index.php?controller=userController&errors=';
            $get_url = '&form=' . $_POST['form'];
            foreach($error as $error){
              $err_url .= $error;
					  }
            $fin_url = $err_url . $get_url;
            echo '<script>console.log("past $fin_url");</script>';
  					header("Location: $fin_url");
				  }
      }
      public function put() {}
      public function delete() {}
    }
?>
