<?php
	ini_set("display_errors","0");
	include("Config.php");
	mysql_query("DELETE FROM `order` WHERE id=".$_GET['id']);
?>