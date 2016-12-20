<?php
  class userLoginPageView {
     public function getHTML($errors='', $form) {

      $form = '

  <div class="signin-form">

  	<div class="container">


         <form class="form-signin" action="index.php?controller=userController" method="post" id="login-form">

          <h2 class="form-signin-heading">Log in</h2>

          <div class="form-group">
          <input type="text" class="form-control" name="user_name" placeholder="Username required" />
          <span id="check-e"></span>
          </div>

          <div class="form-group">
          <input type="password" class="form-control" name="user_pass" placeholder="Your Password" />
          </div>


          <div class="form-group">
              <button type="submit" name="btn-login" class="btn btn-default">
                  	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
              </button>
          </div>

        </form>

      </div>

  </div>';

  return $form;

}
?>
