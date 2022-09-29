<?php
include("Job_Queries.php");
include("Config.php");
if($_GET['orderid'])
{
	$FetchCustomerId = mysqli_fetch_array(Select_Order_ById($_GET['orderid']));
	$customerName = mysqli_fetch_array(Select_CustomerName_ById($FetchCustomerId['customer_id']));
	echo '<font size="2em"><strong>'.$customerName['name'].'</strong></font>';
}
?>