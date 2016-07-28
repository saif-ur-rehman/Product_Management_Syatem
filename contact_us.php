<html>
<head>
<?php
   include('db_connect.php');
   session_start();
   $errMsg = "";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include('check_user.php');
    }
    if (!isset($_SESSION['loggedin'])) {
    include('header.php');     
    }

    if (!isset($_POST['btn_msg'])) {
        
}

   if(isset($_POST['btn_msg'])){

    function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$c_name = trim($_POST['c_name']);
$c_email = trim($_POST['c_email']);
$c_msg = trim($_POST['c_msg']);
$c_sub = trim($_POST['c_sub']);

    // if(empty($c_name))
    //         $errMsg .= 'You must enter a name<br>';
    // if(empty($c_email))
    //         $errMsg .= 'You must enter a email<br>';
    //     if(empty($c_msg) && !preg_match("/^[a-zA-Z ]*$/",$c_msg))
    //         $errMsg .= 'You must enter your Password<br>';
    //     if(empty($c_sub))
    //         $errMsg .= 'You must select a user type<br>';

                  if (empty($_POST["c_sub"])) {
    $errMsg .= "Please Choose a Subject<br>";
  }
          if (empty($_POST["c_msg"])) {
    $errMsg .= "Message is required<br>";
  }
          if (empty($_POST["c_name"])) {
    $errMsg .= "Name is required<br>";
  } else {
    $name = test_input($_POST["c_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $errMsg .= "Only letters and white space allowed Pattern like [a-zA-Z ]<br>"; 
    }
  }
  
  if (empty($_POST["c_email"])) {
    $errMsg .= "Email is required<br>";
  } else {
    $email = test_input($_POST["c_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errMsg .= "Invalid email format<br>"; 
    }
  }


if(!isset($errMsg)){


try {

    
    // sql to insert table data
    $sql = "INSERT INTO contact_us (c_name,c_email,c_subject,c_body)
    VALUES('$c_name','$c_email','$c_sub','$c_msg')";
    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 $databaseConnection = null;
}
}

?>

<div class="container-fluid">
    <?php
                
                if(!empty($errMsg)){
                    // var_dump($errMsg);

                    echo '<div class="alert alert-danger">'.$errMsg.'</div>';
                }
            ?>
<div class=" jumbotron jumbotron-blue">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Contact us <small>Feel free to contact us</small></h1>
            </div>
        </div>
    </div>
</div>
</div>
<div class="well well-sm">
                <form method="POST" role="form" action="">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="c_name">
                                Name</label>
                            <input type="text" class="form-control" name="c_name" placeholder="Enter name"/>
                        </div>
                        <div class="form-group">
                            <label for="c_email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" name="c_email" placeholder="Enter email"/></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Subject</label>
                            <select id="subject" name="c_sub" class="form-control">
                                <option value="na" selected="">Choose One:</option>
                                <option value="service">General Customer Complaints</option>
                                <option value="suggestions">Suggestions</option>
                                <option value="product">Product Support</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="c_msg" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="btn_msg" class="btn btn-primary pull-right">
                            Send Message</button>
                    </div>
                    </div>
                </form>
            </div>

</head>
</html>