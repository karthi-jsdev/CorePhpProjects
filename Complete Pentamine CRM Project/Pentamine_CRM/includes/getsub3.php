<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	if($_GET['ptype'])
	{
		$product = mysql_query("SELECT * FROM producttype WHERE type='".$_GET['ptype']."'");
		$product_id = mysql_fetch_assoc($product);
		$_GET['q'] = $product_id['slno'];
	} 
	$sql = "SELECT * FROM productsubtype WHERE type_id='".$_GET['q']."'";
	$data = mysql_query($sql);
	$results = "";
	echo "All#all#";
	if($_GET['q'] != 'other' && $_GET['ptype'] != 'other')
	{
		while($row = mysql_fetch_assoc($data))
		{
			$results .= $row['type']."#". $row['id']."#";
		}
		echo substr($results, 0, -1);
	}
	else
	{
		$results .= "other#other#";
		echo substr($results, 0, -1);
	}
?>