<?php
include('Config.php');
if($_GET['drivertype'] && $_GET['structure'] && $_GET['ic'] && $_GET['wattagerange'] && $_GET['currentrange'])
{
	//echo "SELECT * FROM products WHERE productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].
	$_GET['wattagerange'].$_GET['currentrange']."-%' || productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].$_GET['wattagerange'].
	$_GET['currentrange']."'";
	$productcode = mysql_query("SELECT * FROM products WHERE productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].
	$_GET['wattagerange'].$_GET['currentrange']."-%' || productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].$_GET['wattagerange'].
	$_GET['currentrange']."'");
	echo '<option value=select>Select</option>';
	while($productcods = mysql_Fetch_assoc($productcode))
	{
		echo '<option value='.$productcods['id'].'>'.$productcods['productcode'].'</option>';
	}
}
?>