<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	$sql = "SELECT * FROM employee WHERE empid='".$_GET['q']."'";
	$data = mysql_query($sql);
	$results = "";
	echo "Select#Select#";
		while($row = mysql_fetch_assoc($data))
		{
			$results .= $row['name']."#". $row['name']."#";
		}
		echo substr($results, 0, -1);
?>