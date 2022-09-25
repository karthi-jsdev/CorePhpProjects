<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<?php
			$productcode = mysql_query("SELECT * FROM products");
		?>
		<label>Product Code <font color="red">*</font>
			<select id="productcode" name="productcode">
				<option value="">Select</option>
				<?php
					while($productcodes = mysql_fetch_array($productcode))
					{
						if($_POST['productcode'] == $productcodes['id'])
							echo '<option value="'.$productcodes['id'].'" selected>'.$productcodes['productcode'].'</option>';
						else
							echo '<option value="'.$productcodes['id'].'">'.$productcodes['productcode'].'</option>';
					}
				?>
			</select>
		</label>
		<br/>
		<label><input type="checkbox" name="stock" id ="stock">Stock<br></label>
		<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>	
	</fieldset>
</form>
<?php 
if(!$_GET['productcode'])
{ ?>
<div id="main">
	<div class="columns">
		<h3>
			<?php
			$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_Select_Count_All());
			echo "<h4>Total No. of Product-BOM - ".$ProductBOMTotalRows['total']."</h4>";
			echo '<div align="right"><a href="#" title="Download" onclick=\'Export_productbomData("getdata=ProductBOM_Report")\'><img src="images/icons/download.png"></a></div>';
			?>
		</h3>
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
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$ProductBOMTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				$i = 1;
				$ProductBOMRows = ProductBOM_Select_ByNOLimit();
				while($ProductBOM = mysql_fetch_assoc($ProductBOMRows))
				{
					/* $FetchProductCode = mysql_fetch_array(SelectProductCode($ProductBOM['productid']));
					$FetchRawMeterial = mysql_fetch_array(SelectRawMeterial($ProductBOM['rawmaterialid']));
					$Fetchproductcategory = mysql_fetch_array(SelectProductcategory($ProductBOM['productcategory_id']));
					$Fetchproductsubcategory = mysql_fetch_array(SelectProductsubcategory($ProductBOM['productsubcategory_id'])); */
					echo "<tr style='valign:middle;'>
						<td align='center'>".$i++."</td>
						<td align='center'>".$ProductBOM['productcode']."</td>
						<td align='center'>".$ProductBOM['materialcode']."</td>
						<td align='center'>".$ProductBOM['quantity']."</td>
						<td align='center'>".$ProductBOM['reference']."</td>
						<td align='center'>".$ProductBOM['tolerance']."</td>
						<td align='center'>".$ProductBOM['package']."</td>
						<td align='center'>".$ProductBOM['make']."</td>
						<td align='center'>".$ProductBOM['partnumber']."</td>
					</tr>";
				} ?>
			</tbody>
		</table>
	</div>
	<div class="clear">&nbsp;</div>	
</div>
<?php }
?>
<script>
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
		xmlhttp.open("GET","includes/Product_AndSubcategoryReports.php?product_category_id="+document.getElementById('productcode').value,true);
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
		xmlhttp.open("GET","includes/Product_AndSubcategoryReports.php?productcode="+document.getElementById('productcode').value,true);
		xmlhttp.send();
	}
	function Display_Table()
	{
		var message = "";
		if(document.getElementById("productid").value=="")
			message = "Please Select Product Code";
		if(document.getElementById("product_subcategory_id").value=="")
			message = "Please Select Product Subcategory";
		if(document.getElementById("productcode").value=="")
			message = "Please Select Product Category";
		if(message)
		{
			alert(message);
			return false;
		}
		else
		{
			var stock = document.getElementsByName("stock");
			var flag = 0;
				for (var i = 0; i< stock.length; i++)
					if(stock[i].checked)
						flag++;
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("main").innerHTML = xmlhttp.responseText;
				}
					
			}
			xmlhttp.open("GET","includes/ProductBOM_Display_Table.php?productcode="+document.getElementById("productcode").value+"&stock="+flag, true);
			xmlhttp.send();
		}
	}
	function Export_productbomData(PostBackValues)
	{
		window.open("includes/ExportProductBOMData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Export_ParticularProductBOMData(PostBackValues)
	{
		window.open("includes/ExportParticularProductBOMData.php?export=1&"+PostBackValues+"&productcode="+document.getElementById("productcode").value+"&stock="+document.getElementsByName("stock").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>