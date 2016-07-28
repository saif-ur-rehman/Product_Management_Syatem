<?php
include('check_user.php');
include ('db_connect1.php');
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()){

      // echo $row['p_discription'];
      // echo $row['p_category'];  
      // echo $row['p_price'];  

    }
    
    ?>