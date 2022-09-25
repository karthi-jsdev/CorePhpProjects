<?php 
if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>All ProductBOM Report </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
		
	if($_GET['getdata']=='ProductBOM_Report')
	{ ?>
<div class="columns">
	<h3>
		<?php
		$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_Select_Count_All());
		?>
	</h3>
	<table class="paginate sortable full" border="1">
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
			$ProductBOMRows = ProductBOM_Select_ByNOLimit();
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
<?php } ?>