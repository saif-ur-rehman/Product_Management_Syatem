<?php

include('db_connect.php');
include('check_user.php');

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
$page=$_GET['page'];
 $gid=$_GET['getid'];
 $sami=1;
 header("Location:show_details.php?page=$page&getid=$gid    ");

}
?>
