<head>



<title>Product Management System</title>

<script src="Js/jquery.js"></script>
<script src="Js/script.js"></script>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>



<!-- Mobile First Meta Tag -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/script.css">
</head>
	<div class="container top">
		<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="check_login.php">Product Managment System</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <?php $s_image_url ?>
      </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active col-sm-4"><a href="check_login.php">Home</a></li>
        <li class=""><a href="about_us.php">About Us</a></li>
        <li class=""><a href="contact_us.php">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="show_cart.php?opr=shcrt"><span class="fa fa-shopping-cart"></span> Check Out</a></li>
        <li><img id="image_icon" src="<?php echo $s_image_url; ?>"></li>
        <li><a href="user_profile.php"><span class="fa fa-user"></span> <?php echo $s_name; ?></a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <span class="fa fa-product-hunt"></span> Products</a>
          <ul class="dropdown-menu">
            <li><a href="my_products.php"> <span class="fa fa-user"></span> My Products</a></li>
            <li><a href="all_products_non.php"><span class="fa fa-globe"></span> All Products </a></li>
            <li><a href="product_add.php"><span class="fa fa-plus"></span> Ad Products </a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <span class="fa fa-cogs"></span> Change Profile</a>
          <ul class="dropdown-menu">
            <li><a href="change_settings.php"> <span class="fa fa-cogs"></span> User Settings</a></li>
            <li><a href="change_image.php"><span class="fa fa-camera"></span> Profile Image </a></li>
            <li><a href="logout.php"><span class="fa fa-power-off"></span> Log Out</a></li>
          </ul>
        </li>
        
      </ul><br><br>
    </div>
  </nav>
  </div>