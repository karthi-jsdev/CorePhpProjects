<?php
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "chiramith_ppc_erp";
	
	$dbh = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
	mysql_select_db($mysql_database, $dbh) or die("Could not select database");
?>