<?php
    class registrationController extends controller {

    public function get() {
      $form = new registrationformview;
      $form_html = $form->getHTML();
      $this->html .= $form_html;

  	}
      public function post() {
        print_r($_POST);
	       $user = new registrationModel;
	       $user->setUsername($_POST['username']);
	       $user->setPassword($_POST['password']);
         $user->setEmail($_POST['email']);
         $user->setAddress($_POST['password']);

}
      public function put() {}
      public function delete() {}
  }


 ?>
