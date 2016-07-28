<?php

	include('check_user.php');
	var_dump($_SESSION);
?>
<html>
   
   <head>
      <title> Welcome </title>
   </head>
   
   <body>
       <form class="white" enctype="multipart/form-data" action="upload_image.php" method="post" name="changer">
         <div class="form-group">
            <label for="image">Select an Image</label>
            <input type="file" name="u_image" accept="image/jpeg"/>
         </div>
         <div class="form-group">
            <input type="submit" name="btn_uimage" value="Submit" class="btn btn-success"/>
         </div>
   </body>
   
</html>