<?php
	include("Config.php");
	ini_set("display_errors","0");
	mysql_query("UPDATE metro_market SET `enabled`= '".$_POST['check']."' WHERE id=".str_replace(",", " || id=", $_POST['metromarketid']));
?>