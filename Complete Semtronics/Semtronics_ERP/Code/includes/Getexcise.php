<?php
	include("Config.php");
	$Stock_Taxs = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"Select * From tax WHERE id='1' "));
	echo $Stock_Taxs['percent'];
?>
