<?php
include('Config.php');
include('Opportunities_Queries.php');
if($_GET['product_category_id'])
{
	$product_sub = Product_Subcategory();
?>
	<select name="product_subcategory_id" id="product_subcategory_id">
		<option value="Select">Select</option>
		<?php
		while($product_subvalue = mysql_fetch_assoc($product_sub))
		{
			if($_POST['id']==$product_subvalue['id'])
				echo '<option value="'.$product_subvalue['id'].'" selected>'.$product_subvalue['name'].'</option>';
			else
				echo '<option value="'.$product_subvalue['id'].'">'.$product_subvalue['name'].'</option>';
		}
		?>
	</select>
<?php 
}
else if($_GET['product_subcategory_id'])
{
	$product = Product();
?>
	<select name="product_id" id="product_id">
		<option value="Select">Select</option>
<?php
	while($product_value = mysql_fetch_assoc($product))
		{
			if($_GET['id']==$product_value['id'])
				echo '<option value="'.$product_value['id'].'" selected>'.$product_value['code'].'</option>';
			else
				echo '<option value="'.$product_value['id'].'">'.$product_value['code'].'</option>';
		}?>
	</select>
<?php
}
?>