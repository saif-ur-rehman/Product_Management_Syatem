<?php  
    $opr="";
    if(isset($_GET['opr']))
    $opr=$_GET['opr'];
     if($opr=="chklg"){
            header('location:login.php');
        }
?>