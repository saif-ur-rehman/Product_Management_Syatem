<!DOCTYPE html>
<html>
<head>

<?php 
include 'header.php';
include ('db_connect.php');

if(isset($_POST['btn_signup'])){

$errMsg=null;
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$pass = trim($_POST['password']);
$u_cat = trim($_POST['u_cat']);
$encrypt = password_hash($pass , PASSWORD_DEFAULT);

    if(!isset($name) && !preg_match("/^[a-zA-Z ]*$/",$name))
            $errMsg .= 'You must enter a valid only [a-z/A-Z ] in name<br>';
    if(!isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
            $errMsg .= 'You must enter your email<br>';
        if(!isset($pass))
            $errMsg .= 'You must enter your Password<br>';
        if(!isset($u_cat))
            $errMsg .= 'You must select a user type<br>';




	
    // sql to insert table data

    if(!isset($errMsg)){
    try {
    $sql = "INSERT INTO user (name,email,password,user_role,image_path)
    VALUES('$name','$email','$encrypt','$u_cat','uploads/first.jpg')";

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
echo '<div class="col-xs-3 pull-right" align="center"><div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> You are Successfully Registered</div></div>';
 $databaseConnection = null;
}
}

?>

</head>
<body>


<div class="container">

        <?php
                
                if(isset($errMsg)){
                    echo '<div class="alert alert-danger">'.$errMsg.'</div>';
                }
            ?>
<!-- SignUp Form -->
<form class="well" method="POST" role="form" action="">
	<h1>SignUp Information</h1>
	    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name ="name" required="" placeholder="John Carter">  
    </div>
	<div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" class="form-control" name ="email" required="" placeholder="e.g:abc@xyz.com"> 
	</div>
        <div class="form-group">
        <label for="email">User Type:</label>
        <select class="form-control" name ="u_cat" required="" placeholder="Select a User Type">
        <option selected="selected"> Customer </option>
        <option> Supper User </option>
        <option> Admin </option>
        <option> Customer </option>
        </select>  
    </div>
	<div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" name="password" required placeholder="********">  
	</div>
  		<button type="submit" name="btn_signup" class="btn btn-success">Register</button>
</form>
  
</div>


</body>
</html>