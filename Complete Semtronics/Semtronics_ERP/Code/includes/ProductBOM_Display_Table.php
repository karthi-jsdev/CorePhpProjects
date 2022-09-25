<?php
	include('Config.php');
	include('Reports_Queries.php');
	ini_set("display_errors","0");
if(!$_GET['stock'])
{ ?>
<div class="columns">
	<h3>
		<?php
		$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_displaySelect_Count_All());
		echo "<h4>Total No. of Product-BOM - ".$ProductBOMTotalRows['total']."</h4>";
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_ParticularProductBOMData("getdata=particularproductbom")\'><img src="images/icons/download.png"></a></div>';
		?>
	</h3>		
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Product Category</th>
				<th align="left">Product Sub Category</th>
				<th align="left">Product Code</th>
				<th align="left">Rawmaterial Code</th>
				<th align="left">Quantity</th>
				<th align="left">Reference</th>
				<th align="left">Part Number</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$ProductBOMTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$i = 1;
			$ProductBOMRows = ProductBOM_displaySelect_ByNOLimit();
			while($ProductBOM = mysql_fetch_assoc($ProductBOMRows))
			{
				$FetchProductCode = mysql_fetch_array(SelectProductCode($ProductBOM['productid']));
				$FetchRawMeterial = mysql_fetch_array(SelectRawMeterial($ProductBOM['rawmaterialid']));
				$Fetchproductcategory = mysql_fetch_array(SelectProductcategory($ProductBOM['productcategory_id']));
				$Fetchproductsubcategory = mysql_fetch_array(SelectProductsubcategory($ProductBOM['productsubcategory_id']));
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>
					<td align='center'>".$Fetchproductcategory['name']."</td>
					<td align='center'>".$Fetchproductsubcategory['name']."</td>
					<td align='center'>".$FetchProductCode['code']."</td>
					<td align='center'>".$FetchRawMeterial['materialcode']."</td>
					<td align='center'>".$ProductBOM['quantity']."</td>
					<td align='center'>".$ProductBOM['reference']."</td>
					<td align='center'>".$FetchRawMeterial['partnumber']."</td>
				</tr>";
			} ?>
		</tbody>
	</table>
</div>
<?php }
else
{ ?>
		<?php
		$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_displaySelect_Count_All());
		echo "<h4>Total No. of Product-BOM - ".$ProductBOMTotalRows['total']."</h4>";
		echo '<div align="right"><a href="#" title="Download" onclick=\'Export_ParticularProductBOMData("getdata=particularproductbom")\'><img src="images/icons/download.png"></a></div>';
		?>	
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Product Code</th>
				<th align="left">Rawmeterial Code</th>
				<th align="left">Quantity</th>
				<th align="left">Reference</th>
				<th align="left">Part Number</th>
				<th align="left">Unit Cost</th>
				<th align="left">Total</th>
				<th align="left">Stock</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$ProductBOMTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$i = 1;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$ProductBOMStatusRows = ProductBOM_displaySelect_ByNOLimit();
			while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>
					<td align='center'>".$ProductBOMStatus['productcode']."</td>
					<td align='center'>".$ProductBOMStatus['materialcode']."</td>
					<td align='center'>".$ProductBOMStatus['quantity']."</td>
					<td align='center'>".$ProductBOMStatus['reference']."</td>
					<td align='center'>".$ProductBOMStatus['partnumber']."</td>
					<td align='center'>".$ProductBOMStatus['unitprice']."</td>
					<td align='center'>".($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity'])."</td>
					<td align='center'>".$ProductBOMStatus['stockquantity']."</td>
				</tr>";	
			} ?>
		</tbody>
	</table>

<?php	
}
?>
