<?php

  class userformview{

     public function getHTML() {
       $form = '
           <form action="index.php?controller=userController" method="post">
             <div>
	         <label for="username">Username</label>
	         <input type="text" id="username" name="username" />
	     </div>
	     <div>
	         <label for="password">Password</label>
	         <input type="password" id="password" name="password" />
	     </div>
	     <div class="button">
	        <button type="submit">Register</button>
	     </div>
	   </form>

	   ';
        return $form;
     }
  }
?>
