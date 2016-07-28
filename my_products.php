<html>
<head>



<!-- For Delete Product -->


    <?php

include('check_user.php');
include ('db_connect1.php');



   $msg="";
   $opr="";
   if(isset($_GET['opr']))
   $opr=$_GET['opr'];
   
if(isset($_GET['p_id']))
   $id=$_GET['p_id'];
   
   if($opr=="del")
{
   $del_sql = "DELETE FROM product WHERE p_id=$id";
   $result = $conn->query($del_sql);
   if($del_sql) {
        {


?>

            <div>
                <div class='alert alert-success col-md-4 col-md-offset-8'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                </button>
                <strong>Sucess!</strong> Record Deleted"
                </div>
                </div>
  <?php

        }
    }
   else
      $msg="Could not Delete :".mysql_error();  
         
}
   
?>
       <form role="form" data-toggle="validator" method="POST" class="form-horizontal">
        <div class="form-group">
            <div class="col-md-9 col-md-offset-1     col-xs-9 col-sm-10">
            <input type="text" class="form-control" name="searchtxt" Placeholder="Enter product name for search" autocomplete="off"/></div>
            <button type="submit" name="btnsearch" class="btn btn-info"><span class="fa fa-search"></span>  Search Product</button>
            <!-- <input type="submit" name="btnsearch" value="Search Product" class="btn btn-info"/> -->
        </div>
        <hr>
    </form>

<!-- END of Del Method -->


<?php
$key ='';
if(isset($_POST['searchtxt']))
        $key=$_POST['searchtxt'];

    if($key !="")
        $sql = "SELECT * FROM product WHERE user_id = $s_uid && p_name  like '$key%'";
    else
         $sql = "SELECT * FROM product where user_id = $s_uid";
          $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    ?>
        <div class="container">
        <div>
            <div class="">
                <a href="show_details.php?getid=<?php echo $row['p_id']; ?>">
                <img id="p_image_icon" src="<?php echo $row['p_image_path'];?>"></a>
                <div class="white"><?php echo $row['p_name'];?></div>
                <div class="white mtmargin"><?php echo $row['p_date&time'];?></div>
                <a href="show_my_details.php?getid=<?php echo $row['p_id']; ?>">
                <button class="btn btn-success mtmargin">Show Details</button>
                </a>
                <a onclick="return confirm('Are you sure?')" href="?tag=my_products&opr=del&p_id=<?php echo $row['p_id'];?>" title="Delete">
                <button class="btn btn-danger mtmargin pull-right">Delete Product</button></a>
                <a href="upd_product.php?p_id=<?php echo $row['p_id'];?>">
                <button class="btn btn-info mtmargin pull-right rmargin">Update Product</button></a>
                
            </div>
                
                  
               
               <div><?php echo $msg; ?></div>
            </div>
        </div>
    
    <hr>
    <?php
    }


    ?>

    

</body>
</html>