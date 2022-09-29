<?php
	ini_set("display_errors","0");
	include("Dashboard_Queries.php");
	include("Config.php");
	mysqli_query($_SESSION['connection'],"DELETE FROM job WHERE id=".str_replace(",", " || id=", $_POST['jobid']));
?>