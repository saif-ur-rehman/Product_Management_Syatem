<?php

      include('check_user.php');
      include ('db_connect1.php');

?>
<html>
   
   <head>

   </head>
   
   <body>
   <div class="container">
      <div><h1 style=" color: white"><?php echo $_SESSION['name']; ?></h1>
      <img class=" img-circle profile_img" src="<?php echo $s_image_url; ?>">
      </div>
         <div class=" tbl pull-left profile_tbl">
            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                    <tr>
                    <th class="t_head" colspan="4">Your Last 3 Products</th>
                    </tr>
                    <tr>  
                      <th>Product Image</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Dated</th>
                    </tr>
                  </thead>
         <?php 
            $sql = "SELECT * FROM product where user_id = $s_uid ORDER BY `product`.`p_date&time` DESC LIMIT 3 ";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
         ?>
         <tbody>
            <tr>
                <td><a href="show_my_details.php?getid=<?php echo $row['p_id']; ?>"><img class="mp_image_icon" src="<?php echo $row['p_image_path'];?>"></a></td>
                <td><div><?php echo $row['p_name'];?></div></td>
                <td><div><?php echo $row['p_price'];?></div></td>
                <td><div><?php echo $row['p_date&time'];?></div></td>
                </tr>
                </tbody>
         <?php } ?>
         </table>
      </div>
         <div>
            <div class=" tbl pull-right profile_tbl">
            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                  <tr>
                    <th class="t_head" colspan="4">Your Last 3 Reviews</th>
                    </tr>
                    <tr>  
                      <th>Review</th>
                      <th>Dated</th>
                      <th>Product</th>
                    </tr>
                  </thead>
         <?php 
            $sqlr = "SELECT * FROM review where user_id = $s_uid ORDER BY `review`.`r_date&time` DESC LIMIT 3 ";
            $resultr = $conn->query($sqlr);
            while($rowr = $resultr->fetch_assoc()){
               $p_id = $rowr['p_id'];
         ?>
         <tbody>
            <tr>
               <td><div><?php echo $rowr['r_body'];?></div></td>
                <td><div><?php echo $rowr['r_date&time'];?></div></td>
               <td>
               <?php 
               $sqlp = "SELECT p_image_path FROM product where p_id = $p_id "; 
                $resultp = $conn->query($sqlp);
                $rowp = $resultp->fetch_assoc();
               ?>
               <div> <a href="show_details.php?getid=<?php echo $p_id; ?>"><img class="mp_image_icon" src="<?php echo $rowp['p_image_path'];?>"></a></div>
               </td>
                
                </tr>
                </tbody>
         <?php } ?>
         </table>
      </div>
         </div>
      </div>

   </body>
   
</html>