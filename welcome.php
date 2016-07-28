<?php

      include('check_user.php');

?>
<html>
   
   <head>
   </head>
   
   <body>
      <h1 style=" color: white">Welcome <?php echo $_SESSION['name']; ?></h1> 
      <?php 
      var_dump($_SESSION); 
      ?>
   </body>
   
</html>