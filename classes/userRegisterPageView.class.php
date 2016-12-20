<?php
  class userLoginPageView {
     public function getHTML($errors='', $form) {

      $form = '
          <form id="register" action="index.php?controller=userController" method="post">
            <h2><center>Register</center></h2>
	    <div>
	      <label for="firstname">First Name:</label><br>
              <input type="text" id="firstname" name="first_name"/>
            </div>
	    <br>
	    <div>
	      <label for="lastname">Last Name:</label><br>
	      <input type="text" id="lastname" name="last_name"/>
	    </div>
	    <br>
	    <div>
	      <label for="username">User Name:</label><br>
              <input type="text" id="username" name="user_name"/>
            </div>
	    <br>
	    <div>
	      <label for="email">Email:</label><br>
	      <input type="email" id="email" name="email"/>
            </div>
	    <br>
	    <div>
	      <label for="password">Password:</label><br>
	      <input type="password" id="password" name="password"/>
            </div>
	    <br>
	    <div>
	      <label for="comfirmpassword">Comfirm Password:</label><br>
	      <input type="password" id="confirmpassword" />
            </div>
	    <br>
	    <div>
	      <center><button type="submit" id="submit">Register</button></center>
            </div>
	    <br>
	  </form>
        </div>';
       return $form;
    }
}
?>
