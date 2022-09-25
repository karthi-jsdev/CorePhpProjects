<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix" style="width:1000px;">
			<?php
				$productcode = mysql_query("SELECT * FROM products");
			?>
			<label>Product Code <font color="red">*</font>
				<select id="productcode" name="productcode" onchange="product_subcategory()">
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
			<br /><br />
				<input type="submit" class="button button-blue" name="submit" id="show" onclick="Display_Table();" value="Submit"></a>		
		</div>		
	</fieldset>
</form>
<div id="main">
	<div class="columns">
		<h3>
			<?php
			$ProductTotalRows = mysql_fetch_assoc(Product_Select_Count_All());
			echo "<h4>Total No. of Products - ".$ProductTotalRows['total']."</h4>";
			if(!$_POST['productcode'])
				echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Data()\'><img src="images/icons/download.png"></a></div>';
			else if($_POST['productcode'])
				echo '<div align="right"><a href="#" title="Download" onclick=\'Export_ProductData()\'><img src="images/icons/download.png"></a></div>';
			?>
		</h3>
		<table class="paginate sortable full" style="width:1000px;">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Code</th>
					<th align="left">Description</th>
					<th align="left">Watt</th>
					<th align="left">Watt Max</th>
					<th align="left">I/P Voltage</th>
					<th align="left">I/P Voltage Max</th>
					<th align="left">O/P Voltage</th>
					<th align="left">O/P Voltage Max</th>
					<th align="left">O/P Current</th>
					<th align="left">Efficiency</th>
					<th align="left">L</th>
					<th align="left">B</th>
					<th align="left">H</th>
					<th align="left">Pack Quantity</th>
					<th align="left">Remarks</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$ProductTotalRows['total'])
					echo '<tr><td colspan="16"><font color="red"><center>No data found</center></font></td></tr>';
				$i = 1;
				if($_POST['productcode'])
				{
					$ProductRows = Product_Select_Subcategory_ByNoLimit();
					while($Product = mysql_fetch_assoc($ProductRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$Product['productcode']."</td>
							<td align='left'>".$Product['description']."</td>
							<td align='center'>".$Product['watt']."</td>
							<td align='center'>".$Product['wattmax']."</td>
							<td align='center'>".$Product['inputvoltage']."</td>
							<td align='center'>".$Product['inputvoltagemax']."</td>
							<td align='center'>".$Product['outputvoltage']."</td>
							<td align='center'>".$Product['outputvoltagemax']."</td>
							<td align='center'>".$Product['outputcurrent']."</td>
							<td align='center'>".$Product['efficiency']."</td>
							<td align='center'>".$Product['l']."</td>
							<td align='center'>".$Product['b']."</td>
							<td align='center'>".$Product['h']."</td>
							<td align='center'>".$Product['packquantity']."</td>
							<td align='center'>".$Product['remarks']."</td>
						</tr>";
					}
				}
				else
				{
					$ProductRows = Product_Select_ByNoLimit();
					while($Product = mysql_fetch_assoc($ProductRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$Product['productcode']."</td>
							<td align='left'>".$Product['description']."</td>
							<td align='center'>".$Product['watt']."</td>
							<td align='center'>".$Product['wattmax']."</td>
							<td align='center'>".$Product['inputvoltage']."</td>
							<td align='center'>".$Product['inputvoltagemax']."</td>
							<td align='center'>".$Product['outputvoltage']."</td>
							<td align='center'>".$Product['outputvoltagemax']."</td>
							<td align='center'>".$Product['outputcurrent']."</td>
							<td align='center'>".$Product['efficiency']."</td>
							<td align='center'>".$Product['l']."</td>
							<td align='center'>".$Product['b']."</td>
							<td align='center'>".$Product['h']."</td>
							<td align='center'>".$Product['packquantity']."</td>
							<td align='center'>".$Product['remarks']."</td>
						</tr>";
					}
				}	?>
			</tbody>
		</table>
	</div>
</div>		
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
			{
				document.getElementById('product_subcategory_id').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Get_Product_Subcategory.php?product_category_id="+document.getElementById('product_category_id').value,true);
		xmlhttp.send();
	}
	function Display_Table()
	{
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
		xmlhttp.open("GET","includes/Prodcuct_Display_Table.php?product_category_id="+document.getElementById("product_category_id").value+"&product_subcategory_id="+document.getElementById("product_subcategory_id").value, true);
		xmlhttp.send();
	}
	function Export_Data()
	{
		window.open("includes/Custom_Report_Actions.php?Module=Product",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Export_ProductData()
	{
		window.open("includes/Custom_Report_Actions.php?Module=Product&productcode="+document.getElementById("productcode").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}	
</script>