<?php
   include('db_connect.php');
   session_start();
   
   $user_check = $_SESSION['email'];
   
   $ses_sql = mysql_query($databaseConnection,"select email from user where email = '$user_check' ");
   
   $row = mysql_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   
   if(!isset($_SESSION['email'])){
      header("location:login.php");
   }
?>