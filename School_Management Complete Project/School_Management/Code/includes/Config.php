<?php
	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "school_management";
	$dbh = mysqli_connect ($mysql_host, $mysql_user, $mysql_password) or die ('I cannot connect to the database because: ' . mysqli_error());
	mysqli_select_db ($dbh,$mysql_database) or die ('I cannot select the database because: ' . mysqli_error());
	$_SESSION['connection'] = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_database);
?>