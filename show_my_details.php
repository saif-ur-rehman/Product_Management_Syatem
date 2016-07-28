<?php
include('check_user.php');
include ('db_connect1.php');
include ('db_connect.php');
?>


<?php
// ADD to Cart functionality

    $opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];

    if(isset($_GET['getid']))
    $pac_id=$_GET['getid'];

    if(isset($_GET['getreviewid']))
    $r_id=$_GET['getreviewid'];
    
    if(isset($_GET['id']))
    $ur_id=$_GET['id'];

    
    if($opr=="redl"){
            $del_sql = "DELETE FROM review WHERE r_id='$r_id'";
            $result = $conn->query($del_sql);
            if($del_sql) {
        {

?>

            <div>
                <div class='alert alert-success col-md-4 col-md-offset-8'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;
                </button>
                <strong>Sucess!</strong> Review Deleted"
                </div>
                </div>
  <?php

        }
    }
   else
      $msg="Could not Delete :".mysql_error(); 

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

    $sql = "SELECT * FROM review where p_id = $curr_pid ";
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
                    <div class="pull-right">
                    
                    <a href="?cmtid=<?php echo $row['r_id'];?>&getid=<?php echo $curr_pid;?> class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"">
                    <span class="fa fa-pencil-square-o"></span></a>
                                                  <!-- Trigger the modal with a button -->


                    <!-- Delete riview -->
                    <a onclick="return confirm('Are you sure to delete this Review?')" href="show_my_details.php?opr=redl&getid=<?php echo $curr_pid; ?>&getreviewid=<?php echo $row['r_id']; ?>"><span class="fa fa-trash-o"></span></a>
                    </div>
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







    
<?php
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

}
?>


                              <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                      <?php  
                                      $cmt_id=$_GET['cmtid'];


                                            $sql_r = "SELECT r_body FROM review where r_id = $cmt_id ";
                                            $result_r = $conn->query($sql_r);
                                            $row_r = $result_r->fetch_assoc();
                                      ?>
                                      <form>
                                          <input type="text" name="r_body" value="<?php echo $row_r['r_body'];?>"></input>
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>

