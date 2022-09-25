<?php
	include("Config.php");
	date_default_timezone_set('Asia/Kolkata');
	include("Create_Order_Queries.php");
	$_POST['number'] = $_GET['number'];
	$_POST['customer_id'] = $_GET['customer_id'];
	$_POST['product_id'] = $_GET['product_id'];
	$_POST['totalorderquantity'] = $_GET['totalorderquantity'];
	$_POST['plannedquantity'] = $_GET['plannedquantity'];
	$_POST['machine_id'] = $_GET['machine_id'];
	$_POST['productionhours'] = $_GET['productionhours'];
	$_POST['settingdays'] = $_GET['settingdays'];
	$_POST['tentative_date'] = $_GET['tentative_date'];
	$_POST['tentative_enddate'] = $_GET['tentative_enddate'];
	if($_GET['Action'] == "Insert" && $_POST['number']  && $_POST['product_id'] && $_POST['customer_id'] && $_POST['totalorderquantity'] && $_POST['plannedquantity'] && $_POST['machine_id'] && $_POST['productionhours'] && $_POST['settingdays'] && $_POST['tentative_date'] && $_POST['tentative_enddate'])
	{
		Insert_Joborder();
		echo "Job order added successfully";
	}
	else
		echo "Please input properly";
?>