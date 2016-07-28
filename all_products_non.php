<html>
<head>
<?php  
include('check_user.php');
include ('db_connect.php');

// --------------Simple Pagination Concept---------------------


$start=0;
$limit=5;

if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
else{
$id=1;
}


//fetch all the data from database.

// $resultct = mysql_query("SELECT * FROM product", $conn);
// $rowsct = mysql_num_rows($resultct);

$stmt = $databaseConnection->prepare("SELECT * FROM product");
$stmt->execute();
$count = $stmt->rowCount(); 


$total=ceil($count/$limit);

?>


<?php


   $msg="";
   $opr="";
   if(isset($_GET['opr']))
   $opr=$_GET['opr'];
   
if(isset($_GET['p_id']))
   $id=$_GET['p_id'];
   
   if($opr=="del")
{

    $del_sql = $databaseConnection->prepare("DELETE FROM product WHERE p_id=$id");
    $del_sql->execute();
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
        $sql = $databaseConnection->prepare("SELECT * FROM product");

    else
        $sql = $databaseConnection->prepare("SELECT * from product ORDER BY `product`.`p_date&time` DESC LIMIT $start , $limit");

      $sql->execute();
      $row = $sql->fetchAll();
      $data = $row;

    foreach($data as $row){
    ?>
    <div class="container">
        <div>
            <div class="">
                <a href="show_details.php?getid=<?php echo $row['p_id']; ?>"><img id="p_image_icon" src="<?php echo $row['p_image_path'];?>"></a>
                <div class="white"><?php echo $row['p_name'];?></div>
                <div class="white mtmargin"><?php echo $row['p_date&time'];?></div>
                <a href="show_details.php?getid=<?php echo $row['p_id']; ?>">
                <button class="btn btn-success mtmargin">Show Details</button></a>

                <?php if ($s_u_role == "Supper User") {
                
                ?>
                <a onclick="return confirm('Are you sure?')" href="?tag=my_products&opr=del&p_id=<?php echo $row['p_id'];?>" title="Delete">
                <button class="btn btn-danger mtmargin pull-right">Delete Product</button></a>
                <a href="upd_product.php?p_id=<?php echo $row['p_id'];?>">
                <button class="btn btn-info mtmargin pull-right rmargin">Update Product</button></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr>

<?php
}
?>

<ul class='page'>
<?php
if($id>1)
{
//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
echo "<li><a href='?id=".($id-1)."' class='button'>PREVIOUS</a></li>";
}
if($id!=$total)
{
//Go to Next page to show next 10 items.
echo "<li><a href='?id=".($id+1)."' class='button'>NEXT</a></li>";
}

//show given the page link with page number. When click on these numbers go to particular page. 
for($i=1;$i<=$total;$i++)
{
if($i==$id) { echo "".$i.""; }

else { echo "<a class='page' href='?id=".$i."'>".$i."</a>"; }
}
?>

</ul>
</head>
</html>