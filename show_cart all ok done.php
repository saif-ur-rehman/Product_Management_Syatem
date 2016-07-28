<html>
<head>
<?php  
include('check_user.php');
include ('db_connect1.php');?>
<?php

// Update Cart Function

    if(isset($_POST['submit'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['quantity']=$val;
            }
        }
        }
    }




// ADD to Cart functionality

    $opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];



    if($opr=="shcrt"){
        var_dump($_SESSION['cart']);
        $sql = "SELECT * FROM product WHERE p_id IN(";
            foreach($_SESSION['cart'] as $id => $value){
            $sql .=$id. ",";
        }
            $result = $conn->query($sql);
            ?>
                <div class="container">
                <div>
            <div class=" tbl left">
            <h1>View Cart || <a href="index.php?page=product">Products</a></h1>
            <form method="post" action="cart.php">

            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                    <tr>  
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                  </thead>
            <?php 
            $totalprice = 0;
            if(!empty($result)){
            while($row = $result->fetch_assoc()){
                $subtotal= $_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price'];
                $totalprice += $subtotal;
    ?>
    <tbody>
                    <tr>
                        <td class="tb_td"> <img id="img_tbl" src="<?php echo $row['p_image_path']; ?>"> </td>
                        <td class="tb_td"> <?php echo $row['p_name']; ?> </td>
                        <td><input type="text" name="quantity[<?php echo $row['p_id']; ?>]" size="6" value="<?php echo $_SESSION['cart'][$row['p_id']]['quantity']; ?>"> </td>
                        <td class="tb_td"> <?php echo "PKR" .$row['p_price']; ?> </td>
                        <td><?php echo "PKR" .$_SESSION['cart'][$row['product_id']]['quantity']*$row['product_price']. ".00"; ?></td>
                        <td class="tb_td"><a onclick="return confirm('Are you sure to delete this user?')" href="?tag=users&opr=pudl&uid=<?php echo $row['user_id']; ?>"> <button class="btn btn-danger" type="submit" name="btn_pub">Delete User</button> </a> </td>
                    </tr>

                    </tbody>
                    <?php }
                    }
                    else { 
                    ?>
                        <tr><td colspan="4"><?php echo "<i>Add product to your cart."; ?></td></tr>
                    <?php
                        }
                    ?>
                    <tr>
                    <td colspan="3">Total Price: <h1><?php echo "PKR" .$totalprice. ".00"; ?></h1><td>
                    </tr>
                    <tr>
                        <?php   $dicount =($totalprice*10)/100;

                        ?>
                    <td colspan="3">Discount 10%<h1><?php echo "PKR" ."$dicount"; ?></h1><td>
                    </tr>
    
                    <tr>
                    <?php   $payedamount =$totalprice-$dicount;
                    ?>
                    <td colspan="3">Amount to pay <h1><?php echo "PKR" ."$payedamount". ".00"; ?></h1><td>
                    </tr>

                    </table>
                    <br/><button type="submit" name="submit">Update Cart</button>
                    </form>
                    <br/><p>To remove an item, set quantity to 0.</p>
                    </div>
                    </div>
                    </div>


    <?php 
        }
    ?>  

    

</html>