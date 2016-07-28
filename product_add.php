<!DOCTYPE html>
<html>
<head>

<?php  
include('check_user.php');
?>
</head>
<body>


<div class="container">

<?php
                
                if(isset($errMsg)){
                    echo '<div class="alert alert-danger">'.$errMsg.'</div>';
                }
            ?>

<!-- Ad Product Form -->
<form class="well" method="POST" role="form" action="product_insertion.php" enctype="multipart/form-data">
	<h1>Product Information</h1>
	<div class="form-group">
        <label for="p_name">Product Name:</label>
        <input type="text" class="form-control" name ="p_name" required="" placeholder="Your Product Name Here">  
    </div>
    <div class="form-group">
        <label for="email">Product Category:</label>
        <select class="form-control" name ="p_cat" required="" placeholder="Select any one">
        <option> Fashon </option>
        <option selected="selected"> Electronics </option>
        <option> Art & Design </option>
        <option> Home & Garden </option>
        <option> Sports Goods </option>
        <option> Vehicles </option>
        </select>  
    </div>
    <div class="form-group">
        <label for="p_price">Product Price:</label>
        <input type="number" min="1" class="form-control" name ="p_price" required="" placeholder="Expected Product Price">  
    </div>
	<div class="form-group">
		<label for="p_dosc">Product Discription:</label>
		<textarea class="form-control" name ="p_disc" rows="7" required="" placeholder="Tell Buyers About Your Product"></textarea>  
	</div>
	<div class="form-group">
        <label for="image">Select an Image</label>
        <input type="file" name="p_image" accept="image/jpeg"/>
    </div>
    <div class="form-group col-md-offset-1 top-buffer">
        <button type="reset" name="" class="btn btn-danger col-md-offset-1">Reset</button>
        <button type="submit" name="btn_addp" class="btn btn-info col-md-offset-8">Add Product</button>
    </div>
  		
</form>
  
</div>


</body>
</html>