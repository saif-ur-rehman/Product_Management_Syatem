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
        $sql = "SELECT * FROM `order` WHERE o_id  like '$key%'";
    else
        $sql = "SELECT * FROM `order` ORDER BY `order`.`o_date&time` DESC";

        $result = $conn->query($sql);
   
    ?>
    <div class="container">
        <div>
            <div class=" tbl left">
            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                    <tr>  
                      <th>Order ID</th>
                      <th>Order Price</th>
                      <th>Order Discount</th>
                      <th>Order Payment</th>
                      <th>Order Date and Time</th>
                      <th>Order Deletion</th>
                    </tr>
                  </thead>
                    
                    <?php 
                     while($row = $result->fetch_assoc()){
                     ?>
                     <tbody>
                    <tr>
                        <td class="tb_td"> <?php echo $row['o_id']; ?> </td>
                        <td class="tb_td"> <?php echo $row['o_price']; ?> </td>
                        <td class="tb_td"> <?php echo $row['o_disc']; ?> </td>
                        <td class="tb_td"> <?php echo $row['o_amount_paid']; ?> </td>
                        <td class="tb_td"> <?php echo $row['o_date&time']; ?> </td>
                        <td class="tb_td"><a onclick="return confirm('Are you sure to delete this order?')" href="?tag=orders&opr=ordl&oid=<?php echo $row['o_id']; ?>"> <button class="btn btn-danger" type="submit">Delete Order</button> </a> </td>
                    </tr>

                    </tbody>
                    <?php } ?>
            </table>
            </div>
        </div>
    </div>

<?php




    $opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];

    if(isset($_GET['oid']))
    $order_id=$_GET['oid'];




    if($opr=="ordl"){

    $del_sql = "DELETE FROM `order` WHERE o_id=$order_id";
    $delr_sql = "DELETE FROM `order_products` WHERE o_id=$order_id";
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