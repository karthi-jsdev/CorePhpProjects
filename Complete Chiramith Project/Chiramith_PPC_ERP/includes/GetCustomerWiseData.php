<?php
	include("Dashboard_Queries.php");
	include("Config.php");
	if($_GET['Limit'])
	{ 
		$i =  1;
			echo'<table class="paginate sortable full" style="width:500px">
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
			//if($_GET['pageno']==1)
				$j = 1;
			//else
				//$j = ($Limit*($_GET['pageno']-1))+1;
			$FetchMachine = Select_CustomerByLimit(0,$_GET['Limit']);
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
} ?>