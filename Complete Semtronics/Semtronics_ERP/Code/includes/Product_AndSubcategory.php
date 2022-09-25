<?php
include('Config.php');
include('Product_Management Queries.php');
ini_set("display_errors","0");
if($_GET['product_category_id'])
{
	$product_sub = Product_Subcategory();
	?>
	<select name="product_subcategory_id" id="product_subcategory_id">
		<option value="">Select</option>
		<?php
		while($product_subvalue = mysql_fetch_assoc($product_sub))
		{
			echo '<option value="'.$product_subvalue['id'].'/'.$product_subvalue['prefix'].'">'.$product_subvalue['name'].'</option>';
		} ?>
	</select>
<?php 
}
else if($_GET['product_subcategory_id'])
{
	$product = Product1();
	?>
	<select name="productid" id="productid">
		<option value="">Select</option>
		<?php
		while($product_value = mysql_fetch_assoc($product))
		{
			echo '<option value="'.$product_value['id'].'">'.$product_value['code'].'</option>';
		} ?>
	</select>
<?php
}
else if($_GET['product_subcategoryid'])
{
	$product = Product();
	?>
	<select name="productid" id="productid">
		<option value="">Select</option>
		<?php
		while($product_value = mysql_fetch_assoc($product))
		{
			if($_GET['id']==$product_value['id'])
				echo '<option value="'.$product_value['id'].'/'.$product_value['prefix'].'" selected>'.$product_value['prefix'].'</option>';
			else
				echo '<option value="'.$product_value['id'].'/'.$product_value['prefix'].'">'.$product_value['prefix'].'</option>';
		}?>
	</select>
<?php
}
else if($_GET['productcode'])
{
	$product = ProductVersions();
	if(mysql_num_rows($product))
	{
		$InArray = array();
		?>
		Versions <font color="red">*</font><br />
		<select name="versions" id="versions">
			<option value="">Select</option>
			<?php
			while($product_value = mysql_fetch_assoc($product))
			{
				if(!in_array($product_value['versions'],$InArray))
				{
					echo '<option value="'.$product_value['versions'].'">'.$product_value['versions'].'</option>';
					$InArray[] = $product_value['versions'];
				}
			} ?>
		</select>
	<?php
	}
	else
		echo "<br /><br /><br /><div style='color:red;'>BOM not defined for this product<input name='versions' type='hidden' value=''></div>";
	
	
} ?>