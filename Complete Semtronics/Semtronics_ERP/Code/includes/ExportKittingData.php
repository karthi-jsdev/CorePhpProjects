<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Product_Management Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>Kitting Report </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
	if($_GET['productid'] && $_GET['productcat'] && $_GET['kittingquantity'])
	{	
	?>
	<h3>Kitting Status
	<?php
	$ProductBOMStatusTotalRows = mysql_fetch_assoc(ProductBOMStatus_Select_Count_All_kitting($_GET['productid']));
	echo " : No. of total Kitting - ".$ProductBOMStatusTotalRows['total'];
	?>
	</h3>			
		<form name='vendor'>	
				<table class="paginate sortable full" border="1">
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
							<th align="left">Kitting Quantity</th>
							<th align="left">Total Price</th>
							<th align="left">Vendor Name</th>
							<th align="left">Credit Limit</th>
							<th align="left">Credit Period</th>
							<th align="left">Lead Time</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!$ProductBOMStatusTotalRows['total'])
							echo '<tr><td colspan="11"><font color="red"><center>No data found</center></font></td></tr>';
						$i = 1;
						$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
						$ProductBOMStatusRows = ProductBOMStatus_Select_ByLimit($_GET['productid']);
						$Ids = explode(',', $_GET['Ids']);
						echo $vendorleadtime;
						while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
						{
							$Vendor = mysql_fetch_array(Vendor_Select_Names($Ids[$i-1])); 
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
								<td align='center'>".($_GET['kittingquantity']*$ProductBOMStatus['quantity'])."</td>
								<td align='center'>".($ProductBOMStatus['unitprice']*$_GET['kittingquantity']*$ProductBOMStatus['quantity'])."</td>
								<td align='center'>".$Vendor['name']."</td>
								<td align='center'>".$Vendor['creditlimit']."</td>
								<td align='center'>".$Vendor['creditperiodid']."</td>
								<td align='center'>".$Vendor['leadtime']."</td>
							</tr>";	
						} ?>
					</tbody>
				</table>	
			</form>
	<?php 
	}
?>