<?php
   session_start();
   if(empty($_SESSION['adminuser']))
   {
	header("Location: login.php");
   }
?>
