<html>
<head>
<?php 



include('check_user.php');
include ('db_connect1.php');
include('db_connect.php');
require_once('./config.php');

  $token  = $_POST['stripeToken'];



  $customer = Stripe_Customer::create(array(
      'email' =>  $s_email ,
      'source'  => $token
  ));

  $charge = Stripe_Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $_SESSION['paid_amount']*100,
      'currency' => 'pkr'
  ));

  echo '<h1 class="white">Successfully charged'.$_SESSION['paid_amount'].'.00 PKR </h1>';




    if(!empty($_SESSION['cart']))
    {
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


    $dicount =($totalprice*10)/100;
    $_SESSION['o_disc'] = $dicount;

    $payedamount =$totalprice-$dicount;
    $_SESSION['o_amount_paid'] = $payedamount;


    }
} 
}

       unset($_SESSION['o_amount_paid']);
       unset($_SESSION['o_disc']);
       unset($_SESSION['cart']);

        ?>

    

</html>