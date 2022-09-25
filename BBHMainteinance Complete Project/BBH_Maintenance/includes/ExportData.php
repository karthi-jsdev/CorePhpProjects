<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		include("Assets_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['getdata'] == "callslip")
	{ 
		echo '<table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Months</th>
						<th>No.Of.Slips</th>
						<th>On time</th>
						<th>Completed In 24 hrs</th>
						<th>Completed With In 7 Days</th>
						<th>Completed With In 15 Days</th>
						<th>Completed With In 30 Days</th>
						<th>Pending</th>
					</tr>
				</thead>';
				$Months = Array(date('F', strtotime('0 month')),date('F', strtotime('-1 month')),date('F', strtotime('-2 month')));
				$i = 0;
				$AllTickets = $Hour12 = $Hour24 = $Day7 = $Day15 = $Day30 = $Pending = array();
				//foreach($Months as $Month)
				for($i = 0; $i < count($Months); $i++)
				{
					echo '<tr><td>'.($i+1).'</td><td>'.$Months[$i].'</td>
					<td>'.($AllTickets[] = KPI_CallSplip_CurrentMonth(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Hour12[] = KPI_CallSplip_CurrentMonth_12Hours(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Hour24[] = KPI_CallSplip_CurrentMonth_24Hours(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Day7[] = KPI_CallSplip_CurrentMonth_7Days(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Day15[] = KPI_CallSplip_CurrentMonth_15Days(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Day30[] = KPI_CallSplip_CurrentMonth_30Days(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					<td align="center">'.($Pending[] = KPI_CallSplip_Pending(date('Y-m-d', strtotime('first day of '.(0-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(0-$i).' month', time())))).'</td>
					</tr>';
				}
			echo '</table><br/>';
			echo '<h3>Call Slip in Percentage</h3><table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Months</th>
						<th>No.Of.Slips</th>
						<th>On time</th>
						<th>Completed In 24 hrs</th>
						<th>Completed With In 7 Days</th>
						<th>Completed With In 15 Days</th>
						<th>Completed With In 30 Days</th>
						<th>Pending</th>
					</tr>
				</thead>';
				for($i = 0; $i < count($AllTickets); $i++)
				{
					if(!$AllTickets[$i])
						$AllTickets[$i] = 1;
					echo '<tr>
					<td>'.($i+1).'</td><td>'.$Months[$i].'%</td>
					<td>'.$AllTickets[$i].'</td>
					<td align="center">'.round((($Hour12[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Hour24[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day7[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day15[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day30[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Pending[$i]/$AllTickets[$i])*100),2).'%</td>
					</tr>';
				}
			echo '</table><br/><h3>Pending Call Slips Reason </h3>
			<table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Reason</th>';
						$i=0;
						foreach($Months as $Month)
						{
							echo '<th>'.$Month.'<br/>'.round((($Pending[$i]/$AllTickets[$i])*100),2).'%</th>';
							$i++;
						}
					echo '</tr>
				</thead>';
			$SelectReason = Reports_Reason();
			$i = 0;
			while($FetchReason = mysqli_fetch_array($SelectReason))
			{
				echo '<tr><td>'.($i+1).'</td><td>'.$FetchReason['name'].'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of 0 month', time())),date('Y-m-d', strtotime('last day of 0 month', time())),$FetchReason['id']).'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of -1 month', time())),date('Y-m-d', strtotime('last day of -1 month', time())),$FetchReason['id']).'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of -2 month', time())),date('Y-m-d', strtotime('last day of -2 month', time())),$FetchReason['id']).'</td>
						</tr>';
				$i++;
			}
			echo '</table><br/><h3>Call Slips Chart</h3>';
			include("Reports_Chart.php");
			echo '<br/><br/>';
	}  ?>		