<?php
include('Config.php');
$i=1;
date_default_timezone_set('Asia/Kolkata');
if($_GET['Id'])
{
	mysql_query("Update stockinventory Set inspection='".$_GET['Inspection']."',inspectionquantity='".$_GET['Quantity']."',status='".$_GET['Status']."',inspectedby='".$_GET['SessionId']."',datetime='".date("Y-m-d h:i:s")."' where id='".$_GET['Id']."'");
}
$ArrayItems = array("Select","Accept","Reject","Cancel","Consider later");
$j=0;
foreach($ArrayItems as $ArrayItem)
{
	if($j==$_GET['Inspection'])
		echo $ArrayItem;
	$j++;
}
echo '#'.$_GET['Status']."#".$_GET['Quantity'];
?>