<?php
	//$dbh = mysql_connect("localhost","locvaluc","0909@Locvalu") or die ('I cannot connect to the database because: ' . mysql_error());
	//mysql_select_db("locvaluc_locationvalue",$dbh) or die ('I cannot select to the database because: '.mysql_error());
	// $dbh = mysql_connect("localhost","root","") or die ('I cannot connect to the database because: ' . mysql_error());
	// mysql_select_db("locationvalue",$dbh) or die ('I cannot select to the database because: '.mysql_error());

	// $con=mysqli_connect("localhost","locvaluc","0909@Locvalu","locvaluc_locationvalue");

	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "locationvalue";
	$dbh = mysqli_connect ($mysql_host, $mysql_user, $mysql_password) or die ('I cannot connect to the database because: ' . mysqli_error());
	mysqli_select_db ($dbh,$mysql_database) or die ('I cannot select the database because: ' . mysqli_error());
	$_SESSION['connection'] = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_database);


?>