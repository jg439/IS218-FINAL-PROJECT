<?php
  class usertableview {
     public function getHTML($errors='') {
       if(isset($errors)){
         $errorhtml = '
                      <div>
                        <p>'.$errors.'</p>
                      </div>
         ';
       } else {
         $errorhtml = '';
       }
       try {
         //Get database
         $db = dbConn::getConnection();
 			   $stmt = $db->query('SELECT user_ID, user_name, user_email, joining_date FROM users ORDER BY joining_date');
 		  	 $array = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         $headers = array(
             '0' => 'MemberID',
             '1' => 'Username',
             '2' => 'Email'
             '3' => 'Joining Date'
         );
         array_unshift($array, $headers);
 		   } catch(PDOException $e) {
 		     echo '<p>'.$e->getMessage().'</p>';
 		   }
       $table = new table();
       $table_h = $table->getHTML($array);
       $table_html = '
           <h1>User table</h1>
           '.$errorhtml.'
           '.$table_h.'
           
       ';
       return $table_html;
    }
}
?>
