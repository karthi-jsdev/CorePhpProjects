<?php
	ini_set("display_errors","0");
	include("Config.php");
	mysqli_query($_SESSION['connection'],"DELETE FROM `order` WHERE id=".$_GET['id']);
?>