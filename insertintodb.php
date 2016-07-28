<html>
<head>
<?php 



include('check_user.php');
include ('db_connect1.php');
include('db_connect.php');
require_once('./config.php');


?>
<?php

$opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];
// Update Cart Function

       if(isset($_POST['submit'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }
               
            else{
                
                $_SESSION['cart'][$key]['quantity']=$val;
          
            }
        }
        }
    }


    if($opr=="dltp"){

                $val=0;
                var_dump($val);
                if(!empty($_SESSION['cart'])){
                foreach($_POST['quantity'] as $key => $val){
                if($val==0){
                unset($_SESSION['cart'][$key]);
            }
        }
        }
    }




 






    if(isset($_POST['submit1'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }
               
            else{
                $_SESSION['cart'][$key]['quantity']=$val;
            }
        }
        }
    }
  






// ADD to Cart functionality

    

?>
                    <div class="container">
                <div>
            <div class="white">
            <h1>Add More <a style="color: gold; text-decoration: none;" href="all_products.php?page=product">Products</a></h1>
            <form method="post" action="">

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
    // $_SESSION['cart'] = "";
    





    if(!empty($_SESSION['cart'])){
       // var_dump($_SESSION['cart']);
        $sql = "SELECT * FROM product WHERE p_id IN(";
            foreach($_SESSION['cart'] as $id => $value){
            $sql .=$id. ",";
        }
            $sql=substr($sql,0,-1) . ") ORDER BY p_id ASC";
            $result = $conn->query($sql);
            $totalprice = 0;
          


    $p_quantity = $_SESSION['cart'][$id]['quantity'];
    $o_price = $_SESSION['cart'][$id]['price'];
    $p_id = $id;
    $o_disc = $_SESSION['o_disc'];
    $o_amount_paid = $_SESSION['o_amount_paid'];
    




  $sql = "INSERT INTO `order` (user_id,o_price,o_disc,o_amount_paid)
    VALUES('$s_uid','$o_price','$o_disc','$o_amount_paid')";
    // use exec() because no results are returned
    $databaseConnection->exec($sql);
  









        $stmt = $databaseConnection->prepare("SELECT * FROM `order` ORDER BY `order`.`o_date&time` DESC LIMIT 1");
    $stmt->execute();
    $row = $stmt -> fetch();
    $o_id = $row ['o_id'];



















            if(!empty($result)){
            while($row = $result->fetch_assoc()){
                $subtotal= $_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price'];
                $totalprice += $subtotal;
    


$product_id=$row['p_id'];
$product_name=$row['p_name'];
$product_price=$row['p_price'];
$product_qty=$_SESSION['cart'][$row['p_id']]['quantity']; 
$product_admin=$row['user_id'];
    $sqlo = "INSERT INTO order_products (o_id,p_id,p_name,p_price,p_quantity,p_admin)
    VALUES('$o_id','$product_id','$product_name','$product_price','$product_qty','$product_admin')";   // use exec() because no results are returned
    $databaseConnection->exec($sqlo);









    ?>
    <tbody>









                    <tr>
                        <td class="tb_td"> <img id="img_tbl" src="<?php echo $row['p_image_path']; ?>"> </td>
                        <td class="tb_td"> <?php echo $row['p_name'];  ?> </td>
                        <td><input type="text" name="quantity[<?php echo $row['p_id']; ?>]" size="6" value="<?php echo $_SESSION['cart'][$row['p_id']]['quantity']; ?>"> </td>
                        <td class="tb_td"> <?php echo "PKR" .$row['p_price']; ?> </td>
                        <td><?php echo "PKR" .$_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price']. ".00"; ?></td>
<!--                         <td class="tb_td"> <a href="show_cart.php?opr=dltp"> <button class="btn btn-danger"  onclick="return confirm('Are you sure to delete this Product?')">Delete Product</button></a></td> -->
                    </tr>

                    </tbody>
                    <?php }
                    }
                     else { 
                    ?>
                        <tr><td colspan="2"><?php echo "<i><b>Add product to your cart."; ?></td></tr>
                    <?php
                        }
                    ?>
                    <tr>
                    <td colspan="3">Total Price: <td>
                    <td colspan="3"><h3><?php echo  "$totalprice". ".00 PKR"; ?></h3><td>
                    </tr>
                    <tr>
                        <?php   $dicount =($totalprice*10)/100;
                                $_SESSION['o_disc'] = $dicount;

                        ?>
                    <td colspan="3">Discount Amount @ 10% <td>
                    <td colspan="3"><h3><?php echo  "$dicount". ".00 PKR"; ?></h3><td>
                    </tr>
    
                    <tr>
                    <?php   $payedamount =$totalprice-$dicount;
                            $_SESSION['o_amount_paid'] = $payedamount;
                    ?>
                    <td colspan="3">Amount Payable <td>
                    <td colspan="3"><h3><?php echo "$payedamount". ".00 PKR"; 
                    $_SESSION['paid_amount'] = $payedamount;
                    ?></h3><td>
                    </tr>

                    </table>
                    <br/><button class="btn btn-warning pull-left" type="submit" name="submit">Update Cart</button>
                    </form>
                    <form action="order.php" method="POST">
                        <br/><br/><br/><button class="btn btn-warning pull-left" type="submit" name="btn_order">Show Order</button>
                    </form>
                    <form action="charge.php" method="POST">
                        <div class="pull-right">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key ="<?php echo $stripe['publishable_key']; ?>"
                          data-name ="Product Management System"
                          data-description="Please Give Your Card Information"
                          data-billingAddress = "true"
                          data-billingAddress-name =  "<?php echo $s_name; ?>"
                          data-email = "<?php echo $s_email; ?>" 
                          data-amount="<?php echo $payedamount. '00'; ?>"
                          data-currency="PKR"
                          data-locale="auto">
                          </script>
                          </div>
                    </form>
                    </div>
                    </div>
                    </div>


    <?php 
        }
        else{
        ?>

            <h1>You Have No Products in Cart Please Add <a style="color: gold; text-decoration: none;" href="all_products.php?page=product">Products</a></h1>

        <?php } 

       

        ?>

    

</html>