<?php 
include ('db_connect.php');
echo '<div class="alert alert-success fade in tmargin"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your Product is Added Successfully</div>';
include ('product_add.php');





if(isset($_POST['btn_addp'])){
    $errMsg = '';

$p_name = trim($_POST['p_name']);
$p_disc = trim($_POST['p_disc']);
$p_cat = trim($_POST['p_cat']);
$p_price = trim($_POST['p_price']);
// image upload variables
$target_dir = "Products Images/";
$target_file = $target_dir . basename($_FILES["p_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



        if($p_name == '')
            $errMsg .= 'You must enter your email<br>';
        
        if($p_disc == '')
            $errMsg .= 'You must enter your Password<br>';
        if($p_cat == '')
            $errMsg .= 'You must enter your email<br>';
        
        if($p_price == '')
            $errMsg .= 'You must enter your Password<br>';


//....................Product Image Upload......................
        if ($errMsg == '') {

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

//....................End Product Image Upload......................

try {
	$p_id = (int) $s_uid;
    // sql to insert table data
    $sql = "INSERT INTO product (user_id,p_name,p_discription,p_price,p_category,p_image_path)
    VALUES('$p_id','$p_name','$p_disc','$p_price','$p_cat','$target_file')";

    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    $_SESSION['p_image_path'] = $target_file;
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$databaseConnection = null;







}
}
?>