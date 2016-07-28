<?php 
include('check_user.php');
include ('db_connect.php');

if(isset($_POST['btn_rev'])){


$curr_pid = $_GET['id'];
$review = $_POST['review'];



try {

	
    // sql to insert table data
    $sql = "INSERT INTO review (r_body,user_id,p_id)
    VALUES('$review',$s_uid','$curr_pid')";

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 $databaseConnection = null;

}
?>