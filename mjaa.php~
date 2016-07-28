<?php

include ('db_connect.php');
include ('db_connect1.php');


?>

 <table class="table table-hover table-bordered tbl">
                  <thead class="white bgblack">
                    <tr>
                        <th>Image</th>  
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                  </thead>
<?php 
if(isset($_POST['btn_order'])){
// var_dump($_SESSION['cart']);
foreach($_SESSION['cart'] as $id => $value){
	$p_quantity = $_SESSION['cart'][$id]['quantity'];
	$o_price = $_SESSION['cart'][$id]['price'];
	$p_id = $id;
    $o_disc = $_SESSION['o_disc'];
    $o_amount_paid = $_SESSION['o_amount_paid'];
		var_dump($p_id);
		var_dump($p_quantity);
		var_dump($o_price);
        var_dump($o_disc);
        var_dump($o_amount_paid);
    }

    try {
        // $uid = int($s_uid);
    $sql = "INSERT INTO `order` (user_id,o_price,o_disc,o_amount_paid)
    VALUES('$s_uid','$o_price','$o_disc','$o_amount_paid')";
    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    echo '<div class="col-xs-3 pull-right" align="center"><div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Order Insert Seccesfully</div></div>';

// Select top latest row of order table

    $stmt = $databaseConnection->prepare("SELECT * FROM `order` ORDER BY `order`.`o_date&time` DESC LIMIT 1");
    $stmt->execute();
    $row = $stmt -> fetch();
    $o_id = $row ['o_id'];


// Select Data from product table We need p_name and p_price

            $sqlp = "SELECT * FROM product WHERE p_id IN(";
            foreach($_SESSION['cart'] as $id => $value){
            $sqlp .=$id. ",";
        }
            $sqlp=substr($sqlp,0,-1) . ") ORDER BY p_id ASC";
            $resultp = $conn->query($sqlp);
            if(!empty($resultp)){
            while($rowp = $resultp->fetch_assoc()){

             

 
    $sqlo = "INSERT INTO order_products (o_id,p_id,p_name,p_price,p_quantity,p_admin)
    VALUES('$o_id','1','1','1','1','1')";   // use exec() because no results are returned
    $databaseConnection->exec($sqlo);


    
// try
// {
//     // Insert into order_products table
//     $sqlo = "INSERT INTO order_products (o_id,p_id,p_name,p_price,p_quantity,p_admin)
//     VALUES('$o_id','1','1','1','1','1')";
//     // use exec() because no results are returned
//     $databaseConnection->exec($sqlo);
//     }
//  catch(PDOException $e)
//     {
//     echo $sqlo . "<br>" . $e->getMessage();
//     }    


    $databaseConnection = null;
}

}

}       
	

?>
