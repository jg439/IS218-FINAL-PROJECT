<?php
    abstract class controller {

      protected $html;

      public function get() {}
      public function post() {}
      public function put() {}
      public function delete() {}


      //From our last assignment where we autoload a very easy program I deleted some of the code that I had on get, and added a construct function.
      //Adding my index from my before code...
      public function __construct(){

        //this header is going to include the html that users are going first to see to get into my page

        $header = '<!DOCTYPE>
        <html>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>IS 218 - Julia Login and Registration System</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="style.css" type="text/css"  />
        </head>
        <body>

        <div class="signin-form">
        <h1> Welcome to my IS218 Autoload Program!</h1>
              	<br />
                    <label> If you have an account, please log in <a href = "index.php">Login in </a></label>
                    <label>If you do not have an account yet, please sign in <a href="sign-up.php">Sign Up</a></label>
              </form>

            </div>

        </div> ';
        $this.html-> .= $header;

      }


  public function getHTML() {

  	         return $this->html;
        }
    }
?>
