<?php
	if(!$_GET['limit'])
		$_GET['limit'] = 5;
	function PaginationFor($PaginationFor, $PageNo, $TotalPages)
	{
		$_GET['pageno'] = $PageNo;
		$_GET["PaginationFor"] = $PaginationFor;
		$_GET['total_pages'] = $TotalPages;
		if($_GET['total_pages'] > 1)
			include("includes/Ajax_Pagination_Dashboard.php");
	}
	
	if($_GET['Initial'])
		include("includes/Dashboard_Queries.php");
	else
	{
		session_start();
		include("Config.php");
		include("Dashboard_Queries.php");
		$PaginationFor = $_GET['PaginationFor'];
	}
	
	if(!$PaginationFor)
	{
		echo '<table><tr><td style="width:950px"><h3>List of New Products (Setting Datewise)</h3></td><td>
			<select id="ProductsWise" onchange=\'Ajax_Pagination("Products", "1", this.value)\'>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</td><td><a href="" title="Download" onclick=\'Export("getdata=products")\'><img src="images/icons/download.png"></a></td></tr></table>';
	}
	if(!$PaginationFor || $PaginationFor == "Products")
	{
		echo "<div id='Products'>
			<table class='paginate sortable full'>";
				$NumofProduct = mysql_num_rows(Product_List());
				if(!$NumofProduct)
					echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
				
				$_GET['total_pages'] = ceil($NumofProduct / $_GET['limit']);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				$Start = ($_GET['pageno']-1)*$_GET['limit'];
				
				if($_GET['pageno']==1)
					$j = 1;
				else
					$j = ($_GET['limit']*($_GET['pageno']-1))+1;
					
				$product = Product_List_ByLimit5($Start,$_GET['limit']);
				
				$i=1;
				echo'<thead>
						<tr>
							<th align="left">Sl. No.</th>
							<th align="left">Product Description</th>
							<th align="left">Drawing No.</th>
							<th align="left">Material Size</th>
							<th align="left">Material Type</th>
							<th align="left">Material Grade/Alloy</th>
							<th align="left">Planned Quantity</th>
							<!--th align="left">Number of pieces</th-->
							<th align="left">Assigned M/c no</th>
							<th align="left">Setting Date</th>
							<th align="left">Tentative EndDate</th>
						</tr>
					</thead>
					<tbody>';
				//if(mysql_num_rows($product))
				//{
					while($product_limit = mysql_fetch_assoc($product))
					{
						//$MachineNum = mysql_fetch_array(Select_Machine($product_limit['id']));
						//$FetchMachine = mysql_fetch_array(Fetch_Machine($MachineNum['machine_id']));
						echo '<tr>
								<td>'.$j++.'</td>
								<td>'.$product_limit['description'].'</td>
								<td>'.$product_limit['drawing_number'].'</td>
								<td>'.$product_limit['material_size'].'</td>
								<td>'.$product_limit['material_type'].'</td>
								<td>'.$product_limit['grade'].'</td>
								<td>'.$product_limit['plannedquantity'].'</td>
								<!--td>'.$product_limit['numberofpieces'].'</td-->
								<td>'.$product_limit['machine_number'].'</td>
								<td>'.$product_limit['tentative_date'].'</td>
								<td>'.$product_limit['tentative_enddate'].'</td>
							</tr>';
					}
				//}
				echo'</tbody></table>';
				if($_GET["Initial"])
					PaginationFor("Products", 1, $_GET['total_pages']);
		echo "</div>";
	}
	if(!$PaginationFor)
	{
		echo '<table><tr><td style="width:950px"><h3>Machine Availability (Finishing Datewise)</h3></td>
		<td>
			<select id="MachineWise" onchange=\'Ajax_Pagination("MachineAvalability", "1", this.value)\'>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</td>
		<td><a href="" title="Download" onclick=\'Export("getdata=machine")\'><img src="images/icons/download.png"></a></td></tr></table>';
	}
	else
		echo "<div id='MachineWise' />";
	if(!$PaginationFor || $PaginationFor == "MachineAvalability")
	{ ?>
		<div id='MachineAvalability'>
			<table class="paginate sortable full">
			<?php
			$NumofProductMachineAvailability = mysql_num_rows(Product_Machine_AvailabilityList());
			if(!$NumofProductMachineAvailability)
				echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
			//$Limit = 5;
			$_GET['total_pages'] = ceil($NumofProductMachineAvailability / $_GET['limit']);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$Start = ($_GET['pageno']-1)*$_GET['limit'];
			$product = Product_Machine_AvailabilityList_ByLimit5($Start,$_GET['limit']);
			$i=1;
			echo'
				<thead>
					<tr>
						<th align="left">Sl. No.</th>
						<th align="left">Product Description</th>
						<th align="left">Drawing No.</th>
						<th align="left">Material Size</th>
						<th align="left">Material Type</th>
						<th align="left">Material Grade/Alloy</th>
						<th align="left">Planned Quantity</th>
						<!--th align="left">Number of pieces</th-->
						<th align="left">Assigned M/c no</th>
						<th align="left">Tentative Finishing Date</th>
					</tr>
				</thead>
				<tbody>';
			if($_GET['pageno']==1)
				$j = 1;
			else
				$j = ($_GET['limit']*($_GET['pageno']-1))+1;
			//if(mysql_num_rows($product))
			//{
				while($product_limit = mysql_fetch_assoc($product))
				{
					//$MachineNum = mysql_fetch_array(Select_Machine($product_limit['id']));
					//$FetchMachine = mysql_fetch_array(Fetch_Machine($MachineNum['machine_id']));
					echo '<tr>
							<td>'.$j++.'</td>
							<td>'.$product_limit['description'].'</td>
							<td>'.$product_limit['drawing_number'].'</td>
							<td>'.$product_limit['material_size'].'</td>
							<td>'.$product_limit['material_type'].'</td>
							<td>'.$product_limit['grade'].'</td>
							<td>'.$product_limit['plannedquantity'].'</td>
							<!--td>'.$product_limit['numberofpieces'].'</td-->
							<td>'.$product_limit['machine_number'].'</td>
							<td>'.$product_limit['tentative_enddate'].'</td>
						</tr>
					</tbody>';
				}
			//}
			echo'</table>';
		if($_GET["Initial"])
			PaginationFor("MachineAvalability", 1, $_GET['total_pages']);
		echo "</div>";
	}
	if(!$PaginationFor)
	{ 
		echo '<table><tr><td style="width:465px"><h3>Sectionwise Machine Status</h3></td><td><a href="" title="Download" onclick=\'Export("getdata=section")\'><img src="images/icons/download.png"></a></td></tr></table>';
		$_GET['Initial'] = $i = 1;
		echo'<table class="paginate sortable full" style="width:500px">
			<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Section</th>
					<th>Total Machine Running</th>
					<th>Total Machine Available</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>';
		$FetchMachine = SectionWiseMachineAllocation();
		//$TotalMachine = $TotalRunning = $Total = 0;
		while($FetchSections = mysql_fetch_array($FetchMachine))
		{
			/*$MachineId = $FetchSections['MachineId'];
			$TotalMachine += $MachineId;
			$JobMachineId = $FetchSections['JobMachineId'];
			$TotalRunning += $JobMachineId;
			$TotalRunningAndAvailable = $MachineId+$JobMachineId;
			$FetchSections = mysql_fetch_array(Select_Sections($FetchSections['section_id']));*/
			$TotalMachineRunning +=$FetchSections['JobMachineId'];
			$TotalMachineAvailable += ($FetchSections['MachineId'] - $FetchSections['JobMachineId']);
			$Total += $FetchSections['MachineId'];
			$SectionName = mysql_fetch_array(mysql_query("SELECT * FROM section WHERE id = '".$FetchSections['section_id']."'"));
			echo '<tr>
					<td>'.$i++.'</td>
					<td>Section '.$SectionName['name'].'</td>
					<td align="center">'.$FetchSections['JobMachineId'].'</td>
					<td align="center">'.($FetchSections['MachineId'] - $FetchSections['JobMachineId']).'</td>
					<td align="center">'.$FetchSections['MachineId'].'</td>
				</tr>';
		}
		echo '<tr><td colspan="1"></td><td><b>Total</b></td><td align="center">'.$TotalMachineRunning.'</td><td align="center">'.($TotalMachineAvailable).'</td><td align="center">'.$Total.'</td></tr>
		</table>';
	}
	
	if(!$PaginationFor)
	{
		echo '<br/>
		 <table><tr><td style="width:465px"><h3>Customerwise Machine Status</h3></td>
		<td><br/>
			<select id="CustomerWiseLimit" onchange=\'Ajax_Pagination("CustomerWise", "1", this.value)\'>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</td>
		<td><a href="" title="Download" onclick=\'Export("getdata=customer")\'><img src="images/icons/download.png"></a></td></tr></table>
		';
	}
	if(!$PaginationFor || $PaginationFor == "CustomerWise")
	{ ?>
	<div id="CustomerWise"> 
		<table frame="box">
			<?php
			$NumofCustomer = mysql_num_rows(Select_Customer());
			if(!$NumofCustomer)
				echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
			//$Limit = 10;
			$_GET['total_pages'] = ceil($NumofCustomer / $_GET['limit']);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$Start = ($_GET['pageno']-1)*$_GET['limit'];
			$i =  1;
			$TotalMachinesRunning = $TotalProductRunning = $Totals = 0;
			$FetchMachines = Select_Customer();
			while($FetchSection = mysql_fetch_array($FetchMachines))
			{
				$MachineId = $FetchSection['MachineId'];
				$TotalMachinesRunning += $MachineId;
				$JobMachineId = $FetchSection['ProductId'];
				$TotalProductRunning += $JobMachineId;
				$Totals += $JobMachineId+$MachineId;
			}
			echo'<table class="paginate sortable full" style="width:500px">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Customer Name</th>
						<th>Total Product Running ('.$TotalProductRunning.')</th>
						<th>Total Machine Running ('.$TotalMachinesRunning.')</th>
							<!--th>Total ('.$Totals.')</th-->
					</tr>
				</thead>
				<tbody>';
			if($_GET['pageno']==1)
				$j = 1;
			else
				$j = ($_GET['limit']*($_GET['pageno']-1))+1;
			$FetchMachine = Select_CustomerByLimit($Start,$_GET['limit']);
			while($FetchSections = mysql_fetch_array($FetchMachine))
			{
				$MachineId = $FetchSections['MachineId'];
				//$TotalMachinesRunning += $MachineId;
				$JobMachineId = $FetchSections['ProductId'];
				//$TotalProductRunning += $JobMachineId;
				//$Totals += $JobMachineId+$MachineId;
				$FetchCustomer = mysql_fetch_array(Select_CustomersName($FetchSections['id']));
				echo '<tr>
						<td>'.$j++.'</td>
						<td>'.$FetchCustomer['name'].'</td>
						<td align="center">'.$JobMachineId.'</td>
						<td align="center">'.$MachineId.'</td>
						<!--td align="center">'.($JobMachineId+$MachineId).'</td!-->
					</tr>';
			}
			echo '</table>';
			?>
		</table>
	<?php
	if($_GET["Initial"])
		PaginationFor("CustomerWise", 1, $_GET['total_pages']);
	echo "</div>";
}/*
if(!$PaginationFor)
{ ?>
		<table frame="box" >
			<h3>Machine Status Summary</h3>
			<?php
				$i=1;
				$machine_working =	Running_Machine_count();
				$machine_notworking = Notworking_Machine_count();
				$machine_nearing = Machine_Nearing_Count();
				echo'<table class="paginate sortable full">
					<thead>
						<tr>
							<th>Sl.No.</th>
							<th>Item</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>';
				$machine_working_status = mysql_fetch_assoc($machine_working);
				$machine_notworking_status = mysql_fetch_assoc($machine_notworking);
				$machine_nearing = mysql_fetch_assoc($machine_nearing);
					echo'
						<tr><td>1</td><td>Total Machine Running</td><td>'.$machine_working_status['Item'].'</td></tr>
						<tr><td>2</td><td>Total Machine Not Running</td><td>'.$machine_notworking_status['Item'].'</td></tr>
						<tr><td>3</td><td>Total Machine Nearing</td><td>'.$machine_nearing['Item'].'</td></tr>';
				
				echo'</tbody>
				</table>';
			?>
		</table>
		<table frame="box">
			<h3>Today Job Complete Status</h3>
			<?php
				$i=1;
				$job = Job_Complete_Status();
				echo'<table class="paginate sortable full">
						<thead>
							<tr>
								<th>Sl.No.</th>
								<th>Customer</th>
								<th>Product</th>
								<th>Machine</th>
								<th>TentativeDate</th>
							</tr>
						</thead>
						<tbody>';
				if(mysql_num_rows($job)==0)
					echo "<tr><td colspan='5' style='color:red;'><center>No Data Found</center></td></tr>";
				while($job_report = mysql_fetch_assoc($job))
				{
						echo'<tr>
							<td align="center">'.$i++.'</td>
							<td align="center">'.$job_report['customer'].'</td>
							<td align="center">'.$job_report['product'].'</td>
							<td align="center">'.$job_report['machineid'].'</td>
							<td align="center">'.$job_report['tentativedate'].'</td>
						</tr>';
				}
					echo'</tbody>
					</table>';
				?>
		</table><?php 
}	*/	
		if(!$PaginationFor)
		{	//echo '<br/><table><tr><td style="width:950px"></td><td><a href="" title="Download" onclick=\'Export("getdata=charts")\'><img src="images/icons/download.png"></a></td></tr></table>';
		?>	
		<table>
			<tr>
				<td colspan='2'>
				<h3>Trend chart for Total machine running status</h3>
					<?php include("Machine_Running_Percentage.php"); ?>
				</td>
			</tr>	
			<tr>	
				<td colspan='2'>
				<h3>Trend chart for Machine allocation- Sectionwise</h3>
					<?php include("SectionwiseMachineallocation.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
				<h3>Trend chart for Machine allaction- Rawmaterial typewise</h3>
					<?php include("RawMaterialwisechart.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<h3> Trend chart for Machine allocation- Customerwise</h3><br />
					<?php include("Customerwise_Machineallocation2.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<h3>Trend chart for Machine alloaction- Machine specificationwise</h3><br />
					<?php include("Machine_Specificationchart.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<h3>Trend chart for Machine alloaction- Rawmaterial grade/Alloywise</h3><br />
					<?php include("Machine_Rawmaterialtypechart.php"); ?>
				</td>
			</tr>
		</table>
	<?php
	} ?>
<script>
	total_pages = <?php if($_GET['total_pages']) echo $_GET['total_pages']; else echo 1; ?>;
	function basicPopup(url) 
	{
		popupWindow = window.open(url,'popUpWindow','height=475,width=650,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
	}
	function Export(PostBackValues)
	{
		window.open("includes/ExportData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>