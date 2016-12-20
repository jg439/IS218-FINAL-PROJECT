<?php
  class userProfileView {
     public function getHTML($edit=false, $errors='') {
       if($edit == true) {
         $username = $_SESSION['username'];
         $user = new userModel;
         $line = $user->getUserInfomation($username);
         $profile = '
           <div>
             <form id="edit" action="index.php?controller=userController&action=edit" method="post" enctype="multipart/form-data">
	     <center><h2>Profile</h2></center>
             <div id="profile" class="profile">
               <div id="photo">
	         <center><img width="200px" height="200px" src="'.$line['avatar_url'].'"/></center>
               </div>
	       <br>
	       <div>
                 <label for="photo">
		 <center><input type="file" name="avatar" accept="image/*"></center>
               </div>
	       <br>
	       <div>

	       <div>
	         <label for="username">User Name:  </label>
		 <input type="text" id="username" name="username" value="'.$username.'"/>
               </div>
	       <br>
	       <div>
	         <label for="email">  User Email: </label>
		 <input type="email" id="email" name="email" value="'.$line['email'].'"/>
	       </div>
	       <br>
	       <div>
                 <input type="hidden" name="form" value="edit" />
               </div>
	       <br>
	       <div>
	         <input type="hidden" name="oldusername" value="'.$username.'" />
               </div>
	       <br>
	       <div class="button">
	         <center><button type="submit" id="submit">Update</button></center>
               </div>
	     </div>
	     </form>
	   </div>
         ';
       }
       else {
         $username = $_SESSION['username'];
         $user = new userModel;
         $line = $user->getUserInfomation($username);
      $profile = '
         <div id="profileform" class="form">
	   <form id="edit">
	   <center><h2>Profile</h2></center>
             <div id="profile" class="profile">
	       <div id="photo">
                 <center><img width="200px" height="200px" src="'.$line['avatar_url'].'"/></center>
	       </div>
	       <br><br>
	       <center><div>
	       <div>

	       <div>
	         <label>Username: '.$username.'</label><br><br>
         </div>
	       <div>
	         <label>Email: '.$line['email'].'</label><br><br>
               </div>
	       </div></center>
	       <div>
	         <center><button id="submit"><a href="index.php?controller=userController&action=edit">Edit</a></center>
               <br><br>
	       <div>
	     </div>
  	      ';
       }
    return $profile;
     }
  }

?>
