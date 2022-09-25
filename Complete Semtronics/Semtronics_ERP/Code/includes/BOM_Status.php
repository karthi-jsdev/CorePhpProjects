<section role="main" id="main">
	<div class="columns" style='width:902px;'>
	<?php echo $message;?>
		<form method="post" name="" class="form panel" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Product-BOM Status</h2></header>
			<hr />			
			<fieldset>
				<div class="clearfix">
					<?php
						$productcode = mysql_query("SELECT * FROM products");
					?>
					<label>Product Code <font color="red">*</font>
						<select id="productcode" name="productcode">
							<option value="select">Select</option>
							<?php
								while($productcodes = mysql_fetch_array($productcode))
								{
									if($_GET['productcode'] == $productcodes['id'] || $_POST['productcode'] == $productcodes['id'])
										echo '<option value="'.$productcodes['id'].'" selected>'.$productcodes['productcode'].'</option>';
									else
										echo '<option value="'.$productcodes['id'].'">'.$productcodes['productcode'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Submit" value="submit" >Submit</button>&nbsp;&nbsp;';
			?>
		</form>
	</div>
	<div class="columns">
		<?php
	if($_POST['productcode'] || $_GET['productcode'])
	{ ?>
		<h3>
			<?php
			$ProductBOMStatusTotalRows = mysql_fetch_array(ProductBOMStatus_Select_Count_All());
			if(!$ProductBOMStatusTotalRows['total'])
				$ProductBOMStatusTotalRows['total'] = 0;
			?>
		</h3>
		<hr />			
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Product Code</th>
					<th align="left">Rawmaterial Code</th>
					<th align="left">Quantity</th>
					<th align="left">Reference</th>
					<th align="left">Tolerance</th>
					<th align="left">Package</th>
					<th align="left">Make</th>
					<th align="left">Part Number</th>
					<th align="left">Unit Cost</th>
					<th align="left">Total</th>
					<th align="left">Stock</th>
					<th align="left">Stock</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$ProductBOMStatusTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>Bom not defined for this product</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($ProductBOMStatusTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$i++;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$ProductBOMStatusRows = ProductBOMStatus($Start, $Limit);
				while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
				{
					echo "<tr style='valign:middle;'>
						<td align='center'>".$i++."</td>
						<td align='center'>".$ProductBOMStatus['productcode']."</td>
						<td align='center'>".$ProductBOMStatus['materialcode']."</td>
						<td align='center'>".$ProductBOMStatus['quantity']."</td>
						<td align='center'>".$ProductBOMStatus['reference']."</td>
						<td align='center'>".$ProductBOMStatus['tolerance']."</td>
						<td align='center'>".$ProductBOMStatus['package']."</td>
						<td align='center'>".$ProductBOMStatus['make']."</td>
						<td align='center'>".$ProductBOMStatus['partnumber']."</td>
						<td align='center'>".round($ProductBOMStatus['unitprice'],2)."</td>
						<td align='center'>".round(($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity']),2)."</td>";
						if($ProductBOMStatus['stockquantity']=="")
							echo "<td align='center'>0</td>";
						else	
							echo "<td align='center'>".$ProductBOMStatus['stockquantity']."</td>";
						echo "<td align='center'>".$ProductBOMStatus['bom_category']."</td>
					</tr>";	
				}?>
				
			</tbody>
		</table>
		<?php
			$total = 0;
			$ProductBOM_Value = ProductBOMStatus_Totalvalue();
			while($ProductBOM_Values = mysql_fetch_assoc($ProductBOM_Value))
			{
				$total = $total + ($ProductBOM_Values['quantity'] * $ProductBOM_Values['unitprice']);
			}
				echo "<strong>Total Cost is ".$total."</strong>";
		?>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
		if($_GET['productcode'])
			$_POST['productcode']=$_GET['productcode'];
		$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&productcode=".$_POST['productcode']."&";
		if($total_pages > 1)
			include("includes/Pagination.php");
	}?>
</section>
<script>
	function GetProductCode(Prefix,productid)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetProductCode.php?Prefix="+Prefix+"&productid="+productid,true);
		xmlhttp.send();
	}
	function product_subcategory()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product_subcategory_id').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?product_category_id="+document.getElementById('productcode').value,true);
		xmlhttp.send();
	}
	function product()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('productid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?product_subcategory_id="+document.getElementById('product_subcategory_id').value,true);
		xmlhttp.send();
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("productcode").value == "")
			message = "Please select the productcode";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	/*function rawmaterial()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
					document.getElementById('rawmaterialid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?productbomstatusid="+document.getElementById('productid').value,true);
		xmlhttp.send();
	}*/
</script>