<?php
include ('header.php');
session_start();
include ('db_connect1.php');





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









$curr_id = $_GET['getid'];
$sql = "SELECT * FROM product where p_id= $curr_id";
$result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>
            <div class="container">
            <div class="p_main">
                        
                        <div><div class="col-md-offset-1 p_heading white left"><?php echo $row['p_name'];?></div>
                        <div class="col-md-offset-7 p_heading white left">Price: <?php echo $row['p_price'];?> $ </div></div>
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
                <div class="left rmargin">
                <a href="details.php?page=product&action=add&getid=<?php echo $curr_id; ?>"> <button class="btn btn-crt">Add to Cart</button> </a>
                </div>
                <div class="left">
                <a href="show_lo_cart.php?opr=chklg"> <button class="btn btn-crt"> Check Out</button> </a>
                </div>
            </div>
            </div>

 <?php 

    // --------------------Get the Reviews of the current p_id--------------------

    $sql = "SELECT * FROM review where p_id = $curr_id ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    ?>
    <div class="container">
        <div>
            <div class="left">
                <!-- <a href="details.php?getid=<?php echo $row['p_id']; ?>"><img id="p_image_icon" src="<?php echo $row['p_image_path'];?>"></a> -->
                
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
                <div class="left s_review"><?php echo $row['r_body'];?></div>
                </div>
                <div class="white">Review Time:<?php echo $row['r_date&time'];?></div>
            </div>
        </div>
    </div>
    <hr>

<?php
}
?>







    
<?php
if(isset($_POST['btn_rev'])){


$review = $_POST['review'];



try {

    
    // sql to insert table data
    $cur_id = (int)$s_uid;
    $sql = "INSERT INTO review (r_body,user_id,p_id)
    VALUES('$review','$cur_id','$curr_id')";

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 $databaseConnection = null;

}