<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('user-profile.php');
}

if(isset($_POST['btn-register']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);

	if($uname=="")	{
		$error[] = "provide username !";
	}
	else if($umail=="")	{
		$error[] = "provide email id !";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['user_name']==$uname) {
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass)){
					$user->redirect('register.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
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
		<h1>Register</h1><br>
		<form method="post">
			<?php
			if(isset($error))
			{
				foreach($error as $error)
				{
					 ?>
										 <div>
												<?php echo $error; ?>
										 </div>
										 <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
								 Successfully registered <a href='index.php'>login</a> here
								 </div>
								 <?php
			}
			?>
			<div>
				<label for "user">Username</label>
				<input required type="text" name="user">
			</div>

			<div>
				<label for "email">Email</label>
				<input required type="email" name="email" placeholder="please enter your njit email address">
			</div>

			<div>
				<label for "password">Password</label>
				<input required type="password" name="pass">
			</div>



			<div>
				<label for "submit">
				<button type = "Submit" class="login login-submit" name= "Submit" value = "Submit" >
				</label>
			</div>

		</form>

		<div class="login-help">
			<a href="index.php">Login</a>
		</div>
	</div>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>




  </body>
</html>
