<html>
   
   <head>
      <title>Paging Using PHP</title>
   </head>
   
   <body>
      <?php
         include 'header.php';
			include ('db_connect1.php');       
         $rec_limit = 5;

         /* Get total number of records */
         $sql = "SELECT count(p_id) as `num` FROM product ";
         $retval = $conn->query( $sql);
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         $row = $retval->fetch_assoc();
         $rec_count = $row['num'];
         
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql = "SELECT *  
            FROM product
            LIMIT $offset, $rec_limit";
            
         $retval = $conn->query( $sql);
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         
         while($row = $retval->fetch_assoc()) {
            echo " <div class='white'>Product ID :{$row['p_id']}  <br> 
               NAME : {$row['p_name']} <br> 
               Email : {$row['user_id']} <br> 
               --------------------------------<br></div>";
         }
         
         if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a> |";
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a>";
         }
         
         
      ?>
      
   </body>
</html>