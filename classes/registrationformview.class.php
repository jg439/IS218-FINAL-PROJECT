<?php

  class registrationformview{

     public function getHTML() {
       $form = '


           <form action="index.php?controller=registrationController" method="post">
        <div>
          <label for="firstname">First Name</label>
          <input type="text" id="firstname" name="firstname" />
        </div>

        <div>
          <label for="lastname">Last Name</label>
          <input type="text" id="lastname" name="lastname" />
        </div>


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
