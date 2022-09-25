<?php
	include("Config.php");
	$Stock_Taxs = mysql_fetch_assoc(mysql_query("Select * From tax WHERE id='1' "));
	echo $Stock_Taxs['percent'];
?>
