<?php
include('Config.php');
require("Reports_Queries.php");
if($_GET['product_category_id'])
{
	$product_subcategory = product_subcategory_name($_GET['product_category_id']);
	echo '<option value="">All</option>';
	while($product_subcategory_number = mysqli_fetch_assoc($product_subcategory))
	{
		if($_GET['product_subcategory_id']==$product_subcategory_number['id'])
			echo '<option value="'.$product_subcategory_number['id'].'" selected>'.$product_subcategory_number['name'].'</option>';
		else
			echo '<option value="'.$product_subcategory_number['id'].'" >'.$product_subcategory_number['name'].'</option>';
	}
}	
?>