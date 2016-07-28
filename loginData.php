<?php 
    include("db_connect.php");
    // include("sessions.php");
//------------------Insert Data----------

if(isset($_POST['btn_insert'])){
        $errMsg = '';
        //email and password sent from Form
        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);
        
        if($email == '')
            $errMsg .= 'You must enter your email<br>';
        
        if($pass == '')
            $errMsg .= 'You must enter your Password<br>';
        
        
        if($errMsg == ''){
            $records = $databaseConnection->prepare('SELECT * FROM  user WHERE email = :email');
            $records->bindParam(':email', $email);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            // echo "out side if";
            if(count($results) > 0 && password_verify($pass, $results['password'])){
                session_start();
                $results['image_path'] = "uploads/first.jpg";
                $_SESSION['uid'] = $results['user_id'];
                $_SESSION['name'] = $results['name'];
                $_SESSION['email'] = $results['email'];
                $_SESSION['image_url'] = $results['image_path'];
                header('location:welcome.php');
                exit;
            }else{
                $errMsg .= 'E-mail and Password are not found OR Missmatch<br>';
            }
        }
    }

?>