<?php

    include('check_user.php');
    include('loginData.php');
    var_dump($_SESSION);


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["u_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["btn_uimage"])) {
    $check = getimagesize($_FILES["u_image"]["tmp_name"]);
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
if ($_FILES["u_image"]["size"] > 5000000) {
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
    if (move_uploaded_file($_FILES["u_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["u_image"]["name"]). " has been uploaded.";
        echo $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
        try {


    // sql to insert table data
    $sql = "UPDATE user SET image_path = '$target_file' WHERE email = '$s_email'" ;
    $s_image_url = $target_file;
    // use exec() because no results are returned
    $databaseConnection->exec($sql);
    $results['image_path'] = $target_file;
    $_SESSION['image_url'] = $results['image_path'];
    // $_SESSION['username'] = $upd_email;
    // header('location:welcome.php');

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    $databaseConnection = null;
}
?>