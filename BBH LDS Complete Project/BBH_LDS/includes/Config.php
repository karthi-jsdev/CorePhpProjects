<?php
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "bbh_lds";
	$dbh = mysqli_connect ($mysql_hostname, $mysql_user, $mysql_password) or die ('I cannot connect to the database because: ' . mysqli_error());
	mysqli_select_db ($mysql_database, $dbh) or die ('I cannot select the database because: ' . mysqli_error());
?>