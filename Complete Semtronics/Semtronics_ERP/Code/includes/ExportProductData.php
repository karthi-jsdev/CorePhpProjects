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
		echo '<div align="center"><h4>All Product </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
		
	if($_GET['getdata']=='Product_Report')
	{ ?>
	<div class="columns">
			<h3>
				<?php
				$ProductTotalRows = mysqli_fetch_assoc(Product_Select_Count_All());
				?>
			</h3>			
			<table class="paginate sortable full" style="width:1000px;" border="1">
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
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$i=1;
					$ProductRows = Product_Select_ByNoLimit();
					while($Product = mysqli_fetch_assoc($ProductRows))
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
					} ?>
				</tbody>
			</table>
	</div>
	<?php } ?>