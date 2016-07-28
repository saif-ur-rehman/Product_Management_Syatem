
<!DOCTYPE html>
<html>
<head>

<?php 
    include("db_connect.php");
    include('check_user.php');

//------------------ Show Previous Data----------



        
        
        
            // $records = $databaseConnection->prepare('SELECT email,password FROM  user WHERE email = :email');
            // $records->bindParam(':email', $email);
            // $records->execute();
            // $results = $records->fetch(PDO::FETCH_ASSOC);
            // $email = $results['email'];
            // $pass = $results['password'];
            // $email = $_SESSION['username'];
            //echo $email;
        
    

//------------------ Update New Data----------

if(isset($_POST['btn_upd'])){


    $upd_email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $encrypt = password_hash($pass , PASSWORD_DEFAULT);

    try {

    
    // sql to insert table data
    $sql = "UPDATE user SET email = '$upd_email' , password = '$encrypt' WHERE email = '$s_email' " ;

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    $_SESSION['email'] = $upd_email;
    echo '<div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your Data is Updated Successfully</div>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    $databaseConnection = null;


}

?>


</head>
<body>





<div class="container">

<h1 class="white">Welcome <?php echo $s_name ?></h1>
<!-- Login Form -->
<form class="well" method="POST" role="form" action = "" >
	<h1>Update Your Data </h1>
	<div class="form-group">
		<label for="email">Enter New Email Address:</label>
		<input type="email" class="form-control" name ="email" required="" placeholder="e.g:abc@xyz.com" value="<?php echo $s_email;?>"/>  
	</div>
    <div class="form-group">
        <label for="pwd">Old Password:</label>
        <input type="password" class="form-control" name="p" required placeholder="********" value="<?php
        echo $_COOKIE['remember_pass']; ?>"/>  
    </div>
	<div class="form-group">
		<label for="pwd">Retype Password:</label>
		<input type="password" class="form-control" name="password" required placeholder="********" value=""/>  
	</div>
  		<button type="submit" name="btn_upd" class="btn btn-default">Update</button>
</form>

  
</div>

</body>
</html>