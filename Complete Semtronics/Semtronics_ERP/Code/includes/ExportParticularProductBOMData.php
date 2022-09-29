<?php 
	session_start();
	ini_set("display_errors","0");
	include('Config.php');
	include('Reports_Queries.php');
	if(isset($_GET['export']))
	{
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="right">Report Date:'.date("d-m-Y").'
		</h4></div>';
	}
	
	if($_GET['getdata']=='ProductBOM_Report')
	{
		if(!$_GET['stock'])
		{ ?>
			<div class="columns">
			<h3>
				<?php
				$ProductBOMTotalRows = mysqli_fetch_assoc(ProductBOM_displaySelect_Count_All());
				echo "<h4>Total No. of Product-BOM - ".$ProductBOMTotalRows['total']."</h4>";
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
					$ProductBOMRows = ProductBOM_displaySelect_ByNOLimit();
					while($ProductBOM = mysqli_fetch_assoc($ProductBOMRows))
					{
						$FetchProductCode = mysqli_fetch_array(SelectProductCode($ProductBOM['productid']));
						$FetchRawMeterial = mysqli_fetch_array(SelectRawMeterial($ProductBOM['rawmaterialid']));
						$Fetchproductcategory = mysqli_fetch_array(SelectProductcategory($ProductBOM['productcategory_id']));
						$Fetchproductsubcategory = mysqli_fetch_array(SelectProductsubcategory($ProductBOM['productsubcategory_id']));
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
			<?php 
		}
		else
		{ ?>
		<h3>Product-BOM Status
					<?php
					$ProductBOMTotalRows = mysqli_fetch_assoc(ProductBOM_displaySelect_Count_All());
					echo "<h4>Total No. of Product-BOM - ".$ProductBOMTotalRows['total']."</h4>";
					?>
				</h3>
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
						</tr>
					</thead>
					<tbody>
						<?php
						if(!$ProductBOMTotalRows['total'])
							echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
						$i = 1;
						$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
						$ProductBOMStatusRows = ProductBOM_displaySelect_ByNOLimit();
						while($ProductBOMStatus = mysqli_fetch_array($ProductBOMStatusRows))
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
		} ?>
<?php 
	}
	?>