<?php
	include("Product_Management Queries.php");
	include("Config.php");
	if($_GET['Prefix'])
	{ 
	?>
		<label>Product Code <font color="red">*</font><br>
		<select name="productid" id="productid"  onchange="GetKittingName('',this.value)">
			<option value="">Select</option>
			<?php
				$Select_ProductCode = Select_ProductCodeByAsc(substr($_GET['Prefix'],0,3)); 
				while($FetchProductCode = mysql_fetch_array($Select_ProductCode))
				{
					if($_GET['productid']==$FetchProductCode['id'])
						echo '<option value="'.$FetchProductCode['id'].'" selected>'.$FetchProductCode['code'].'</option>';
					else
						echo '<option value="'.$FetchProductCode['id'].'">'.$FetchProductCode['code'].'</option>';
				}
			?>
		</select></label>
<?php
} ?>