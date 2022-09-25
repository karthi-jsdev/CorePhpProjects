<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Dashboard_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['getdata'] == "products")
	{
		echo "<center><h2>List of New Products</h2></center>";  
			echo "<table class='paginate sortable full' border='1'>";
				$product = Product_List();
				$j=1;
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
							<th align="left">Assigned M/c no</th>
							<th align="left">Setting Date</th>
							<th align="left">Tentative EndDate</th>
						</tr>
					</thead>
					<tbody>';
				if(mysql_num_rows($product))
				{
					while($product_limit = mysql_fetch_assoc($product))
					{
						$MachineNum = mysql_fetch_array(Select_Machine($product_limit['id']));
						$FetchMachine = mysql_fetch_array(Fetch_Machine($MachineNum['machine_id']));
						echo '<tr>
								<td>'.$j++.'</td>
								<td>'.$product_limit['description'].'</td>
								<td>'.$product_limit['drawing_number'].'</td>
								<td>'.$product_limit['material_size'].'</td>
								<td>'.$product_limit['material_type'].'</td>
								<td>'.$product_limit['grade'].'</td>
								<td>'.$product_limit['plannedquantity'].'</td>
								<td>'.$product_limit['machine_number'].'</td>
								<td>'.$product_limit['tentative_date'].'</td>
								<td>'.$product_limit['tentative_enddate'].'</td>
							</tr>';
					}
				}
				echo'</table>';	
	}
	else if($_GET['getdata'] == "machine")
	{
		echo '<center><h2>Machine Availability</h2> </center> 
			<table class="paginate sortable full" border="1">';
			$product = Product_Machine_AvailabilityList();
			//$_GET['Initial'] = 1;
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
						<th align="left">Assigned M/c no</th>
						<th align="left">Tentative Finishing Date</th>
					</tr>
				</thead>
				<tbody>';
			if(mysql_num_rows($product))
			{
				while($product_limit = mysql_fetch_assoc($product))
				{
					$MachineNum = mysql_fetch_array(Select_Machine($product_limit['id']));
					$FetchMachine = mysql_fetch_array(Fetch_Machine($MachineNum['machine_id']));
					echo '<tr>
							<td>'.$i++.'</td>
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
			}
			echo'</table>';
	}
	else if($_GET['getdata'] == "section")
	{
		echo '<center><h2>Sectionwise Machine Status</h2></center>';
		$i=1;
		echo'<table class="paginate sortable full" border="1" style="width:500px">
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
		$FetchMachine = Select_MachineId();
		$TotalMachine = $TotalRunning = $Total = 0;
		while($FetchSections = mysql_fetch_array($FetchMachine))
		{
			$MachineId = $FetchSections['MachineId'];
			$TotalMachine += $MachineId;
			$JobMachineId = $FetchSections['JobMachineId'];
			$TotalRunning += $JobMachineId;
			$TotalRunningAndAvailable = $MachineId+$JobMachineId;
			$Total += $TotalRunningAndAvailable;
			$FetchSections = mysql_fetch_array(Select_Sections($FetchSections['section_id']));
			echo '<tr>
					<td>'.$i++.'</td>
					<td>Section '.$FetchSections['name'].'</td>
					<td align="center">'.$JobMachineId.'</td>
					<td align="center">'.($MachineId-$JobMachineId).'</td>
					<td align="center">'.$MachineId.'</td>
				</tr>';
		}
		echo '<tr><td colspan="1"></td><td><b>Total</b></td><td align="center">'.$TotalRunning.'</td><td align="center">'.($TotalMachine-$TotalRunning).'</td><td align="center">'.$TotalMachine.'</td></tr>
		</table>';
	}
	else if($_GET['getdata'] == "customer")
	{
		echo '<center><h2>Customerwise Machine Status</h2></center>';
			echo'<table class="paginate sortable full" border="1" style="width:500px">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Customer Name</th>
						<th>Total Product Running</th>
						<th>Total Machine Running</th>
							<th>Total</th>
					</tr>
				</thead>
				<tbody>';
				$j = 1;
			$FetchMachine = Select_Customer();
			$TotalMachinesRunning = $TotalProductRunning = $Totals = 0;
			while($FetchSections = mysql_fetch_array($FetchMachine))
			{
				$MachineId = $FetchSections['MachineId'];
				$TotalMachinesRunning += $MachineId;
				$JobMachineId = $FetchSections['ProductId'];
				$TotalProductRunning += $JobMachineId;
				$Totals += $JobMachineId+$MachineId;
				$FetchCustomer = mysql_fetch_array(Select_CustomersName($FetchSections['id']));
				echo '<tr>
						<td>'.$j++.'</td>
						<td>'.$FetchCustomer['name'].'</td>
						<td align="center">'.$JobMachineId.'</td>
						<td align="center">'.$MachineId.'</td>
						<td align="center">'.($JobMachineId+$MachineId).'</td>
					</tr>';
			}
			echo '<tr><td colspan="1"></td><td><b>Total</b></td><td align="center">'.$TotalProductRunning.'</td><td align="center">'.$TotalMachinesRunning.'</td><td align="center">'.$Totals.'</td></tr>
			</table>';
	}
	else if($_GET['getdata'] == "charts")
	{ ?>
		<table>
			<tr>
				<td>
					<?php include("Machine_Running_Percentage.php"); ?>
				</td>
				<td>
					<?php include("SectionwiseMachineallocation.php"); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php include("Customerwise_Machineallocation.php"); ?>
				</td>
				<td>
					<?php include("RawMaterialwisechart.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<center><font size="4"><b>Customer Wise Machine Allocation Percentage</b></font></center><br />
					<?php include("Customerwise_Machineallocation2.php"); ?>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<center><font size="4"><b>Raw Material Wise Machine Allocation Percentage</b></font></center><br />
					<?php include("RawMaterialwisechart2.php"); ?>
				</td>
			</tr>
		</table>
	
	<?php } ?>
	