<?php
	include("Config.php");
	ini_set("display_errors","0");
	mysql_query("UPDATE city SET `enabled`= '".$_POST['check']."' WHERE id=".str_replace(",", " || id=", $_POST['cityid']));
?>