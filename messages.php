<html>
<head>
<?php
include('check_user.php');
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
        $sql = "SELECT * FROM contact_us WHERE c_name  like '$key%'";
    else
        $sql = "SELECT * FROM contact_us";

$result = $conn->query($sql);
    
    ?>
    <div class="container">
        <div>
            <div class=" tbl left">
            <table class="table table-hover table-bordered">
                  <thead class="thead-inverse">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Dated</th>
                    </tr>
                  </thead>
                  <?php while($row = $result->fetch_assoc()){
                    ?>
                    <tbody>
                    <tr>
                        <th class=""> <?php echo $row['c_id']; ?> </th>
                        <td class=""> <?php echo $row['c_name']; ?> </td>
                        <td class=""> <?php echo $row['c_email']; ?> </td>
                        <td class=""> <?php echo $row['c_subject']; ?> </td>
                        <td class=""> <?php echo $row['c_body']; ?> </td>
                        <td class=""> <?php echo $row['c_date&time']; ?> </td>
                    </tr>
                    </tbody>
                    <?php
}

?>
            </table>
            </div>
        </div>
    </div>


    

</html>