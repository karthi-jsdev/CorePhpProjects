<?php
	require("Config.php");
	ini_set("display_errors","0");
	mysql_query("UPDATE state SET `enabled`= '".$_POST['check']."' WHERE id=".str_replace(",", " || id=", $_POST['stateid']));
?>