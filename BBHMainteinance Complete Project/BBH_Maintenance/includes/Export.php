<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		$_POST['Search'] = $_GET['Search'];
		$_POST['department'] = $_GET['department'];
		$_POST['subdepartment'] = $_GET['subdepartment'];
		$_POST['technician'] = $_GET['technician'];
		$_POST['zone'] = $_GET['zone'];
		$_POST['status'] = $_GET['status'];
		$_POST['complaintdate'] = $_GET['complaintdate'];
		$_POST['resolveddate'] = $_GET['resolveddate'];
		$_POST['equipment'] = $_GET['equipment'];
		$_POST['critical'] = $_GET['critical'];
		$_POST['priority'] = $_GET['priority'];
		include("Reports_Queries.php");
		include("Assets_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['subpage'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['subpage'] == "Reopened")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_Reopened();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Reopened Complaints</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;">
			<table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Department</th>
						<th>Priority</th>
						<th>Ticket No</th>
						<th>Description</th>
						<th>Sub-Department</th>
						<th>Technician</th>
						<th>Current Status</th>
						<th>Complaint-Date</th>
						<th>Resolved-Date</th>
						<th style="width:100px">Duration</th>
						<th>Amount</th>
						<th>Remarks</th>
					</tr>
				</thead>';
				while($FetchTicket = mysqli_fetch_array($SelectTickets))
				{
					$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
					$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
					$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
					$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
					$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
					$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
					$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
					$Amount = 0;
					while($AmountFetch = mysqli_fetch_array($AmountSelect))
					{
						$Amount += $AmountFetch['amount'];
					}
					echo '<tr><td>'.$Department['name'].'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '<td align="center">'.$SubGroup['name'].'</td>
						<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>
						<td align="center">'.$FetchTicket['updatedat'].'</td>';
						$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
						$days    = floor($seconds / 86400);
						$hours   = floor(($seconds - ($days * 86400)) / 3600);
						$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
						echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>
						<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
					echo '</tr>';
				}
			echo '</table><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "Department")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_Department();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Departmentwise Reports</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;"><table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Department</th>
						<th>Priority</th>
						<th>Ticket No</th>
						<th>Description</th>
						<th>Sub-Department</th>
						<th>Technician</th>
						<th>Status</th>
						<th>Complaint-Date</th>
						<th>Resolved-Date</th>
						<th style="width:100px">Duration</th>
						<th>Amount</th>
						<th>Remarks</th>
					</tr>
				</thead>';
				$Dept = "";
				
				while($FetchTicket = mysqli_fetch_array($SelectTickets))
				{
					$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
					$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
					$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
					$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
					$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
					$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
					$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
					$Amount = 0;
					while($AmountFetch = mysqli_fetch_array($AmountSelect))
					{
						$Amount += $AmountFetch['amount'];
					}
					echo '<tr><td>';					
						if($Department['name'] != $Dept)
							echo $Dept = $Department['name'];
						echo'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '<td align="center">'.$SubGroup['name'].'</td>
						<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
						if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
						{
							echo '<td align="center">-</td>';
							echo '<td align="center" style="width:100px">0d 0h:0m</td>';
						}
						else
						{						
							echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
							$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
							$days    = floor($seconds / 86400);
							$hours   = floor(($seconds - ($days * 86400)) / 3600);
							$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
							echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
						}
						echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
					echo '</tr>';
				}
			echo '</table></div>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	if($_GET['subpage'] == "Sub-Department")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_SubDepartment();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Sub-Departmentwise Reports</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;"><table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sub-Department</th>
						<th>Priority</th>
						<th>Ticket No</th>
						<th>Description</th>
						<th>Department</th>
						<th>Technician</th>
						<th>Status</th>
						<th>Complaint-Date</th>
						<th>Resolved-Date</th>
						<th style="width:100px">Duration</th>
						<th>Amount</th>
						<th>Remarks</th>
					</tr>
				</thead>';
				$SubDept = "";
				
				while($FetchTicket = mysqli_fetch_array($SelectTickets))
				{
					$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
					$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
					$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
					$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
					$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
					$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
					$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
					$Amount = 0;
					while($AmountFetch = mysqli_fetch_array($AmountSelect))
					{
						$Amount += $AmountFetch['amount'];
					}
					echo '<tr><td>';					
						if($SubGroup['name'] != $SubDept)
							echo $SubDept = $SubGroup['name'];
						echo'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '<td align="center">'.$Department['name'].'</td>
						<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
						if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
						{
							echo '<td align="center">-</td>';
							echo '<td align="center" style="width:100px">0d 0h:0m</td>';
						}
						else
						{
							echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
							$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
							$days    = floor($seconds / 86400);
							$hours   = floor(($seconds - ($days * 86400)) / 3600);
							$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
							echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
						}
						echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
					echo '</tr>';
				}
			echo '</table></div><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "Technician")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_Technician();
		if(mysqli_num_rows($SelectTickets))
		{	
			echo '<center><h3>Technicianwise Reports</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;">
			<table class="paginate sortable" border="1" >
					<thead>
						<tr>
							<th>Technician</th>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Sub-Department</th>
							<th>Status</th>
							<th>Complaint-Date</th>
							<th>Resolved-Date</th>
							<th style="width:100px">Duration</th>
							<th>Amount</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					$Tech = "";
					while($FetchTicket = mysqli_fetch_array($SelectTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
						$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
						$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
						$Amount = 0;
						while($AmountFetch = mysqli_fetch_array($AmountSelect))
						{
							$Amount += $AmountFetch['amount'];
						}
						echo '<tr><td>';					
							if($FetchTechnicians['firstname'] != $Tech)
								echo $Tech = $FetchTechnicians['firstname'];
							echo'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '<td>'.$Department['name'].'</td>
						<td>'.$SubGroup['name'].'</td>
						<td>'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
						if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
						{
							echo '<td align="center">-</td>';
							echo '<td align="center" style="width:100px">0d 0h:0m</td>';
						}
						else
						{
							echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
							$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
							$days    = floor($seconds / 86400);
							$hours   = floor(($seconds - ($days * 86400)) / 3600);
							$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
							echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
						}
						echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
						echo '</tr>';
					}
			echo '</table></div><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "Zone")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_Zone();
		if(mysqli_num_rows($SelectTickets))
		{	
			echo '<center><h3>Zonewise Reports</h3></center><table class="paginate sortable" border="1" >
					<thead>
						<tr>
							<th>Zone</th>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Sub-Department</th>
							<th>Technician</th>
							<th>Status</th>
							<th>Complaint-Date</th>
							<th>Resolved-Date</th>
							<th style="width:100px">Duration</th>
							<th>Amount</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					$Zone = "";
					while($FetchTicket = mysqli_fetch_array($SelectTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
						$FetchZone = mysqli_fetch_array(Reports_Zones_By_Id($FetchTicket['zoneid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
						$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
						$Amount = 0;
						$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
						while($AmountFetch = mysqli_fetch_array($AmountSelect))
						{
							$Amount += $AmountFetch['amount'];
						}
						echo '<tr><td>';					
							if($FetchZone['name'] != $Zone)
								echo $Zone = $FetchZone['name'];
							echo'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '
						<td>'.$Department['name'].'</td>
						<td>'.$SubGroup['name'].'</td>
						<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
						if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
						{
							echo '<td align="center">-</td>';
							echo '<td align="center" style="width:100px">0d 0h:0m</td>';
						}
						else
						{
							echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
							$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
							$days    = floor($seconds / 86400);
							$hours   = floor(($seconds - ($days * 86400)) / 3600);
							$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
							echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
						}
					echo 	'<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
						echo '</tr>';
					}	
			echo '</table><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "Summary")
	{ 
		if($_GET['ComplaintDate'])
		{ ?>
			<br/>
			<h3>Summary of Departments</h3>
			<table class="paginate sortable full" style="width:800px" border="1">
				<tbody>
					<th>Name of Department</th>
					<th>All</th>
					<?php
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							echo '<th>'.$FetchStatus['name'].'</th>';
						}
					?>
				</tbody>
				<?php
				$SelectDepartment = Reports_Departments();
				$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
				while($FetchDepartment = mysqli_fetch_array($SelectDepartment))
				{
					$NumberOfDepartment = mysqli_fetch_array(Reports_By_Department_With_Dates($FetchDepartment['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
					if($NumberOfDepartment['total'])
					{
						echo '<tr><td align="center">'.$FetchDepartment['name'].'</td><td align="center">'.$NumberOfDepartment['total'].'</td>';	
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							$Reports_By_Department_And_Status = mysqli_fetch_array(Reports_By_Department_And_Status_With_Dates($FetchDepartment['id'],$FetchStatus['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
							echo '<td align="center">'.$Reports_By_Department_And_Status['total'].'</td>';
							if($FetchStatus['id']==1)
								$TotalOpen += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==2)
								$TotalInProgress += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==3)
								$TotalInProcess += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==4)
								$TotalOnHold += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==5)
								$TotalResolved += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==6)
								$TotalReopen += $Reports_By_Department_And_Status['total'];
							else if($FetchStatus['id']==7)
								$TotalClosed += $Reports_By_Department_And_Status['total'];
						}
						echo '</tr>';
						$TotalAll += $NumberOfDepartment['total'];	
					}
				}
				echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalAll.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOpen.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProgress.'</strong>
					</td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProcess.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOnHold.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalResolved.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalReopen.'</strong></td>
					<td style="background:YELLOW;" align="center"><strong>'.$TotalClosed.'</strong></td></tr>';
				?>
			</table>
			<br/>
			<h>	
				<?php 
					include("Department_Chart.php");
				?>
			</h>
			
		<h3>Summary of Technicians</h3>
			<table class="paginate sortable full" style="width:800px" border="1">
				<tbody>
					<th>Name of Technician</th>
					<th>All</th>
					<?php
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							echo '<th>'.$FetchStatus['name'].'</th>';
						}
					?>
				</tbody>
				<?php
					$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
					$TotalAdminAll = $TotalAdminOpen = $TotalAdminInProgress = $TotalAdminInProcess = $TotalAdminOnHold = $TotalAdminResolved = $TotalAdminReopen = $TotalAdminClosed = 0;
					if($_SESSION['roleid'] == '5')
					{
						$SelectGroup = Reports_Technician();
						$Tech = array();
						while($FetchGroup = mysqli_fetch_array($SelectGroup))
						{
							$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($FetchGroup['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
							if($Reports_By_Technician['total'])
							{
								echo '<tr><td align="center">'.$FetchGroup['firstname'].'</td><td align="center">'.$Reports_By_Technician['total'].'</td>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
								$Reports_By_Technician_And_Status = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$FetchStatus['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
									echo '<td align="center">'.$Reports_By_Technician_And_Status['total'].'</td>';
									if($FetchStatus['id']==1)
										$TotalOpen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==2)
										$TotalInProgress += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==3)
										$TotalInProcess += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==4)
										$TotalOnHold += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==5)
										$TotalResolved += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==6)
										$TotalReopen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==7)
										$TotalClosed += $Reports_By_Technician_And_Status['total'];
								}
								echo '</tr>';
							}
							$TotalAll += $Reports_By_Technician['total'];
						}
					}
					else if($_SESSION['roleid'] == '1')
					{
						$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') or userroleid=1 order by firstname asc");
						while($TechnicianName = mysqli_fetch_array($SelectTechnician))
						{
							$Reports_By_Technician_foradmin = mysqli_fetch_array(Reports_By_Technician_With_Dates($TechnicianName['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
							if($Reports_By_Technician_foradmin['total'])
							{
								echo '<tr><td align="center">'.$TechnicianName['firstname'].'</td><td align="center">'.$Reports_By_Technician_foradmin['total'].'</td>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									$Reports_By_Technician_And_Status = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$FetchStatus['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
									echo '<td align="center">'.$Reports_By_Technician_And_Status['total'].'</td>';
									if($FetchStatus['id']==1)
										$TotalOpen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==2)
										$TotalInProgress += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==3)
										$TotalInProcess += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==4)
										$TotalOnHold += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==5)
										$TotalResolved += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==6)
										$TotalReopen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==7)
										$TotalClosed += $Reports_By_Technician_And_Status['total'];
								}
								$TechnicianNames[] = $ExplodeTechnician;
								$TotalAll += $Reports_By_Technician_foradmin['total'];
							}	
						}
					}
					echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalAll+$TotalAdminAll).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalOpen+$TotalAdminOpen).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalInProgress+$TotalAdminInProgress).'</strong>
					</td><td style="background:YELLOW;" align="center"><strong>'.($TotalInProcess+$TotalAdminInProcess).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalOnHold+$TotalAdminOnHold).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalResolved+$TotalAdminResolved).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalReopen+$TotalAdminReopen).'</strong></td>
					<td style="background:YELLOW;" align="center"><strong>'.($TotalClosed+$TotalAdminClosed).'</strong></td></tr>';
				 ?>
			</table><br />
			<h>	
				<?php 
					include("Technician_Chart.php");
					//if(isset($_GET['export']))
						//echo "<img src='Technician.png' />";
				?>
			</h>
			<br/>
		<h3>Summary of Zones</h3>
			<table class="paginate sortable full" style="width:800px" border="1">
				<tbody>
					<th>Name of Zone</th>
					<th>All</th>
					<?php
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							echo '<th>'.$FetchStatus['name'].'</th>';
						}
					?>
				</tbody>
				<?php
				$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
				$SelectZone = Reports_Zones();
				while($FetchZone = mysqli_fetch_array($SelectZone))
				{
					$Reports_By_Zone = mysqli_fetch_array(Reports_By_Zone_With_Dates($FetchZone['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
					if($Reports_By_Zone['total'])
					{
						echo '<tr><td align="center">'.$FetchZone['name'].'</td><td align="center">'.$Reports_By_Zone['total'].'</td>';
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							$Reports_By_Zone_And_Status = mysqli_fetch_array(Reports_By_Zone_And_Status_With_Dates($FetchZone['id'],$FetchStatus['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
							echo '<td align="center">'.$Reports_By_Zone_And_Status['total'].'</td>';
							if($FetchStatus['id']==1)
								$TotalOpen += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==2)
								$TotalInProgress += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==3)
								$TotalInProcess += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==4)
								$TotalOnHold += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==5)
								$TotalResolved += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==6)
								$TotalReopen += $Reports_By_Zone_And_Status['total'];
							else if($FetchStatus['id']==7)
								$TotalClosed += $Reports_By_Zone_And_Status['total'];
						}
						echo '</tr>';
					}
					$TotalAll += $Reports_By_Zone['total'];
				}
				echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalAll.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOpen.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProgress.'</strong>
					</td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProcess.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOnHold.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalResolved.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalReopen.'</strong></td>
					<td style="background:YELLOW;" align="center"><strong>'.$TotalClosed.'</strong></td></tr>';
				?>
			</table>
			<br />
			<h>	
				<?php 
					include("Zone_Chart.php");
				?>
			</h>
			<br/>
			
			<h>
				<?php
					include("ResolvedTechnician.php");
				?>
			</h>
	<?php
		}
	}
	else if($_GET['subpage'] == "Priority Summary")
	{ ?>
		<h3>Summary of Priorities</h3>
			<table class="paginate sortable full" style="width:800px" border="1">
				<tbody>
					<th>Priority</th>
					<th>All</th>
					<?php
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							echo '<th>'.$FetchStatus['name'].'</th>';
						}
					?>
				</tbody>
				<?php
				$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
				$Priority = mysqli_query($_SESSION['connection'],"SELECT * FROM priority order by id asc");
				while($Priorityname = mysqli_fetch_array($Priority))
				{
					$Reports_By_Priority = mysqli_fetch_array(Reports_By_Priority_With_Dates($Priorityname['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
					if($Reports_By_Priority['total'])
					{
						echo '<tr><td align="center">'.$Priorityname['name'].'</td><td align="center">'.$Reports_By_Priority['total'].'</td>';
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							$Reports_By_Priority_And_Status = mysqli_fetch_array(Reports_By_Priority_And_Status_With_Dates($Priorityname['id'],$FetchStatus['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
							echo '<td align="center">'.$Reports_By_Priority_And_Status['total'].'</td>';
							if($FetchStatus['id']==1)
								$TotalOpen += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==2)
								$TotalInProgress += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==3)
								$TotalInProcess += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==4)
								$TotalOnHold += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==5)
								$TotalResolved += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==6)
								$TotalReopen += $Reports_By_Priority_And_Status['total'];
							else if($FetchStatus['id']==7)
								$TotalClosed += $Reports_By_Priority_And_Status['total'];
						}
						echo '</tr>';
					}
					$TotalAll += $Reports_By_Priority['total'];
				}
				echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalAll.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOpen.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProgress.'</strong>
					</td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProcess.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOnHold.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalResolved.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalReopen.'</strong></td>
					<td style="background:YELLOW;" align="center"><strong>'.$TotalClosed.'</strong></td></tr>';
				?>
			</table>
			<br />
