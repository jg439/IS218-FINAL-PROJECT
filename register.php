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
		<form action ="form.php" method = "post">
			<div>
				<label for "user">Username</label>
				<input required type="text" name="user">
			</div>


			<div>
				<label for "password">Password</label>
				<input required type="password" name="pass">
			</div>

			<div>
				<label for "ucid">UCID</label>
				<input required type="text" name="ucid" placeholder="contains letters">
			</div>

			<div>
				<label for "submit">
				<input type = "Submit" class="login login-submit" name= "Submit" value = "Submit" >
				</label>
			</div>

		</form>

		<div class="login-help">
			<a href="index.html">Login</a>
		</div>
	</div>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>




  </body>
</html>
