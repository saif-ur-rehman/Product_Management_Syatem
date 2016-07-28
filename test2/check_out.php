<html>
<head>
<?php  
include('check_user.php');
include ('db_connect1.php');
?>
<div class="container">
<!-- Mailing Address Form -->
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
        <button type="submit" name="btn_signup" class="btn btn-default">Register</button>
</form>
  
</div>






    

</html>