<?php	}
	else if($_GET['subpage'] == "Priority Details")
	{
		
		if(isset($_POST['Search']))
			$SelectTickets = Report_Priority();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Departmentwise Reports</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;"><table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Department</th>
						<th>Priority</th>
						<th>Ticket No</th>
						<th>Description</th>
						<th>Sub-Department</th>
						<th>Technician</th>
						<th>Status</th>
						<th>Complaint-Date</th>
						<th>Resolved-Date</th>
						<th style="width:100px">Duration</th>
						<th>Amount</th>
						<th>Remarks</th>
					</tr>
				</thead>';
				$Dept = "";
				while($FetchTicket = mysqli_fetch_array($SelectTickets))
				{
					$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
					$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
					$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
					$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
					$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
					$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
					$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
					$Amount = 0;
					while($AmountFetch = mysqli_fetch_array($AmountSelect))
					{
						$Amount += $AmountFetch['amount'];
					}
					echo '<tr><td>';					
						if($Department['name'] != $Dept)
							echo $Dept = $Department['name'];
						echo'</td>
						<td style="width:100px" align="center">'.$Priority['name'].'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td style="width:350px" >'.$FetchTicket['description'].'</td>';
						echo '<td align="center">'.$SubGroup['name'].'</td>
						<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>
						<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
						if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
						{
							echo '<td align="center">-</td>';
							echo '<td align="center" style="width:100px">0d 0h:0m</td>';
						}
						else
						{						
							echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
							$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
							$days    = floor($seconds / 86400);
							$hours   = floor(($seconds - ($days * 86400)) / 3600);
							$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
							echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
						}
						echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
					echo '</tr>';
				}
			echo '</table></div>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
		
		
	}
	else if($_GET['subpage'] == "Call Slip")
	{
		if($_GET['Month'] && $_GET['Year'])
			$SelectTickets = Reports_All_Month_And_Year($_GET['Month'],$_GET['Year']);
		if(mysqli_num_rows($SelectTickets))
		{
			$Months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
			echo '<center><h3>Call Slip Details for the Month of '.$Months[$_GET['Month']-1].' - '.$_GET['Year'].'</h3></center><br/>
			<div style="width:1200px;height:600px;overflow-x:scroll;overflow-y:auto;">
			<table class="paginate sortable" border="1" style="width:1550px">
				<thead>
						<tr>
							<th>Slno</th>
							<th>Ticket No</th>
							<th>Sub-Department</th>
							<th>Date</th>
							<th>Department/Created By</th>
							<th>Description</th>
							<th>Time</th>
							<th>Date And Time of Completion</th>
							<th>Person Handled</th>
							<th>Status</th>	
							<th>Skill Of Staff</th>
							<th>Standard of Repair</th>
							<th>Courtesy</th>
							<th>Timelines</th>
							<th>Remarks</th>
						</tr>
					</thead>';
				$i = 1;
				while($FetchTicket = mysqli_fetch_array($SelectTickets))
				{
					$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
					$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
					$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
					$CreatedUser = mysqli_fetch_array(Report_User($FetchTicket['createdby']));
					$RemarksFetch = mysqli_fetch_array(Reports_Fetch_Remarks($FetchTicket['id']));
					$Remarks = array($RemarksFetch['skill'],$RemarksFetch['standard'],$RemarksFetch['courtesy'],$RemarksFetch['timeliness']);
					$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
					$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
					$CreateDate = explode(' ',$FetchTicket['createdat']);
					$UpdateDate = explode(' ',$FetchTicket['updatedat']);
					$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
					echo '<tr><td>'.$i.'</td>
					<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
					<td>'.$SubGroup['name'].'</td>
					<td  align="center">'.$FetchTicket['createdat'].'</td>
					<td  align="center">'.$Department['name'].'/'.$CreatedUser['firstname'].'</td>
					<td >'.$FetchTicket['description'].'</td>';
					echo '<td align="center" >'.$CreateDate[1].'</td>';
					if($FetchTicket['statusid'] == '7')
						echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
					else
						echo '<td align="center"></td>';
					echo '<td align="center">'.$FetchTechnicians['firstname'].'</td>
					<td align="center">'.$Status['name'].'</td>';
					foreach($Remarks as $Remark)
					{
						$RemarksSkill = mysqli_fetch_array(Reports_Fetch_Remark_By_Type($Remark));
						echo '<td align="center">'.$RemarksSkill['name'].'</td>';
					}
					if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
						echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
					else
						echo '<td></td>';
					echo '</tr>';
					$i++;
				}
			echo '</table></div><br/>';
		}
		echo '<h3>Call Slip</h3><a href="" title="Download" onclick=\'ExportCallSlip("getdata=callslip")\'><img src="images/icons/download.png"></a>
			<table class="paginate sortable" border="1">
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
						<th>Completed After 30 Days</th>
						<th>Pending</th>
					</tr>
				</thead>';
				if(!$_GET['Month'])
				{
					$_GET['Month']=7;
					$Months = Array(date('F', strtotime(''.($_GET['Month']-7).' month')),date('F', strtotime(''.($_GET['Month']-8).' month')),date('F', strtotime(''.($_GET['Month']-9).' month')));
					$i = 0;
					$AllTickets = $Hour12 = $Hour24 = $Day7 = $Day15 = $Day30 = $After30 = $Pending = array();
					//foreach($Months as $Month)
					for($i = 0; $i < count($Months); $i++)
					{
						echo '<tr><td>'.($i+1).'</td><td>'.$Months[$i].'</td>
						<td>'.($AllTickets[] = KPI_CallSplip_CurrentMonth(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Hour12[] = KPI_CallSplip_CurrentMonth_12Hours(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Hour24[] = KPI_CallSplip_CurrentMonth_24Hours(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Day7[] = KPI_CallSplip_CurrentMonth_7Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Day15[] = KPI_CallSplip_CurrentMonth_15Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Day30[] = KPI_CallSplip_CurrentMonth_30Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($After30[] = KPI_CallSplip_CurrentMonth_After30Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						<td align="center">'.($Pending[] = KPI_CallSplip_Pending(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())))).'</td>
						</tr>';
					}
				}
				else 
				{
					//echo $_GET['Year'];
					$Months = Array(date('F', strtotime(''.($_GET['Month']).' month')),date('F', strtotime(''.($_GET['Month']-1).' month')),date('F', strtotime(''.($_GET['Month']-2).' month')));
					$i = 0;
					$AllTickets = $Hour12 = $Hour24 = $Day7 = $Day15 = $Day30 = $After30 = $Pending = array();
					//foreach($Months as $Month)
					for($i = 0; $i < count($Months); $i++)
					{
						echo '<tr><td>'.($i+1).'</td><td>'.$Months[$i].'</td>
						<td>'.($AllTickets[] = KPI_CallSplip_CurrentMonth(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Hour12[] = KPI_CallSplip_CurrentMonth_12Hours(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Hour24[] = KPI_CallSplip_CurrentMonth_24Hours(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Day7[] = KPI_CallSplip_CurrentMonth_7Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Day15[] = KPI_CallSplip_CurrentMonth_15Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Day30[] = KPI_CallSplip_CurrentMonth_30Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($After30[] = KPI_CallSplip_CurrentMonth_After30Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						<td align="center">'.($Pending[] = KPI_CallSplip_Pending(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())))).'</td>
						</tr>';
					}
				}
			echo '</table><br/>';
			echo '<h3>Call Slip in Percentage</h3><table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Month</th>
						<th>No.Of.Slips</th>
						<th>On time</th>
						<th>Completed In 24 hrs</th>
						<th>Completed With In 7 Days</th>
						<th>Completed With In 15 Days</th>
						<th>Completed With In 30 Days</th>
						<th>Completed After 30 Days</th>
						<th>Pending</th>
					</tr>
				</thead>';
				for($i = 0; $i < count($AllTickets); $i++)
				{
					$TotalTickets = $AllTickets[$i];
					if(!$AllTickets[$i])
						$AllTickets[$i] = 1;
					echo '<tr>
					<td>'.($i+1).'</td><td>'.$Months[$i].'</td>
					<td>'.$TotalTickets.'</td>
					<td align="center">'.round((($Hour12[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Hour24[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day7[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day15[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($Day30[$i]/$AllTickets[$i])*100),2).'%</td>
					<td align="center">'.round((($After30[$i]/$AllTickets[$i])*100),2).'%</td>
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
			$j = 1;
			while($FetchReason = mysqli_fetch_array($SelectReason))
			{
				echo '<tr><td>'.($i+1).'</td>
						<td>'.$FetchReason['name'].'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of '.($_GET['Month']-7).' month', time())),date('Y-m-d', strtotime('last day of '.($_GET['Month']-7).' month', time())),$FetchReason['id']).'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of '.($_GET['Month']-8).' month', time())),date('Y-m-d', strtotime('last day of '.($_GET['Month']-8).' month', time())),$FetchReason['id']).'</td>
							<td>'.Reports_Reason_Count(date('Y-m-d', strtotime('first day of '.($_GET['Month']-9).' month', time())),date('Y-m-d', strtotime('last day of '.($_GET['Month']-9).' month', time())),$FetchReason['id']).'</td>
						</tr>';
				$i++;
			}
			echo '</table><br/><h3>Call Slips Chart</h3>';
			include("Reports_Chart.php");
			echo '<br/><br/>';
	}
	else if($_GET['subpage'] == "Delayed Call Slip")
	{
		if($_GET['Month'] && $_GET['Year'] && $_GET['Month']!=0)
		{
			$Months = explode(' ',$_GET['Month']);
			$TotalMonths = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
			echo '<center><h3>Delayed Call Slip Details for the Month of ';
			
			$All ="";
			foreach($Months as $Month)
			{
				if($All && $Month)
					$All .= ", ".$TotalMonths[$Month-1];
				else
					$All .= $TotalMonths[$Month-1];
			}
			echo $All;
			echo ' - '.$_GET['Year'].'</h3></center><br/>';
			$RowCount = 0;
				echo '<div style="width:1200px;height:800px;overflow-x:scroll;overflow-y:auto;">';
				$k = 0;
				foreach($Months as $Month) 
				{
					if(!$k)
					{
						$SelectTickets = Reports_More_Month_And_Year($Month,$_GET['Year']);
						if(mysqli_num_rows($SelectTickets))
						{
							echo '<table class="paginate sortable" border="1" style="width:1550px">
								<thead>
									<tr>
										<th>Slno</th>
										<th>Ticket No</th>
										<th>Sub-Department</th>
										<th>Date</th>
										<th>Department-Created By</th>
										<th>Description</th>
										<th>Time</th>
										<th>Person Handled</th>
										<th>Status</th>		
										<th>Remarks</th>
									</tr>
								</thead>';
							$k++;
						}
					}
				}
				if(!$k)
					echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
				$j=0;
				$k = 1;
				foreach($Months as $Month) 
				{
					$SelectTickets = Reports_More_Month_And_Year($Month,$_GET['Year']);
					if(!$j)
						$i = 1;
					else
						$i = $k;
					while($FetchTicket = mysqli_fetch_array($SelectTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
						$CreatedUser = mysqli_fetch_array(Report_User($FetchTicket['createdby']));
						$RemarksFetch = mysqli_fetch_array(Reports_Fetch_Remarks($FetchTicket['id']));
						$Remarks = array($RemarksFetch['skill'],$RemarksFetch['standard'],$RemarksFetch['courtesy'],$RemarksFetch['timeliness']);
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
						$CreateDate = explode(' ',$FetchTicket['createdat']);
						$UpdateDate = explode(' ',$FetchTicket['updatedat']);
						$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
						echo '<tr><td>'.$i.'</td>
						<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
						<td>'.$SubGroup['name'].'</td>
						<td  align="center">'.$CreateDate[0].'</td>
						<td  align="center">'.$Department['name'].'-'.$CreatedUser['firstname'].'</td>
						<td >'.$FetchTicket['description'].'</td>';
						
						echo '
						<td align="center" >'.$CreateDate[1].'</td>';
						echo '<td align="center">'.$FetchTechnicians['firstname'].'</td>
						<td align="center">'.$Status['name'].'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
						echo '</tr>';
						$i++;
						$k = $i;
						$RowCount++;
					}
					++$j;
				}
				echo '</table></div><br/>';
		}
	}
	else if($_GET['subpage'] =="KPI")
	{ 
		if($_GET['Month'])
		{
		$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
		//$SelectSubgroup = Reports_Sub_Department($SubgroupId);		
	//	if(mysqli_num_rows($SelectSubgroup))
		//{
		echo '<center><h3>KEY PERFOMANCE INDICATOR FOR  the Month of '.$months[$_GET['Month']-1].' - '.$_GET['Year'].'</h3></center>';
		?>	
		<table class="paginate sortable" border="1" >
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Section</th>
						<th>No.Of.Slips</th>
						<th>On time</th>
						<th>Completed In 24 hrs</th>
						<th>Completed With In 7 Days</th>
						<th>Completed With In 15 Days</th>
						<th>Completed With In 30 Days</th>
						<th style="width:100px">Pending</th>
					</tr>
				</thead>
		<?php	
		
		$i=0;
		//echo "Select * From complaint where subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' ORDER BY id,createdat DESC";
		$AllTickets = 0;
		$AllTickets_12Hours = 0;
		$AllTickets_1Day = 0;
		$AllTickets_7Days = 0;
		$AllTickets_15Days = 0;
		$AllTickets_30Days = 0;
		$AllTickets_Pending = 0;
		//reach($_SESSION['groupids'] as $SubgroupId)
		//{
			$SelectSubgroup = Reports_SubDepartment_WeeklyReport();
			while($Subgroup  = mysqli_fetch_array($SelectSubgroup))
			{
				echo "<tr>
					<td>".++$i."</td>
					<td align='center'>".$Subgroup['name']."</td>
					<td align='center'>".Kpi_Tickets($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_12Hours($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_1Day($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_7Days($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_15Days($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_30Days($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>
					<td align='center'>".Kpi_Tickets_Pending($Subgroup['id'],$_GET['Month'],$_GET['Year'])."</td>";
				echo "</tr>";
				$AllTickets += Kpi_Tickets($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_12Hours += Kpi_Tickets_12Hours($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_1Day += Kpi_Tickets_1Day($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_7Days += Kpi_Tickets_7Days($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_15Days += Kpi_Tickets_15Days($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_30Days += Kpi_Tickets_30Days($Subgroup['id'],$_GET['Month'],$_GET['Year']);
				$AllTickets_Pending += Kpi_Tickets_Pending($Subgroup['id'],$_GET['Month'],$_GET['Year']);
			}
	//	}		
		?>
			<tr>
				<td><th>Total Complaint Repair calls</th></td>
				<th><?php echo $AllTickets; ?></th>
				<th><?php echo $AllTickets_12Hours; ?></th>
				<th><?php echo $AllTickets_1Day; ?></th>
				<th><?php echo $AllTickets_7Days; ?></th>
				<th><?php echo $AllTickets_15Days; ?></th>
				<th><?php echo $AllTickets_30Days; ?></th>
				<th><?php echo $AllTickets_Pending; ?></th>				
			</tr>
		</table>
	<?php
		}
	}
	else if($_GET['subpage'] == "All")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_All();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Reports of All Department,Zone,Technician</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;">
			<table class="paginate sortable" border="1">
					<thead>
						<tr>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Sub-Department</th>
							<th>Technician</th>
							<th>Status</th>
							<th>Zone</th>
							<th>Complaint-Date</th>
							<th>Resolved-Date</th>
							<th>Duration</th>
							<th>Amount</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					while($FetchTicket = mysqli_fetch_array($SelectTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
						$FetchZone = mysqli_fetch_array(Reports_Zones_By_Id($FetchTicket['zoneid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
						$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
						$Amount = 0;
						$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
						while($AmountFetch = mysqli_fetch_array($AmountSelect))
						{
							$Amount += $AmountFetch['amount'];
						}
						echo '<tr>
							<td style="width:100px" align="center">'.$Priority['name'].'</td>
							<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
							<td style="width:300px" >'.$FetchTicket['description'].'</td>';
						echo '
							<td>'.$Department['name'].'</td>
							<td>'.$SubGroup['name'].'</td>
							<td align="center">'.$FetchTechnicians['firstname'].'</td>
							<td align="center">'.$Status['name'].'</td>
							<td align="center">'.$FetchZone['name'].'</td>
							<td align="center" style="width:130px">'.$FetchTicket['createdat'].'</td>';
							if($FetchTicket['createdat'] == $FetchTicket['updatedat'])
							{
								echo '<td align="center">-</td>';
								echo '<td align="center" style="width:100px">0d 0h:0m</td>';
							}
							else
							{
								echo '<td align="center">'.$FetchTicket['updatedat'].'</td>';
								$seconds = strtotime($FetchTicket['updatedat']) - strtotime($FetchTicket['createdat']);
								$days    = floor($seconds / 86400);
								$hours   = floor(($seconds - ($days * 86400)) / 3600);
								$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
								echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
							}
							echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
						echo '</tr>';
					}
			echo '</table></div><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
		else if($_GET['subpage'] == 'Unresolved')
		{
			if(isset($_POST['Search']))
				$SelectUnresolvedTickets = Report_SubDepartment_Unresolved();
			if(mysqli_num_rows($SelectUnresolvedTickets))
			{
				echo '<center><h3>UnResolved Tickets Reports-'.mysqli_num_rows($SelectUnresolvedTickets).'</h3></center>
				<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;"><table class="paginate sortable" border="1">
					<thead>
						<tr>
							<th>Sub-Department</th>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Technician</th>
							<th>Status</th>
							<th>Complaint-Date</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					$SubDept = "";
					
					while($FetchTicketUnresolved = mysqli_fetch_array($SelectUnresolvedTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicketUnresolved['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicketUnresolved['departmentid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicketUnresolved['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicketUnresolved['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicketUnresolved['statusid']));
						$FetchUnresolvedAudit = mysqli_fetch_array(Reports_Audit($FetchTicketUnresolved['id']));
						echo '<tr><td>';					
							if($SubGroup['name'] != $SubDept)
								echo $SubDept = $SubGroup['name'];
							echo'</td>
							<td style="width:100px" >'.$Priority['name'].'</td>
							<td style="width:100px" ><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicketUnresolved['ticketno'].'&ComplaintId='.$FetchTicketUnresolved['id'].'">'.$FetchTicketUnresolved['ticketno'].'</a></td>
							<td style="width:350px" >'.$FetchTicketUnresolved['description'].'</td>';
							echo '<td>'.$Department['name'].'</td>
							<td>'.$FetchTechnicians['firstname'].'</td>
							<td>'.$Status['name'].'</td>
							<td>'.$FetchTicketUnresolved['createdat'].'</td>';
							if(mysqli_num_rows(Reports_Audit($FetchTicketUnresolved['id'])) > 1)
								echo '<td style="width:350px" >'.$FetchUnresolvedAudit['comments'].'</td>';
							else
								echo '<td></td>';
						echo '</tr>';
					}
				echo '</table></div><br/>';
			}
			else if(isset($_POST['Search']))
				echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
		}
		else if($_GET['subpage'] == 'Weekly Reports')
		{
			if(isset($_POST['Search']))
			 {
			 ?>
				<br/>
				<h3>Summary of Sub-Departments</h3>
				<table class="paginate sortable full" style="width:800px" border="1">
					<tbody>
						<th>Name of Sub-Departments</th>
						<th>All</th>
						<?php
							$SelectStatus = Reports_Statuses();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								echo '<th>'.$FetchStatus['name'].'</th>';
							}
						?>
					</tbody>
					<?php
					$SelectSubDepartment = Reports_SubDepartment_WeeklyReport();
					$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
					while($FetchSubDepartment = mysqli_fetch_array($SelectSubDepartment))
					{
						$Reports_By_SubDepartment_With_Date = mysqli_fetch_array(Reports_By_SubDepartment_With_Dates($FetchSubDepartment['id'],$_POST['complaintdate'],$_POST['resolveddate']));
						echo '<tr><td align="center">'.$FetchSubDepartment['name'].'</td><td align="center">'.$Reports_By_SubDepartment_With_Date['total'].'</td>';	
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							$Reports_By_SubDepartment = mysqli_fetch_array(Reports_By_SubDepartment_And_Status_With_Dates($FetchSubDepartment['id'],$FetchStatus['id'],$_POST['complaintdate'],$_POST['resolveddate']));
							echo '<td align="center">'.$Reports_By_SubDepartment['total'].'</td>';
							if($FetchStatus['id']==1)
								$TotalOpen += $Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==2)
								$TotalInProgress += $Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==3)
								$TotalInProcess += $Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==4)
								$TotalOnHold += $Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==5)
								$TotalResolved +=$Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==6)
								$TotalReopen += $Reports_By_SubDepartment['total'];
							else if($FetchStatus['id']==7)
								$TotalClosed += $Reports_By_SubDepartment['total'];
						}
						echo '</tr>';
						$TotalAll += $Reports_By_SubDepartment_With_Date['total'];	
					}
					echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalAll.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOpen.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProgress.'</strong>
						</td><td style="background:YELLOW;" align="center"><strong>'.$TotalInProcess.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalOnHold.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalResolved.'</strong></td><td style="background:YELLOW;" align="center"><strong>'.$TotalReopen.'</strong></td>
						<td style="background:YELLOW;" align="center"><strong>'.$TotalClosed.'</strong></td></tr>';
					?>
				</table>
				<br/><br/>
				<h3>Summary of Technicians</h3>
			<table class="paginate sortable full" style="width:800px" border="1">
				<tbody>
					<th>Name of Technician</th>
					<th>All</th>
					<?php
						$SelectStatus = Reports_Statuses();
						while($FetchStatus = mysqli_fetch_array($SelectStatus))
						{
							echo '<th>'.$FetchStatus['name'].'</th>';
						}
					?>
				</tbody>
				<?php
					$TotalAll = $TotalOpen = $TotalInProgress = $TotalInProcess = $TotalOnHold = $TotalResolved = $TotalReopen = $TotalClosed = 0;
					$TotalAdminAll = $TotalAdminOpen = $TotalAdminInProgress = $TotalAdminInProcess = $TotalAdminOnHold = $TotalAdminResolved = $TotalAdminReopen = $TotalAdminClosed = 0;
					if($_SESSION['roleid'] == '5')
					{
						$SelectGroup = Reports_Technician();
						$Tech = array();
						while($FetchGroup = mysqli_fetch_array($SelectGroup))
						{
							$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($FetchGroup['id'],$_POST['complaintdate'],$_POST['resolveddate']));
							if($Reports_By_Technician['total'])
							{
								echo '<tr><td align="center">'.$FetchGroup['firstname'].'</td><td align="center">'.$Reports_By_Technician['total'].'</td>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									$Reports_By_Technician_And_Status = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$FetchStatus['id'],$_POST['complaintdate'],$_POST['resolveddate']));
									echo '<td align="center">'.$Reports_By_Technician_And_Status['total'].'</td>';
									if($FetchStatus['id']==1)
										$TotalOpen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==2)
										$TotalInProgress += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==3)
										$TotalInProcess += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==4)
										$TotalOnHold += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==5)
										$TotalResolved += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==6)
										$TotalReopen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==7)
										$TotalClosed += $Reports_By_Technician_And_Status['total'];
								}
								echo '</tr>';
							}
							$TotalAll += $Reports_By_Technician['total'];
						}
					}
					else if($_SESSION['roleid'] == '1')
					{
						$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') or userroleid=1 order by firstname asc");
						while($TechnicianName = mysqli_fetch_array($SelectTechnician))
						{
							$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($TechnicianName['id'],$_POST['complaintdate'],$_POST['resolveddate']));
							if($Reports_By_Technician['total'])
							{
								echo '<tr><td align="center">'.$TechnicianName['firstname'].'</td><td align="center">'.$Reports_By_Technician['total'].'</td>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									$Reports_By_Technician_And_Status = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$FetchStatus['id'],$_POST['complaintdate'],$_POST['resolveddate']));
									echo '<td align="center">'.$Reports_By_Technician_And_Status['total'].'</td>';
									if($FetchStatus['id']==1)
										$TotalOpen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==2)
										$TotalInProgress += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==3)
										$TotalInProcess += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==4)
										$TotalOnHold += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==5)
										$TotalResolved += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==6)
										$TotalReopen += $Reports_By_Technician_And_Status['total'];
									else if($FetchStatus['id']==7)
										$TotalClosed += $Reports_By_Technician_And_Status['total'];
								}
								$TechnicianNames[] = $ExplodeTechnician;
							}	
							$TotalAll += $Reports_By_Technician['total'];
						}
					}
					echo '<tr><td style="background:YELLOW;" align="center"><strong>Total</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalAll+$TotalAdminAll).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalOpen+$TotalAdminOpen).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalInProgress+$TotalAdminInProgress).'</strong>
					</td><td style="background:YELLOW;" align="center"><strong>'.($TotalInProcess+$TotalAdminInProcess).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalOnHold+$TotalAdminOnHold).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalResolved+$TotalAdminResolved).'</strong></td><td style="background:YELLOW;" align="center"><strong>'.($TotalReopen+$TotalAdminReopen).'</strong></td>
					<td style="background:YELLOW;" align="center"><strong>'.($TotalClosed+$TotalAdminClosed).'</strong></td></tr>';
				 ?>
			</table><br />
			<?php 
			}
			if(isset($_POST['Search']))
				$SelectWeeklyReportTickets = Report_SubDepartment_WeeklyReportQueries();
			if(mysqli_num_rows(Report_SubDepartment_WeeklyReportQueries()))
			{
				echo '<center><h3>Weekly Reports-'.mysqli_num_rows(Report_SubDepartment_WeeklyReportQueries()).'</h3></center>
				<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;"><table class="paginate sortable" border="1">
					<thead>
						<tr>
							<th>Sub-Department</th>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Technician</th>
							<th>Status</th>
							<th>Complaint-Date</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					$SubDept = "";
					
					while($FetchWeeklyReportTickets = mysqli_fetch_array($SelectWeeklyReportTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchWeeklyReportTickets['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchWeeklyReportTickets['departmentid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchWeeklyReportTickets['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchWeeklyReportTickets['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchWeeklyReportTickets['statusid']));
						$FetchUnresolvedAudit = mysqli_fetch_array(Reports_Audit($FetchWeeklyReportTickets['id']));
						echo '<tr><td>';					
							if($SubGroup['name'] != $SubDept)
								echo $SubDept = $SubGroup['name'];
							echo'</td>
							<td style="width:100px" >'.$Priority['name'].'</td>
							<td style="width:100px" ><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchWeeklyReportTickets['ticketno'].'&ComplaintId='.$FetchWeeklyReportTickets['id'].'">'.$FetchWeeklyReportTickets['ticketno'].'</a></td>
							<td style="width:350px" >'.$FetchWeeklyReportTickets['description'].'</td>';
							echo '<td>'.$Department['name'].'</td>
							<td>'.$FetchTechnicians['firstname'].'</td>
							<td>'.$Status['name'].'</td>
							<td>'.$FetchWeeklyReportTickets['createdat'].'</td>';
							if(mysqli_num_rows(Reports_Audit($FetchWeeklyReportTickets['id'])) > 1)
								echo '<td style="width:350px" >'.$FetchUnresolvedAudit['comments'].'</td>';
							else
								echo '<td></td>';
						echo '</tr>';
					}
				echo '</table></div><br/>';
			}
				else if(isset($_POST['Search']))
					echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
		}
	else if( $_GET['subpage']=='AMC Period')
	{
		if($_GET['subpage']=='AMC Period' && $_GET['Month'] && $_GET['Year'])
			$Asset_Status = Amc_Period_Report(date("Y-m-t", strtotime($_GET['Year']."-".$_GET['Month']."-01")));
		if(mysqli_num_rows($Asset_Status))
		{
			//if($Assets = mysqli_fetch_assoc($Asset_Status))
			//{
				$Diff = explode(' ',$Assets['amcperiod']);
				if(($_GET['subpage']=='AMC Period' || $Assets['monthdiff'] >= $Diff[0]))
				{
					echo '<h3><center>AMC Period Reports</center></h3>';
					echo '<table class="paginate sortable full" border="1">
						<thead>
							<tr>
								<th width="70px" align="center">S.NO.</th>
								<th align="left">Division Name</th>
								<th align="left">Department Name</th>
								<th align="left">Location Name</th>
								<th align="left">Item</th>
								<th align="left">Item Name</th>
								<th align="left">Item Description</th>
								<th align="left">Connection Type</th>
								<th align="left">Purchased Date</th>
								<th align="left">Warranty Date</th>
								<th  align="left">Amc Period</th>
								<th align="left">Condemned</th>
							</tr>
						</thead>
						<tbody>';
				}
			//}
			$Connetciontype = array("none","Standby","Network");
			$Option = array("No", "Yes");
			$i = 1;
			while($Assets = mysqli_fetch_assoc($Asset_Status))
			{
				$Diff = explode(' ',$Assets['amcperiod']);
				//if(($_GET['subpage']=='AMC Period' && $Assets['monthdiff'] >= $Diff[0]))
				//{
					$Asset_Name = mysqli_fetch_array(Asset_Division_BYId($Assets['divisionid']));
					$Assets_Department = mysqli_fetch_array(Assets_DepartmentById($Assets['departmentid']));
					$Assets_Location = mysqli_fetch_array(Assets_LocationById($Assets['locationid']));
					$Assets_item = mysqli_fetch_array(Assets_itemById($Assets['itemid']));
					echo "<tr>
					<td align='center'>".$i++."</td>
					<td>".$Asset_Name['name']."</td>
					<td>".$Assets_Department['name']."</td>
					<td>".$Assets_Location['name']."</td>
					<td>".$Assets_item['name']."</td>
					<td>".$Assets['itemname']."</td>
					<td>".$Assets['itemdescription']."</td>
					<td>".$Connetciontype[$Assets['connectiontype']]."</td>
					<td>".date('d-m-Y',strtotime($Assets['purchasedat']))."</td>
					<td>".date('d-m-Y',strtotime($Assets['warrantydate']))."</td>
					<td>".$Assets['amcperiod']."</td>
					<td>".$Option[$Assets['condemned']]."</td>
					</tr>";
				//}
			}
			echo '</tbody>
			</table>';
		}		
	}
	else if($_GET['subpage']=='Assets')
	{	
		if($_GET['subpage']=='Assets' && $_POST['submit'])
			$Asset_Status = Assets_Status_By_Id();
		if(mysqli_num_rows($Asset_Status))
		{
			echo '<h3><center>Assets Reports</center></h3>';
				echo '<table class="paginate sortable full" border="1">
					<thead>
						<tr>
							<th width="70px" align="center">S.NO.</th>
							<th align="left">Division Name</th>
							<th align="left">Department Name</th>
							<th align="left">Location Name</th>
							<th align="left">Item</th>
							<th align="left">Item Name</th>
							<th align="left">Item Description</th>
							<th align="left">Connection Type</th>
							<th align="left">Purchased Date</th>
							<th align="left">Warranty Date</th>
							<th  align="left">Amc Period</th>
							<th align="left">Condemned</th>
						</tr>
					</thead>
					<tbody>';	
					
				$Connetciontype = array("none","Standby","Network");
				$Option = array("No", "Yes");
				$i = 1;
				while($Assets = mysqli_fetch_assoc($Asset_Status))
				{
					$Asset_Name = mysqli_fetch_array(Asset_Division_BYId($Assets['divisionid']));
					$Assets_Department = mysqli_fetch_array(Assets_DepartmentById($Assets['departmentid']));
					$Assets_Location = mysqli_fetch_array(Assets_LocationById($Assets['locationid']));
					$Assets_item = mysqli_fetch_array(Assets_itemById($Assets['itemid']));
					echo "<tr>
					<td align='center'>".$i++."</td>
					<td>".$Asset_Name['name']."</td>
					<td>".$Assets_Department['name']."</td>
					<td>".$Assets_Location['name']."</td>
					<td>".$Assets_item['name']."</td>
					<td>".$Assets['itemname']."</td>
					<td>".$Assets['itemdescription']."</td>
					<td>".$Connetciontype[$Assets['connectiontype']]."</td>
					<td>".date('d-m-Y',strtotime($Assets['purchasedat']))."</td>
					<td>".date('d-m-Y',strtotime($Assets['warrantydate']))."</td>
					<td>".$Assets['amcperiod']."</td>
					<td>".$Option[$Assets['condemned']]."</td>
					</tr>";
				}
			echo '</tbody>
			</table>';
		}
		else if($_POST['submit'])
			echo '<br/><div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "Biomedical")
	{
		if(isset($_POST['Search']))
			$SelectTickets = Report_BiomedicalAll();
		if(mysqli_num_rows($SelectTickets))
		{
			echo '<center><h3>Reports of Biomedical Department,Equipment,Technician</h3></center>
			<div style="width:1200px;height:1200px;overflow-x:scroll;overflow-y:auto;">
			<table class="paginate sortable" border="1">
					<thead>
						<tr>
							<th>Priority</th>
							<th>Ticket No</th>
							<th>Description</th>
							<th>Department</th>
							<th>Sub-Department</th>
							<th>Technician</th>
							<th>Status</th>
							<th>Equipment</th>
							<th>Complaint-Date</th>
							<th>Resolved-Date</th>
							<th>Duration</th>
							<th>Amount</th>
							<th>Remarks</th>
						</tr>
					</thead>';
					while($FetchTicket = mysqli_fetch_array($SelectTickets))
					{
						$Priority = mysqli_fetch_array(Reports_Get_Priority($FetchTicket['priorityid']));
						$Department = mysqli_fetch_array(Reports_Get_Department($FetchTicket['departmentid']));
						$FetchEquipment = mysqli_fetch_array(Reports_Equipment_By_Id($FetchTicket['itemid']));
						$FetchTechnicians = mysqli_fetch_array(Report_User($FetchTicket['assignedto']));
						$SubGroup = mysqli_fetch_array(Reports_Sub_Group($FetchTicket['subgroupid']));
						$Status = mysqli_fetch_array(Reports_Statuses_By_Id($FetchTicket['statusid']));
						$FetchAudit = mysqli_fetch_array(Reports_Audit($FetchTicket['id']));
						$Amount = 0;
						$AmountSelect  = Reports_Fetch_Amount($FetchTicket['id']);
						while($AmountFetch = mysqli_fetch_array($AmountSelect))
						{
							$Amount += $AmountFetch['amount'];
						}
						echo '<tr>
							<td style="width:100px" align="center">'.$Priority['name'].'</td>
							<td style="width:100px" align="center"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$FetchTicket['ticketno'].'&ComplaintId='.$FetchTicket['id'].'">'.$FetchTicket['ticketno'].'</a></td>
							<td style="width:300px" >'.$FetchTicket['description'].'</td>';
						echo '
							<td>'.$Department['name'].'</td>
							<td>'.$SubGroup['name'].'</td>
							<td align="center">'.$FetchTechnicians['firstname'].'</td>
							<td align="center">'.$Status['name'].'</td>
							<td align="center">'.$FetchEquipment['equipment'].'</td>
							<td align="center" style="width:130px">'.$FetchTicket['bio_startdate'].'</td>';
							if($FetchTicket['bio_startdate'] == $FetchTicket['bio_enddate'])
							{
								echo '<td align="center">-</td>';
								echo '<td align="center" style="width:100px">0d 0h:0m</td>';
							}
							else
							{
								echo '<td align="center">'.$FetchTicket['bio_enddate'].'</td>';
								$seconds = strtotime($FetchTicket['bio_enddate']) - strtotime($FetchTicket['bio_startdate']);
								$days    = floor($seconds / 86400);
								$hours   = floor(($seconds - ($days * 86400)) / 3600);
								$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
								echo '<td align="center" style="width:100px">'.$days.'d '.$hours.':'.$minutes.'</td>';
							}
						echo '<td align="center" style="width:100px">'.$Amount.'</td>';
						if(mysqli_num_rows(Reports_Audit($FetchTicket['id'])) > 1)
							echo '<td style="width:350px" >'.$FetchAudit['comments'].'</td>';
						else
							echo '<td></td>';
						echo '</tr>';
					}
			echo '</table></div><br/>';
		}
		else if(isset($_POST['Search']))
			echo '<div class="message error"><font color="red"><center>No data found</center></font></div>';
	}
	else if($_GET['subpage'] == "BiomedicalKPI")
	{
			echo '<table class="paginate sortable" border="1" >
				<thead>
						<tr>
							<th>Slno</th>
							<th>Month</th>
							<th>Category Of Equipment</th>
							<th>Total Critical Equipments</th>
							<th>Total Working Hours</th>
							<th>Total Breakdown Hours</th>
							<th>Actual Working Hours</th>
							<th>Availability in %</th>
							<th>Non-Availability in %</th>
						</tr>
					</thead>';
				$i = 0;
				/* $num = cal_days_in_month(CAL_GREGORIAN, date("".$_GET['Month'].""), date("".$_GET['Year'].""));
				$TotalDays =  explode("-",date("".$_GET['Year']."-".$_GET['Month']."-".$num)); */
				if((!$_GET['Month']) && (!$_GET['Year']))
				{
					$_GET['Month']=7;
					$_GET['Year']=date('Y');
					$Months1 = Array(date('m', strtotime(''.($_GET['Month']-7).' month')),date('m', strtotime(''.($_GET['Month']-8).' month')),date('m', strtotime(''.($_GET['Month']-9).' month')));
					$num = cal_days_in_month(CAL_GREGORIAN, date("".($_GET['Month']).""), date("".$_GET['Year'].""));
					$TotalDays =  explode("-",date("".$_GET['Year']."-".($_GET['Month'])."-".$num));
					for($j = 0;$j<COUNT($Months1);$j++)
					{
						$FetchTicket = mysqli_fetch_array(BiomedicalKPIReports_All_Month_And_Year($Months1[$j],$_GET['Year']));
						echo '<tr><td>'.++$i.'</td>
						<td>'.date('F', strtotime(''.($Months1[$j]).' month')).'</td>
						<td>Critical Equipments</td>
						<td align="center">'.$FetchTicket['critical_equipment'].'</td>';
						$Totalworkinghours = $TotalDays[2]*24*$FetchTicket['critical_equipment'];
						echo'<td align="center">'.$Totalworkinghours.'</td>';
						$Breakdownhours = ((strtotime($FetchTicket['enddate'])-strtotime($FetchTicket['startdate']))/3600);
						echo '<td align="center">'.round(($Breakdownhours)).'</td>';
						$Actualworkinghours = $Totalworkinghours - $Breakdownhours;
						echo '<td align="center">'.round(($Actualworkinghours)).'</td>
						<td align="center">'.round((($Actualworkinghours/$Totalworkinghours)*100),2).'</td>
						<td align="center">'.round((($Breakdownhours/$Totalworkinghours)*100),2).'</td>
						</tr>';
					}
				}	
				else
				{
					$num = cal_days_in_month(CAL_GREGORIAN, date("".$_GET['Month'].""), date("".$_GET['Year'].""));
					$TotalDays =  explode("-",date("".$_GET['Year']."-".$_GET['Month']."-".$num));
					$Months1 = Array(date('m', strtotime(''.($_GET['Month']).' month')),date('m', strtotime(''.($_GET['Month']-1).' month')),date('m', strtotime(''.($_GET['Month']-2).' month')));
					foreach($Months1 as $Month)
					{
						$FetchTicket = mysqli_fetch_array(BiomedicalKPIReports_All_Month_And_Year($Month,$_GET['Year']));
						echo '<tr><td>'.++$i.'</td>
						<td>'.date('F', strtotime(''.($Month).' month')).'</td>
						<td>Critical Equipments</td>
						<td align="center">'.$FetchTicket['critical_equipment'].'</td>';
						$Totalworkinghours = $TotalDays[2]*24*$FetchTicket['critical_equipment'];
						echo'<td align="center">'.$Totalworkinghours.'</td>';
						$Breakdownhours = ((strtotime($FetchTicket['enddate'])-strtotime($FetchTicket['startdate']))/3600);
						echo '<td align="center">'.round(($Breakdownhours)).'</td>';
						$Actualworkinghours = $Totalworkinghours - $Breakdownhours;
						echo '<td align="center">'.round(($Actualworkinghours)).'</td>
						<td align="center">'.round((($Actualworkinghours/$Totalworkinghours)*100),2).'</td>
						<td align="center">'.round((($Breakdownhours/$Totalworkinghours)*100),2).'</td>
						</tr>';
					}
				}
			echo '</table><br/>';
		if($_GET['Month'] && $_GET['Year'])
			$SelectDepartmentEquipment = BiomedicalKPIReports_Department_Equipment($_GET['Month'],$_GET['Year']);
		if(mysqli_num_rows($SelectDepartmentEquipment))
		{
		echo '<h3>Reason For Non-Availability Of Critical Equipments</h3>
			<table class="paginate sortable" border="1">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Department</th>
						<th>Equipment</th>
						<th>Make</th>
						<th>Equipment Break Down Category</th>
						<th>Break Down Hours</th>
						<th>Remarks</th>
					</tr>
				</thead>';
				$i = 0;
				while($FetchDepartmentEquipmentTicket = mysqli_fetch_array($SelectDepartmentEquipment))
				{
					$Breakdownhours = ((strtotime($FetchDepartmentEquipmentTicket['enddate'])-strtotime($FetchDepartmentEquipmentTicket['startdate']))/3600);
					echo '<tr><td>'.++$i.'</td>
						<td>'.$FetchDepartmentEquipmentTicket['departmentname'].'</td>
						<td>'.$FetchDepartmentEquipmentTicket['equipment'].'</td>
						<td>'.$FetchDepartmentEquipmentTicket['make'].'</td>
						<td>'.$FetchDepartmentEquipmentTicket['breakdowncategory'].'</td>
						<td>'.round(($Breakdownhours),4).'</td>
						<td>'.$FetchDepartmentEquipmentTicket['bio_remark'].'</td>
					</tr>';
				}
			echo '</table><br/>';
		}	
		if($_GET['Month'] && $_GET['Year'])
		{
			echo '</table><br/><h3>Critical Equipments Availability and Non-Availability Monthly Status in Chart</h3>';
			include("ReportsBiomedicalMonthlyEquipment_Chart.php");
			echo '<br/><br/>';
		}	
		if($_GET['Month'] && $_GET['Year'])
		{
			echo '</table><br/><h3>Critical Equipments Availability and Non-Availability Three Months Status in Chart</h3>';
			include("ReportsBiomedicalEquipment_Chart.php");
			echo '<br/><br/>';
		}	
	}
	if(!isset($_GET['export']))
	{ ?>	
		<script>
			$(document).ready(function()
			{
				$("h").hide();
				$(".btn2").hide();
				$(".btn1").click(function()
				{
					$("h").show();
					$(".btn1").hide();
					$(".btn2").show();
				});
				$(".btn2").click(function()
				{
					$("h").hide();
					$(".btn1").show();
					$(".btn2").hide();
				}); 
			});
			function ExportCallSlip(PostBackValues)
			{
				window.open("includes/ExportData.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
			}	
		</script>
	<?php
	} ?>