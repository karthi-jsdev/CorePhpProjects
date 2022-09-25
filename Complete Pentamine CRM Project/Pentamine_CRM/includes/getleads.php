<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	$sql = "SELECT * FROM lead WHERE cname='".$_GET['q']."'";
	$data = mysql_query($sql);
	$results = "";
	echo "Select#Select#";
	while($row = mysql_fetch_assoc($data))
	{
		$ExplodeDescription = explode(' ',$row['ldesc']);
		$results .= $ExplodeDescription[0].' '.$ExplodeDescription[1].' '.$ExplodeDescription[2].' '.$ExplodeDescription[3].'-'.$row['ptclid']."#". $row['ptclid']."#";
	}
	echo substr($results, 0, -1);
?>