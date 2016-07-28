<html>
<head>
<?php
include ('header.php');
include ('db_connect1.php');
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
        $sql = "SELECT * FROM product WHERE p_name  like '$key%'";
    else
        $sql = "SELECT * FROM product";

$result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    ?>
    <div class="container">
        <div>
            <div class="left">
                <a href="show_details.php?getid=<?php echo $row['p_id']; ?>"><img id="p_image_icon" src="<?php echo $row['p_image_path'];?>"></a>
                <div class="white"><?php echo $row['p_name'];?></div>
                <div class="white mtmargin"><?php echo $row['p_date&time'];?></div>
                <a href="details.php?getid=<?php echo $row['p_id']; ?>">
                <button class="btn btn-success mtmargin">Show Details</button>
                </a>
            </div>
        </div>
    </div>
    <hr>

<?php
}
?>
    

</html>