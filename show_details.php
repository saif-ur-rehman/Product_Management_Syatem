<?php
include('check_user.php');
include ('db_connect1.php');
include ('db_connect.php');
?>
<?php
$curr_pid = $_GET['getid'];
// Add Review
if(isset($_POST['btn_rev'])){


$review = $_POST['review'];



try {

    
    // sql to insert table data
    $cur_id = (int)$s_uid;
    $sql = "INSERT INTO review (r_body,user_id,p_id)
    VALUES('$review','$cur_id','$curr_pid')";

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 $databaseConnection = null;
 echo '<div class="col-xs-3 pull-right" align="center"><div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your Review is Submited</div></div>';

}
?>
<?php

// ADD to Cart functionality
if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['getid']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $sql_p="SELECT * FROM product WHERE p_id={$id}";
        $result = $conn->query($sql_p);
        if(mysqli_num_rows($result)!=0){
            $row_p = $result->fetch_assoc();
            $_SESSION['cart'][$row_p['p_id']]=array("quantity" => 1, "price" => $row_p['p_price']);
        }else{
            $message="Product ID is invalid";
        }
    }
    echo '<div class="col-xs-3 pull-right" align="center"><div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Product is Added to Your Cart</div></div>';
}
?>





<?php

    if(isset($_GET['getid'])){
    $curr_pid = $_GET['getid'];

$sql = "SELECT * FROM product where p_id= $curr_pid";
$result = $conn->query($sql);
    $row = $result->fetch_assoc();
    }

?>
            <div class="container">
            <div class="p_main">
                        
                        <div><div class="col-md-offset-1 p_heading white left"><?php echo $row['p_name'];?></div>
                        <div class="col-md-offset-4 p_heading white left">Price: <?php echo $row['p_price'];?> PKR </div></div>
                        <div class="left"><img id="p_image_big" src="<?php echo $row['p_image_path'];?>"></div>
                        <div class="left">
                        <div class="p_left">
                        <div class="p_heading"> Category: <?php echo $row['p_category'];?></div>
                        <p class="p_disc">Discription: <?php echo $row['p_discription'];?></p>      
                        <div class="date_time"> Dated: <?php echo $row['p_date&time'];?></div>
                        </div>
                        </div>
            

            </div>
            <div class="pull-right">
                <a href="show_details.php?page=product&action=add&getid=<?php echo $curr_pid; ?>"> <button class="btn btn-crt">Add to Cart</button> </a>
                <a href="show_cart.php?opr=shcrt"> <button class="btn btn-crt"> Check Out</button> </a>
            </div>
            </div>

<?php



 if ($row['user_id']!=$s_uid) {
         
                ?>
        

            <div class="left clear_both">
                <form class="form" method="POST" action="">
                    <div class="form-group white left">
                        <div class="mtmargin"> </div>
                        <div>
                        <div class="left"><img id="image_cmt" src="<?php echo $s_image_url; ?>"></div>
                        <div class="left">
                        <textarea class="form-control textarea" name="review" rows="5" cols="95" placeholder="Your Comments Here"></textarea>
                        </div>
                        </div>
                    </div>
            <div class="left">
                <button type="submit" name="btn_rev" class="btn btn-info col-md-offset-4 tmargin"> Post Review</button>
            </div>

                </form>
            </div>

 <?php   } ?>




 <?php 

    // --------------------Get the Reviews of the current p_id--------------------

    $sql = "SELECT * FROM review where p_id = $curr_pid ORDER BY `review`.`r_date&time` DESC ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    ?>
        <div class="container">
        <div>
            <div class="left">
                <!-- <a href="show_details.php?getid=<?php echo $row['p_id']; ?>"><img id="p_image_icon" src="<?php echo $row['p_image_path'];?>"></a> -->
                
                <?php 
                    $sql1 = "SELECT image_path,name FROM user where user_id = '".$row['user_id']."'";
                    $result1 = $conn->query($sql1);
                    while($row1 = $result1->fetch_assoc()){
                    $i_path = $row1['image_path'];
                    $i_name = $row1['name'];
                ?>
                <div class="white"><?php echo $i_name; ?></div>
                <div>
                <div class="left"><img id="img_comnt" src="<?php echo $i_path; ?>"></div>
                <?php } ?>
                <div class="left s_review"><?php echo $row['r_body'];?>
                </div>
                </div>
                <div class="white">Review Time:<?php echo $row['r_date&time'];?></div>
            </div>
        </div>
    </div>
    <hr>

<?php
}
?>







    
