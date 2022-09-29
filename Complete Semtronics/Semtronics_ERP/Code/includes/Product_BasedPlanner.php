<?php
include('Config.php');
if($_GET['drivertype'] && $_GET['structure'] && $_GET['ic'] && $_GET['wattagerange'] && $_GET['currentrange'])
{
	//echo "SELECT * FROM products WHERE productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].
	$_GET['wattagerange'].$_GET['currentrange']."-%' || productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].$_GET['wattagerange'].
	$_GET['currentrange']."'";
	$productcode = mysqli_query($_SESSION['connection'],"SELECT * FROM products WHERE productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].
	$_GET['wattagerange'].$_GET['currentrange']."-%' || productcode LIKE '%".$_GET['drivertype'].$_GET['structure'].$_GET['ic'].$_GET['wattagerange'].
	$_GET['currentrange']."'");
	echo '<option value=select>Select</option>';
	while($productcods = mysqli_fetch_assoc($productcode))
	{
		echo '<option value='.$productcods['id'].'>'.$productcods['productcode'].'</option>';
	}
}
?>