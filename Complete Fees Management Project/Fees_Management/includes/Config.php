<?php
	$Mysql_host = "localhost";
	$Mysql_User = "root";
	$Mysql_Password = "";
	$Mysql_database = "fees_management";
	$dbh = mysql_connect($Mysql_host,$Mysql_User,$Mysql_Password) or die('I cannot connect to the database because:' .mysql_error());
	mysql_select_db($Mysql_database, $dbh) or die('I cannot connect to the database because:' .mysql_error());
?>