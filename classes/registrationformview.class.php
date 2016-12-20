<?php

  class registrationformview{

     public function getHTML() {
       $form = '


           <form action="index.php?controller=registrationController" method="post">
      
        <div>
	         <label for="username">Username</label>
	         <input type="text" id="username" name="username" />
	     </div>

       <div>
	         <label for="password">Password</label>
	         <input type="password" id="password" name="password" />
	     </div>
       <div>
          <label for="email">Email</label>
          <input type="text" id="email" name="email" />
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
