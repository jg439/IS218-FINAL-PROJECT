<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Form for IS218</title>

        <link rel="stylesheet" href="css/styles.css">





  </head>

  <body>

    <div class="login-card">
		<h1>User Page</h1><br>
		<?php echo 'Welcome ';
		print_r($_POST["user"])?>
		<div class="login-help">
			<a href="logout.html">Logout</a>
		</div>
	</div>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>




  </body>
</html>
