<?php
    abstract class controller {

      protected $html;

      public function get() {}
      public function post() {}
      public function put() {}
      public function delete() {}


      public function __construct(){
        $header = '<!DOCTYPE HTML>
                      <html>

                      <ul>
                        <li><a href="#home">Login</a></li>
                        <li><a href="#news">Register</a></li>
                        <li><a href="#contact">Logout</a></li>
                      </ul>



        </html>';



        $this->html .= $header;

      }
        public function getHTML() {

  	         return $this->html;
        }
    }
?>
