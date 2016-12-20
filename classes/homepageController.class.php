<?php
    class homepageController extends controller {

      public function get() {
        $user = new userModel;
        $userhomepage = new userHomepageView;
        $homepageHTML = $userhomepage ->getHTML();
        $this->html .= $homepageHTML;
      }
      public function post() {}
      public function put() {}
      public function delete() {}

    }
?>
