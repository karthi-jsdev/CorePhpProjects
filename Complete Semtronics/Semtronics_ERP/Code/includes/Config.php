<?php
	// $dbh = mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
	// mysql_select_db ("semtronics_recent", $dbh) or die ('I cannot select the database because: ' . mysql_error());
	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "semtronics_recent";
	$dbh = mysqli_connect ($mysql_host, $mysql_user, $mysql_password) or die ('I cannot connect to the database because: ' . mysqli_error());
	mysqli_select_db ($dbh,$mysql_database) or die ('I cannot select the database because: ' . mysqli_error());
	$_SESSION['connection'] = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_database);

?>