<?php
    abstract class controller {

      protected $html;

      public function get() {}
      public function post() {}
      public function put() {}
      public function delete() {}

      //If you have time to finish add css..
      public function __construct(){
        $header = '<!DOCTYPE HTML>
                      <html>

                      <ul>
                        <li><a href="index.php?controller=userController">Login</a></li>
                        <li><a href="index.php?controller=registrationController">Register</a></li>
                        <li><a href= "index.php"> Back to Home</a></li>
                      </ul>



        </html>';



        $this->html .= $header;

      }
        public function getHTML() {

  	         return $this->html;
        }
    }
?>
