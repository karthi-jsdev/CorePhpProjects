<?php
	if(isset($_GET['exportpdf']))
	{
		session_start();
		include("Config.php");
		//ini_set("display_errors","0");
		date_default_timezone_set('Asia/Kolkata');
		include("Complaint_Status_Queries.php");
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['TicketNo'].date("d-m-Y H-i")).".xls");
		
		
		$SelectComplaint = mysqli_fetch_array(Complaint_A_Ticket($_GET['TicketNo']));
		$Source = mysqli_fetch_array(Complaint_Get_Source($SelectComplaint['sourceid']));
		$Department = mysqli_fetch_array(Complaint_Get_Department($SelectComplaint['departmentid']));
		$SelectAudit = mysqli_fetch_array(Complaint_Comments($_GET['ComplaintId']));
		$Complaint_Select_Status = mysqli_fetch_array(Complaint_Get_Status($SelectAudit['statusid']));
		$SubGroup = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($SelectComplaint['subgroupid']));
		$Complaint_Technician_name = mysqli_fetch_array(Complaint_Fetch_User($SelectComplaint['assignedto']));
		$FetchComplaintTypeId = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($SelectComplaint['complainttypeid']));
		echo '<h3>Bangalore Bapist Hospital</h3>
			<table border="3">
				<tr>
					<td>
						<b>Ticket Number:'.$_GET['TicketNo'].'</b>
					</td>
					<td>
						<b>Source of Complaint:'.$Source['name'].'</b>
					</td>
				</tr>
				<tr>
					<td>
						<b>Department:'.$Department['name'].'</b>
					</td>
					<td>
						<b>Defects:'.$SelectComplaint['description'].'</b>
					</td>
				</tr>
				<tr>
					<td>
						<b>Remarks:'.$SelectComplaint['remarks'].'</b>
					</td>
					<td>
						<b>Status:'.$Complaint_Select_Status['name'].'</b>
					</td>
				</tr>
				<tr>
					<td>
						<b>Sub-Department:'.$SubGroup['name'].'</b>
					</td>
					<td>
						<b>Technician:'.$Complaint_Technician_name['firstname'].'</b>
					</td>
				</tr>
				<tr>
					<td>
						<b>Complaint Type:'.$FetchComplaintTypeId['name'].'</b>
					</td>
				</tr>';
		echo '</table>';
	}
?>