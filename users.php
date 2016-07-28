<html>
<head>
<?php
include('check_user.php');
include ('db_connect1.php');
include ('db_connect.php');
?>
    <form role="form" data-toggle="validator" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="col-md-9 col-md-offset-1     col-xs-9 col-sm-10">
            <input type="text" class="form-control" name="searchtxt" Placeholder="Enter product name for search" autocomplete="off"/></div>
            <button type="submit" name="btnsearch" class="btn btn-info"><span class="fa fa-search"></span>  Search Product</button>
        </div>
        <hr>
    </form>
<?php
$key = '';
if(isset($_POST['searchtxt']))
        $key=$_POST['searchtxt'];

    if($key !="")
        $sql = "SELECT * FROM user WHERE c_name  like '$key%'";
    else
        $sql = "SELECT * FROM user ORDER BY `user`.`u_date&time` DESC";

$result = $conn->query($sql);
   
    ?>
    <div class="container">
        <div>
            <div class=" tbl left">
            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                    <tr>  
                      <th>Produch Image</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                    
                    <?php 
                     while($row = $result->fetch_assoc()){
                     ?>
                     <tbody>
                    <tr>
                        <td class="tb_td"> <img id="img_tbl" src="<?php echo $row['image_path']; ?>"> </td>
                        <td class="tb_td"> <?php echo $row['name']; ?> </td>
                        <td class="tb_td"> <?php echo $row['email']; ?> </td>
                        <td class="tb_td"> <?php echo $row['user_role']; ?> </td>
                        <td class="tb_td"> <?php echo $row['published']; ?> </td>
                        <td class="tb_td"> <?php echo $row['u_date&time']; ?> </td>
                        <td class="tb_td"><a href="?tag=users&opr=pupd&uid=<?php echo $row['user_id']; ?>"> <button class="btn btn-warning" type="submit" name="btn_pub">Activate User</button> </a> </td>
                        <td class="tb_td"><a onclick="return confirm('Are you sure to delete this user?')" href="?tag=users&opr=pudl&uid=<?php echo $row['user_id']; ?>"> <button class="btn btn-danger" type="submit" name="btn_pub">Delete User</button> </a> </td>
                    </tr>

                    </tbody>
                    <?php } ?>
            </table>
            </div>
        </div>
    </div>

<?php


// Activate Users


    $opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];

    if(isset($_GET['uid']))
    $pub_id=$_GET['uid'];



    if($opr=="pupd"){
    try {

    
    // sql to update table data if user is deactive
    $upd_sql = "UPDATE user SET published = 1 where user_id = $pub_id" ;

    // use exec() because no results are returned
    $databaseConnection->exec($upd_sql);
    }
catch(PDOException $e)
    {
    echo $upd_sql . "<br>" . $e->getMessage();
    }
}
    if($opr=="pudl"){

    $del_sql = "DELETE FROM user WHERE user_id=$pub_id";
    $delr_sql = "DELETE FROM review WHERE user_id=$pub_id";
    $result = $conn->query($del_sql);
    $result = $conn->query($delr_sql);
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
    

</html>