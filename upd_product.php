
<!DOCTYPE html>
<html>
<head>

<?php 
    include("db_connect.php");
    include("db_connect1.php");
    include('check_user.php');

    

        $p_id = $_GET['p_id'];







//------------------ Show Previous Data----------
        


        
        
        
            $records = "SELECT * FROM  product WHERE p_id = $p_id";
            $result = $conn->query($records);
            $row = mysqli_fetch_array($result);



            $p_name = $row['p_name'];
            $p_disc = $row['p_discription'];
            $p_price = $row['p_price'];
            $p_cat = $row['p_category'];
            $p_image_path = $row['p_image_path'];
            
        

//------------------ Update New Data----------

if(isset($_POST['btn_pupd'])){


if (!isset($_POST['p_image'])) {
    $_POST['p_image'] = $s_image_url;
}

//....................Product Image Upload......................
if (!isset($_POST['btn_pupd'])) {




$check = getimagesize($_FILES["p_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["p_image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["p_image"]["name"]). " has been uploaded.";
        echo $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
//....................End Product Image Upload......................




    $pu_name = trim($_POST['p_name']);
    $pu_disc = trim($_POST['p_disc']);
    $pu_cat = trim($_POST['p_cat']);
    $pu_price = trim($_POST['p_price']);
    if (isset($target_file)) {
        $pu_image_path = $target_file;
    }
    else {
    $pu_image_path = $s_image_url;
    }
    try {

    
    // sql to insert table data
    $sql = "UPDATE product SET p_name = '$pu_name' , p_description = '$pu_disc' , p_price = '$pu_price' , p_category = '$pu_cat' , p_image_path = '$pu_image_path'  WHERE p_id = '$p_id' " ;

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    $_SESSION['email'] = $upd_email;
    header('location:my_products.php');
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

<form class="well" method="POST" role="form" action="" enctype="multipart/form-data">
    <h1>Product Information</h1>
    <div class="form-group">
        <label for="p_name">Product Name:</label>
        <input type="text" class="form-control" value="<?php echo $p_name; ?>" name ="p_name" required="" placeholder="Your Product Name Here">  
    </div>
    <div class="form-group">
        <label for="p_cat">Product Category:</label>
        <select class="form-control" value="<?php echo $p_cat; ?>" name ="p_cat" required="" placeholder="Select any one">
        <option> Fashon </option>
        <option selected="selected"> <?php echo $p_cat; ?> </option>
        <option> Art & Design </option>
        <option> Home & Garden </option>
        <option> Sports Goods </option>
        <option> Vehicles </option>
        </select>  
    </div>
    <div class="form-group">
        <label for="p_price">Product Price:</label>
        <input type="number" min="1" class="form-control" value="<?php echo $p_price; ?>" name ="p_price" required="" placeholder="Expected Product Price">  
    </div>
    <div class="form-group">
        <label for="p_disc">Product Discription:</label>
        <textarea class="form-control" name ="p_disc" rows="7" required="" placeholder="Tell Buyers About Your Product"><?php echo $p_disc; ?></textarea>  
    </div>
    <div class="form-group">
        <label for="image">Select an Image</label>
        <input type="file" value="<?php echo $p_image_path; ?>" name="p_image" accept="image/jpeg"/>
    </div>
    <div class="form-group col-md-offset-1 top-buffer">
        <button type="reset" name="" class="btn btn-danger col-md-offset-1">Reset</button>
        <button type="submit" name="btn_pupd" class="btn btn-info col-md-offset-8">Add Product</button>
    </div>
        
</form>

  
</div>

</body>
</html>