<?php
	session_start();
	include("Config.php");
	include("Complaint_Status_Queries.php");
	if($_GET['SubGroupId'])
	{
		$ComplaintSelectGroup = mysqli_fetch_array(ComplaintGroup($_GET['groupid']));
		$ExplodeTicketNo = explode('-',$_GET['TicketNo']);
		$Ticketgroup = explode("-",$_GET['TicketNo']);
		if($Ticketgroup[0] == "Biomedical")
			echo '<br/><br/><label><b>Engineer:</b>';
		else	
			echo '<br/><br/><label><b>Technician:</b>';
		if($_SESSION['roleid'] != 4)
			echo '<font color="red">*</font>';
		echo '</label>
		<select name="technician" id="technician">
				<option value="Select">Select</option>';
				$SelectTechnicians = Complaint_Get_TechnicianById($_GET['SubGroupId']);
				while($FetchTechnician = mysqli_fetch_array($SelectTechnicians))
				{
					$Technicians = explode(".",$FetchTechnician['users']);
					foreach($Technicians as $Technician)
					{
						$Complaint_Technician_name = mysqli_fetch_array(Complaint_Fetch_User($Technician));
						if($_GET['assignedto'] == $Technician)
						{	
							if($Complaint_Technician_name['firstname'])
								echo "<option value='".$Technician."' selected>".$Complaint_Technician_name['firstname']."</option>";
						}
						else if($_SESSION['roleid'] == 4)
						{
							if($Complaint_Technician_name['firstname'])
								echo "<option value='".$Technician."' disabled>".$Complaint_Technician_name['firstname']."</option>";
						}
						else
						{
							if($Complaint_Technician_name['firstname'])
								echo "<option value='".$Technician."'>".$Complaint_Technician_name['firstname']."</option>";
						}
					}
				}
		echo '</select>&';
		$Complaint_Complainttype = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($_GET['SubGroupId']));
		echo '<b>Complaint Type:</b> '.$Complaint_Complainttype["complainttype"]."&";
		if(($Complaint_Complainttype["name"]=='Hardware' && $ExplodeTicketNo[0] == 'MIS'))
		{
			$FetchTicketCreatedBy = mysqli_fetch_array(ComplaintTicketCreatedBy($_GET['TicketNo']));
				$FetchUserDepartment = mysqli_fetch_array(Complaint_Get_Assigned($FetchTicketCreatedBy['createdby']));
				$SelectHardwareItems = Complaint_Select_AssetItem($FetchUserDepartment['departmentid']);
			echo '<label><b>Item Name:</b></label>
				<select name="itemname" id="itemname">
				<option value="Select">Select</option>';
				
				//if($Complaint['itemid'])
				//{
					while($FetchHardwareItems = mysqli_fetch_array($SelectHardwareItems))
					{
						if($_GET['ItemId'] == $FetchHardwareItems['id'])
							echo '<option value="'.$FetchHardwareItems['id'].'" selected>'.$FetchHardwareItems['itemname'].'</option>';
						else if($_SESSION['roleid'] == 4)
							echo "<option value='".$FetchHardwareItems['id']."' disabled>".$FetchHardwareItems['itemname']."</option>";
						else
							echo '<option value="'.$FetchHardwareItems['id'].'">'.$FetchHardwareItems['itemname'].'</option>';
					}
				//}
			echo '</select>';
		}
		else if($ExplodeTicketNo[0]=='Biomedical')
		{
			$FetchTicketCreatedBy = mysqli_fetch_array(ComplaintTicketCreatedBy($_GET['TicketNo']));
			$FetchUserDepartment = mysqli_fetch_array(Complaint_Get_Assigned($FetchTicketCreatedBy['createdby']));
			$SelectHardwareItems = Complaint_Select_BiomedicalAssetItem($FetchTicketCreatedBy['departmentid']);
			echo '<label><b>Item Name:</b></label>
				<select name="itemname" id="itemname">
				<option value="Select">Select</option>';
				
					while($FetchHardwareItems = mysqli_fetch_array($SelectHardwareItems))
					{
						if($_GET['ItemId'] == $FetchHardwareItems['id'])
							echo '<option value="'.$FetchHardwareItems['id'].'" selected>'.$FetchHardwareItems['equipment'].'</option>';
						else if($_SESSION['roleid'] == 4)
							echo "<option value='".$FetchHardwareItems['id']."' disabled>".$FetchHardwareItems['equipment']."</option>";
						else
							echo '<option value="'.$FetchHardwareItems['id'].'">'.$FetchHardwareItems['equipment'].'</option>';
					}
			echo '</select>';
		}
		else
			echo '<input id="technician" type="hidden" value="0" />';
	}	
?>