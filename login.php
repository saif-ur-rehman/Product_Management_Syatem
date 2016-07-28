
<!DOCTYPE html>
<html>
<head>

<?php
include("db_connect.php");
include("check_login.php");
    include ('header.php');
    
if (!empty($_SESSION['cart'])) {
    echo '<div class="alert alert-danger"> Please Login to Check Out </div>';
 } 
    


// Remember me Function


//------------------Insert Data----------

if(isset($_POST['btn_insert'])){
        $errMsg=null;
        //email and password sent from Form
        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);
        
        if(!isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
            $errMsg .= 'You must enter your email<br>';
        
        if(!isset($pass))
            $errMsg .= 'You must enter your Password<br>';
        
        
        if(!isset($errMsg)){
            $records = $databaseConnection->prepare('SELECT * FROM  user WHERE email = :email');
            $records->bindParam(':email', $email);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            // echo "out side if";
            if(count($results) > 0 && password_verify($pass, $results['password']) && $results['published'] == 1){
                session_start();
                $_SESSION['uid'] = $results['user_id'];
                $_SESSION['name'] = $results['name'];
                $_SESSION['email'] = $results['email'];
                $_SESSION['u_role'] = $results['user_role'];
                $_SESSION['image_url'] = $results['image_path'];
                $_SESSION['published'] = $results['published'];
                $_SESSION['loggedin'] = true;
                $year = time() + 31536000;
                setcookie('remember_email', $_POST['email'], $year);
                setcookie('remember_pass', $_POST['password'], $year);
                header('location:welcome.php');
            }
            else if ($results['published'] == 0) {
                $errMsg .= 'You are not an Active user Please wait for acknowledgment<br>';
            }
            else{
                $errMsg .= 'E-mail and Password are not found Or Missmatch<br>';
            }
        }
    }

?>

</head>
<body>




<div class="container">

			<?php
                
                var_dump(isset($errMsg));
				if(isset($errMsg)){
					echo '<div class="alert alert-danger">'.$errMsg.'</div>';
				}
			?>

<!-- Login Form -->
<form class="well" method="POST" role="form" action = "" >
	<h1>Please Login </h1>
	<div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" class="form-control" name ="email" required="" value="<?php
        if(isset($_COOKIE['remember_email'])) echo $_COOKIE['remember_email']; ?>" placeholder="e.g:abc@xyz.com">  
	</div>
	<div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" name="password" value="<?php
        if(isset($_COOKIE['remember_pass'])) echo  $_COOKIE['remember_pass']; ?>" required placeholder="********">  
	</div>
	<div class="checkbox">
    	<label><input type="checkbox" name="remember" value="1"> Remember Me </label>
 	</div>
  		<button type="submit" name="btn_insert" class="btn btn-info pull-left">Login</button>
        <span class="not_user">Not a Registered User</span>
        
        <a href="signup.php"><button type="button" class="btn btn-warning pull-right">Sign Up</button></a>
</form>

  
</div>

</body>
</html>