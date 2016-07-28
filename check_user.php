<?php
	include ('session.php');
	if ($s_u_role == "Admin") {
      include('sign_header.php');
   }
   else if ($s_u_role == "Supper User") {
      include('super_admin_header.php');
   }
   else if ($s_u_role == "Customer") {
      include('customer_header.php');  
   }
?>