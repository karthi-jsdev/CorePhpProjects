<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include("Config.php");
	mysqli_query($_SESSION['connection'],"UPDATE userhistory SET logouttime='".date("Y-m-d H:i:s")."' WHERE userid='".$_SESSION['id']."' && logintime='".$_SESSION['logindatetime']."'");
?>
