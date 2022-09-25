<?php
	//Raise complaint
	function Source_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source ORDER BY name ASC");
	}
	function Department_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department ORDER BY name ASC");
	}
	function Zone_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone ORDER BY name ASC");
	}
	function Complaint_GetLastIdBy($group)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint WHERE ticketno LIKE '".$group."%' ORDER BY id DESC");
	}
	function Complaint_Insert($ticketno,$description,$remarks,$complainttypeid,$zoneid,$assignedto,$sourceid,$departmentid,$groupid,$priorityid,$statusid,$reasonforhold,$createdby,$createdat,$updatedby,$updatedat)
	{
		if($_POST['location'] && !$_POST['zone'])
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(ticketno,description,remarks,assignedto,sourceid,departmentid,groupid,subgroupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat,locationid) VALUES('".$ticketno."','".mysql_real_escape_string($_POST['description'])."','".mysql_real_escape_string($_POST['remarks'])."','".$assignedto."','".$_POST['source']."','".$_POST['department']."', '".$groupid."','".$_POST['subdepartment']."','3','1','null','".$_SESSION['id']."','".$createdat."','".$_SESSION['id']."','".$updatedat."','".$_POST['location']."')");
		else if($_POST['zone'] && !$_POST['location'])
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(ticketno,description,remarks,zoneid,assignedto,sourceid,departmentid,groupid,subgroupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat) VALUES('".$ticketno."','".mysql_real_escape_string($_POST['description'])."','".mysql_real_escape_string($_POST['remarks'])."','".$_POST['zone']."','".$assignedto."','".$_POST['source']."','".$_POST['department']."', '".$groupid."','".$_POST['subdepartment']."','3','1','null','".$_SESSION['id']."','".$createdat."','".$_SESSION['id']."','".$updatedat."')");
		else if(($_POST['zone']) && ($_POST['location']))
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(ticketno,description,remarks,zoneid,assignedto,sourceid,departmentid,groupid,subgroupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat,locationid) VALUES('".$ticketno."','".mysql_real_escape_string($_POST['description'])."','".mysql_real_escape_string($_POST['remarks'])."','".$_POST['zone']."','".$assignedto."','".$_POST['source']."','".$_POST['department']."', '".$groupid."','".$_POST['subdepartment']."','3','1','null','".$_SESSION['id']."','".$createdat."','".$_SESSION['id']."','".$updatedat."','".$_POST['location']."')");
		else
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(ticketno,description,remarks,assignedto,sourceid,departmentid,groupid,subgroupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat) VALUES('".$ticketno."','".mysql_real_escape_string($_POST['description'])."','".mysql_real_escape_string($_POST['remarks'])."','".$assignedto."','".$_POST['source']."','".$_POST['department']."', '".$groupid."','".$_POST['subdepartment']."','3','1','null','".$_SESSION['id']."','".$createdat."','".$_SESSION['id']."','".$updatedat."')");
		$ComplaintId = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT id FROM complaint WHERE ticketno='".$ticketno."'"));
		mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid, comments, statusid, priorityid, addedby, addedat) VALUES('".$ComplaintId['id']."','New ticket created by ".$_SESSION["name"]."','1','3','".$_SESSION['id']."','".$createdat."')");
		return true;
	}
	function BiocomplaintInsert($TicketNo,$description,$remarks,$assignedto,$departmentid,$groupid,$subgroupid,$priorityid,$statusid,$reasonforhold,$createdby,$createdat,$updatedby,$updatedat,$locationid,$itemid,$sourceid)
	{
		mysqli_query($_SESSION['connection'],"INSERT INTO complaint(ticketno,description,remarks,assignedto,departmentid,groupid,subgroupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat,itemid,sourceid)  values('".$TicketNo."','".mysql_real_escape_string($_POST['description'])."','".mysql_real_escape_string($_POST['remarks'])."','".$assignedto."','".$_POST['department']."','".$_GET['groupid']."','".$_POST['subdepartment']."','3','1','null','".$_SESSION['id']."','".date("Y-m-d H:i:s")."','".$_SESSION['id']."','".date("Y-m-d H:i:s")."','".$_POST['item_id']."','1')");
		$ComplaintId = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT id FROM complaint WHERE ticketno='".$TicketNo."'"));
		mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid, comments, statusid, priorityid, addedby, addedat) VALUES('".$ComplaintId['id']."','New ticket created by ".$_SESSION["name"]."','1','3','".$_SESSION['id']."','".$createdat."')");
		return true;
	}
	function Priority_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM priority ORDER BY id ASC");
	}
	function Group_Select_ALL()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` ORDER BY id ASC");
	}
	function Ticket_Fetch()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint order by id DESC");
	}
	function UpdateFilename($Id,$Filename)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE complaint SET filename='".$Filename."' Where id='".$Id."'");
	}
	function SourceName_Fetch($SourceId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source WHERE id='".$SourceId."'");
	}
	function Department_Fetch($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE id='".$DepartmentId."'");
	}
	function Location_Select_All($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where groupid='".$GroupId."' ORDER BY id ASC");
	}
	function Location_Fetch($locationid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where id= '".$locationid."' ORDER BY id ASC");
	}
	function Complaint_Select_Location($Department,$Group)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where departmentid= '".$Department."' and groupid= '".$Group."' ORDER BY name ASC");
	}
	function Zone_Fetch($zoneid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone where id= '".$zoneid."' ORDER BY id ASC");
	}
	function Complaint_SubDepartment($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup Where groupid='".$GroupId."'ORDER BY name ASC ");
	}
	function Complaint_Select_SubgroupForComplainttype($SubGroupId) //ComplaintType Id And SubGroup Id Are Same
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup Where id='".$SubGroupId."'");
	}
	
	// For User As To Close The Ticket
	
	function UserhastoCloseTicket()
	{
		/*if($_SESSION['roleid'] == 5)
			return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE statusid='5' and createdby='".$_SESSION['id']."' ORDER BY id DESC");
		else
		{
			if(count($_SESSION['groups']))
			{
				$Condition = "(";
				$i = 1;
				foreach($_SESSION['groups'] as $Group)
				{
					if($i++ == 1)
						$Condition .= "ticketno LIKE '".$Group."%'";
					else
						$Condition .= " || ticketno LIKE '".$Group."%'";
				}
				$Condition .= ")";
			}
			return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE ($Condition OR (groupid!='".$_SESSION['groupid']."'and createdby='".$_SESSION['id']."')) and statusid='5' ORDER BY id DESC");
		}*/
		return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE statusid='5' and createdby='".$_SESSION['id']."' ORDER BY id DESC");
	}	
	
	//Biomedical Group
	function Department_Select_All_Biomedical()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE biomedical_department='1'");
	}
	function Complaint_Equipment_Name()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id WHERE  department_id='".$_SESSION['departmentid']."'");
	}
	function Complaint_EquipmentSerailNumber()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory  WHERE  department_id='".$_SESSION['departmentid']."' ");
	}
	function Complaint_Equipment_Id()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory  WHERE  department_id='".$_SESSION['departmentid']."'");
	}
	function Source_Select_All_Biomedical()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source WHERE id='1'");
	}
	function Complaint_Select_Equipment($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory WHERE id='".$Id."'");
	}
?>