<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('user-profile.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);

	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('user-profile.php');
	}
	else
	{
		$error = "Wrong Details !";
	}
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form for IS218</title>

    <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>



        <link rel="stylesheet" href="css/styles.css">





  </head>

  <body>

    <div class="login-card">
		<h1>Log-in</h1><br>
		<form action ="form.php" method = "post">
			<input required type="text" name="user" placeholder="Username" >
			<input required type="password" name="pass" placeholder="Password">
			<input type="submit" name="login" class="login login-submit" value="login">

		</form>

		<div class="login-help">
			<a href="register.php">Register</a>
		</div>
	</div>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>




  </body>
</html>
