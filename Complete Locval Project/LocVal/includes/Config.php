<?php
	//$dbh = mysql_connect("localhost","locvaluc","0909@Locvalu") or die ('I cannot connect to the database because: ' . mysql_error());
	//mysql_select_db("locvaluc_locationvalue",$dbh) or die ('I cannot select to the database because: '.mysql_error());
	$dbh = mysql_connect("localhost","root","") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("locationvalue",$dbh) or die ('I cannot select to the database because: '.mysql_error());

	$con=mysqli_connect("localhost","locvaluc","0909@Locvalu","locvaluc_locationvalue");
?>