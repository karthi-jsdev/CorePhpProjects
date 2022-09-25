<?php
	//CreatedTickets
	if(isset($_GET['StatusId']) && $_GET['StatusId'] != "")
		$_POST['StatusId'] = "and statusid='".$_SESSION['StatusId']."'";
	function Count_Created_Tickets()
	{
		return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where createdby='".$_SESSION['id']."' ORDER BY createdat DESC");
	}
	function Count_Created_Unresolved_Tickets()
	{
		return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where createdby='".$_SESSION['id']."' && statusid != '5' && statusid != '7' ORDER BY createdat DESC");
	}
	function CountAll_Created_Tickets_ByStatusId()
	{
		if($_GET['StatusId'] != 8)
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint where createdby='".$_SESSION['id']."' ".$_POST['StatusId']." ORDER BY updatedat DESC"));
		else
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint where createdby='".$_SESSION['id']."'  && statusid != '5' && statusid != '7' ORDER BY updatedat DESC"));
	}
	function Select_Created_Tickets_ByStatusId_ByLimit($Start,$Limit)
	{
		if($_GET['StatusId'] != 8)
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint where createdby='".$_SESSION['id']."' ".$_POST['StatusId']." ORDER BY updatedat DESC Limit $Start,$Limit"));
		else
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint where createdby='".$_SESSION['id']."' && statusid != '5' && statusid != '7' ORDER BY updatedat DESC Limit $Start,$Limit"));
	}
	
	//AssignedTickets
	if(isset($_GET['AssignedStatusId']) && $_GET['AssignedStatusId'] != "")
		$_POST['AssignedStatusId'] = "and statusid='".$_SESSION['AssignedStatusId']."'";
	function Count_Assigned_Tickets()
	{
		return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint Where assignedto='".$_SESSION['id']."' ORDER BY updatedat DESC");
	}
	function Count_Assigned_Unresolved_Tickets()
	{
		return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint Where assignedto='".$_SESSION['id']."' && statusid != '5' && statusid != '7' ORDER BY updatedat DESC");
	}
	function CountAll_Assigned_Tickets_ByStatusId()
	{
		if($_GET['AssignedStatusId'] != 8)
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint where assignedto='".$_SESSION['id']."' ".$_POST['AssignedStatusId']." ORDER BY updatedat DESC"));
		else
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint where assignedto='".$_SESSION['id']."'  && statusid != '5' && statusid != '7' ORDER BY updatedat DESC"));
	}
	function Select_Assigned_Tickets_ByStatusId_ByLimit($Start,$Limit)
	{
		if($_GET['AssignedStatusId'] != 8)
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint where assignedto='".$_SESSION['id']."' ".$_POST['AssignedStatusId']." ORDER BY updatedat DESC Limit $Start,$Limit"));
		else
			return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint where assignedto='".$_SESSION['id']."'  && statusid != '5' && statusid != '7' ORDER BY updatedat DESC Limit $Start,$Limit"));
	}
	
	//AllTickets
	if(isset($_GET['StatusAll']) && $_GET['StatusAll'] != "")
		$_POST['StatusAll'] = "and statusid='".$_SESSION['StatusAll']."'";
	
	
	function CountAll_All_Tickets()
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."'";
		if($_SESSION['groups'][0])
		{
			$Condition .= " && (";
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
		else if($_SESSION['departmentadmin'])
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint $Condition && departmentid = '".$_SESSION['departmentid']."' ORDER BY updatedat DESC ");
		return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint $Condition  ORDER BY updatedat DESC");
	}
	
	function UnresolvedAll_All_Tickets()
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."'";
		if($_SESSION['groups'][0])
		{
			$Condition .= " && (";
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
		else if($_SESSION['departmentadmin'])
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint $Condition && departmentid = '".$_SESSION['departmentid']."' && statusid != '5' && statusid != '7' ORDER BY updatedat DESC ");
		return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint $Condition && statusid != '5' && statusid != '7' ORDER BY updatedat DESC");
	}
	function Complaint_Count_Status_All($StatusId)
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."' && statusid='".$StatusId."'";
		if($_SESSION['groups'][0])
		{
			$Condition .= " && (";
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
		else if($_SESSION['departmentadmin'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint WHERE (createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."') && departmentid='".$_SESSION['departmentid']."' && statusid='".$StatusId."' ORDER BY updatedat DESC");	
		return mysqli_query($_SESSION['connection'],"Select * From complaint $Condition ORDER BY updatedat DESC");
	}
	function SelectAll_All_Tickets_ByStatusId()
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."'";
		if(count($_SESSION['groups']))
		{
			$Condition .= " && (";
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
		if(!$Condition && $_POST['StatusAll'])
			$_POST['StatusAll'] = substr($_POST['StatusAll'], 3,strlen($_POST['StatusAll'])-1);
		if($_SESSION['groups'][0])
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total  From complaint $Condition ".$_POST['StatusAll']." ORDER BY updatedat DESC"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total  From complaint $Condition && statusid != '5' && statusid != '7' ORDER BY updatedat DESC"));
		}
		else if($_SESSION['roleid']=='5')
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total  From complaint $Condition ".$_POST['StatusAll']." ORDER BY updatedat DESC"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total  From complaint $Condition && statusid != '5' && statusid != '7' ORDER BY updatedat DESC"));
		}
		else if($_SESSION['departmentadmin'])
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint $Condition ".$_POST['StatusAll']." && departmentid = '".$_SESSION['departmentid']."' ORDER BY updatedat DESC"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select COUNT(*) as total From complaint $Condition && departmentid = '".$_SESSION['departmentid']."' && statusid != '5' && statusid != '7' ORDER BY updatedat DESC"));
		}
	}
	
	function Select_All_Tickets_ByStatusId_ByLimit($Start,$Limit)
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."' && assignedto!='".$_SESSION['id']."'";
		if($_SESSION['groups'][0])
		{
			$Condition .= " && (";
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
		if(!$Condition && $_POST['StatusAll'])
			$_POST['StatusAll'] = substr($_POST['StatusAll'], 3,strlen($_POST['StatusAll'])-1);
		if($_SESSION['groups'][0])
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition ".$_POST['StatusAll']." ORDER BY updatedat DESC Limit $Start,$Limit"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition && statusid != '5' && statusid != '7' ORDER BY updatedat DESC Limit $Start,$Limit"));
		}
		else if($_SESSION['roleid']=='5')
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition ".$_POST['StatusAll']." ORDER BY updatedat DESC Limit $Start,$Limit"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition && statusid != '5' && statusid != '7' ORDER BY updatedat DESC Limit $Start,$Limit"));
		}
		else if($_SESSION['departmentadmin'])
		{
			if($_GET['StatusAll'] != 8)
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition ".$_POST['StatusAll']." && departmentid = '".$_SESSION['departmentid']."' ORDER BY updatedat DESC Limit $Start,$Limit"));
			else
				return mysqli_query($_SESSION['connection'],str_replace("='0'", "!='0'", "Select * From complaint $Condition && departmentid = '".$_SESSION['departmentid']."' && statusid != '5' && statusid != '7' ORDER BY updatedat DESC Limit $Start,$Limit"));
		}
	}
	function Complaint_Status_Priority()
	{
		return mysqli_query($_SESSION['connection'],"Select * From priority");
	}
	function Complaint_Select_AllGroupnames()
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group`");
	}
	function Complaint_Select_ExceptBiogroupandCommon()
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group` where id<>3 and id<>4");
	}
	//Common tickets only move to MIS
	function Complaint_Select_onlyMIS()
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group` where id<>2 and id<>3 and id<>4");
	}
	function ComplaintGroup($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$GroupId."'");
	}
	function Complaint_Select_GroupNameByNotId($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group` Where id!='".$GroupId."' order by id asc");
	}
	function Complaint_SubDepartment($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup Where groupid='".$GroupId."'");
	}
	function Select_Complaint_Technician()
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup order by name asc");
	}
	function Complaint_Zone()
	{
		return mysqli_query($_SESSION['connection'],"Select * From zone order by name asc");
	}
	function Complaint_Status()
	{
		return mysqli_query($_SESSION['connection'],"Select * From status WHERE id<8");
	}
	function Complaint_Status_Biomedical()
	{
		return mysqli_query($_SESSION['connection'],"Select * From status WHERE id<=8");
	}
	function Complaint_Complainttype()
	{
		foreach($_SESSION['groupids'] as $Groups)
		{
			$SelectGroup = mysqli_query($_SESSION['connection'],'Select * From `group` where id="'.$Groups.'"'); 
			while($FetchGroup = mysqli_fetch_array($SelectGroup))
			{
				$ExplodeAdmins = explode('.',$FetchGroup['admins']);
				foreach($ExplodeAdmins as $ExplodeAdmin)
				{
					if($ExplodeAdmin == $_SESSION['id'])
					{
						return mysqli_query($_SESSION['connection'],"Select * From complainttype Where groupid='".$FetchGroup['id']."'");
					}
				}
			}
		}
	}
	/*function Complaint_ComplainttypeByTicket($Ticket)
	{
		$ExplodeTicket = explode('-',$Ticket);
		$SelectGroup = mysqli_query($_SESSION['connection'],'Select * From `group` where name="'.$ExplodeTicket[0].'"'); 
		while($FetchGroup = mysqli_fetch_array($SelectGroup))
		{
			return mysqli_query($_SESSION['connection'],"Select * From subgroup Where groupid='".$FetchGroup['id']."'");
		}
	}*/
	function Complaint_Select_SubgroupForComplainttype($SubGroupId) //ComplaintType Id And SubGroup Id Are Same
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup Where id='".$SubGroupId."'");
	}
	function Complaint_Complainttype_Select($ComplaintTypeId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complainttype Where id='".$ComplaintTypeId."'");
	}
	function Complaint_Select_AssetItem($Id)
	{
		return mysqli_query($_SESSION['connection'],"Select * From assets where departmentid = '".$Id."' order by itemname asc");
	}
	function Complaint_Select_BiomedicalAssetItem($Id)
	{
		return mysqli_query($_SESSION['connection'],"Select * From assets_inventory JOIN biomedical_equipment ON biomedical_equipment.id = assets_inventory.equipment_idname where assets_inventory.department_id = '".$Id."' order by biomedical_equipment.equipment asc");
	}
	function Complaint_Status_Assigned()
	{
		return mysqli_query($_SESSION['connection'],"Select * From Complaint Where assignedto='".$_SESSION['id']."'");
	}
	function Departments()
	{
		return mysqli_query($_SESSION['connection'],"Select * From department");
	}
	function Complaint_Category_Select()
	{
		return mysqli_query($_SESSION['connection'],"Select * From holdcategory");
	}
	function Complaint_Complaints()
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdby='".$_SESSION['id']."' ORDER BY updatedat DESC");
	}
	
	function Complaint_Assigned_Tickets()
	{
		return mysqli_query($_SESSION['connection'],"Select * From Complaint Where assignedto='".$_SESSION['id']."' ORDER BY updatedat DESC");
	}
	function Complaint_Select_AssignedwithStatus($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From Complaint Where assignedto='".$_SESSION['id']."' and statusid='".$StatusId."' ORDER BY updatedat DESC");
	}
	function Complaint_Assigned_Tickets_ByLimit($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"Select * From Complaint Where assignedto='".$_SESSION['id']."' ORDER BY updatedat DESC Limit $Start,$Limit");
	}
	function Complaint_Complaints_All()
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."'";
		if(count($_SESSION['groups']))
		{
			$Condition .= " && (";
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
		return mysqli_query($_SESSION['connection'],"Select * From complaint $Condition ORDER BY updatedat DESC");
	}
	function Complaint_Complaints_All_ByLimit($Start,$Limit)
	{
		$Condition = "WHERE createdby!='".$_SESSION['id']."'";
		if(count($_SESSION['groups']))
		{
			$Condition .= " && (";
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
		return mysqli_query($_SESSION['connection'],"Select * From complaint $Condition ORDER BY updatedat DESC Limit $Start,$Limit");
	}
	function Complaint_Select_ByStatusandLimit($Start, $Limit, $StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdby='".$_SESSION['id']."' AND statusid='".$StatusId."' ORDER BY updatedat DESC Limit $Start,$Limit");
	}
	function Complaint_Select_Assigned_ByStatusandLimit($Start, $Limit,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$_SESSION['id']."' AND statusid='".$StatusId."' ORDER BY updatedat DESC Limit $Start,$Limit");
	}
	function Complaint_Source()
	{
		return mysqli_query($_SESSION['connection'],"Select * From source");
	}
	function Complaint_Get_Source($Source)
	{
		return mysqli_query($_SESSION['connection'],"Select * From source where id='".$Source."'");
	}
	function Complaint_Get_Priority($PriorityId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From priority where id='".$PriorityId."'");
	}
	function Complaint_Get_Department($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From department where id='".$DepartmentId."'");
	}
	function Complaint_Get_Status($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From status where id='".$StatusId."'");
	}
	function Complaint_Get_Location($locationid)
	{
		return mysqli_query($_SESSION['connection'],"Select * From location where id='".$locationid."'");
	}
	function Complaint_Get_Assigned($AssignedId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From user where id='".$AssignedId."'");
	}
	
	function Complaint_Count_Status($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where (createdby='".$_SESSION['id']."') AND statusid='".$StatusId."' ORDER BY updatedat DESC");
	}
	function Complaint_Count_Status_of_Assigned($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where (assignedto='".$_SESSION['id']."') AND statusid='".$StatusId."' ORDER BY updatedat DESC");
	}
	
	function Complaint_A_Ticket($TicketNo)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint Where ticketno='".$TicketNo."' or id='".$TicketNo."' ORDER BY updatedat DESC");
	}
	function InsertAudit($ComplaintId,$Comments,$StatusId,$priorityid,$ZoneId,$AddedBy)
	{
		if($ZoneId)
			return mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid,comments,statusid,priorityid,zoneid,addedby,addedat) values('".$ComplaintId."',".mysql_real_escape_string($Comments).",'".$StatusId."','".$priorityid."','".$ZoneId."','".$AddedBy."','".date('Y-m-d H:i:s')."')");
		else
			return mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid,comments,statusid,priorityid,addedby,addedat) values('".$ComplaintId."','".mysql_real_escape_string($Comments)."','".$StatusId."','".$priorityid."','".$AddedBy."','".date('Y-m-d H:i:s')."')");
	}
	function InsertPartDetails($ComplaintId,$PartName,$Quantity,$PartComplaint,$Amount,$ByCash,$AddedBy)
	{
			return mysqli_query($_SESSION['connection'],"INSERT INTO partdetails(complaintid,partname,quantity,procuredfrom,amount,bycash,addedby) values('".$ComplaintId."','".mysql_real_escape_string($PartName)."','".$Quantity."','".$PartComplaint."','".$Amount."','".$ByCash."','".$AddedBy."')");
	}
	function UpdateComplaint($ComplaintId,$SubDepartment,$ComplaintTypeId,$priorityid,$AssignedTo,$StatusId,$HoldCategoryId,$ReasonForHold,$UpdatedBy,$ItemId)
	{
		if($HoldCategoryId && $ItemId)	
			return mysqli_query($_SESSION['connection'],"Update complaint SET itemid='".$ItemId."', subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', holdcategoryid='".$HoldCategoryId."' ,reasonforhold='".mysql_real_escape_string($ReasonForHold)."' WHERE id='".$ComplaintId."'");
		else if($HoldCategoryId && !$ItemId)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', holdcategoryid='".$HoldCategoryId."' ,reasonforhold='".mysql_real_escape_string($ReasonForHold)."' WHERE id='".$ComplaintId."'");
		else if(!$HoldCategoryId && $ItemId)	
			return mysqli_query($_SESSION['connection'],"Update complaint SET itemid='".$ItemId."',subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."',reasonforhold='".mysql_real_escape_string($ReasonForHold)."' WHERE id='".$ComplaintId."'");
		else if(!$HoldCategoryId && !$ItemId)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', reasonforhold='".mysql_real_escape_string($ReasonForHold)."' WHERE id='".$ComplaintId."'");
	}
	//Biomedical
	function UpdateBioComplaint($ComplaintId,$SubDepartment,$ComplaintTypeId,$priorityid,$AssignedTo,$StatusId,$HoldCategoryId,$ReasonForHold,$UpdatedBy,$ItemId,$Biostartdate,$Bioenddate,$Remarks,$breakdowncategory)
	{
		if($HoldCategoryId && $ItemId && $Biostartdate && $Bioenddate && $Remarks)
			return mysqli_query($_SESSION['connection'],"Update complaint SET itemid='".$ItemId."', subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', holdcategoryid='".$HoldCategoryId."' ,reasonforhold='".mysql_real_escape_string($ReasonForHold)."',bio_startdate='".date('Y-m-d H:i:s', strtotime($Biostartdate))."',bio_enddate='".date('Y-m-d H:i:s', strtotime($Bioenddate))."',bio_remark='".$Remarks."',breakdowncategory = ".$breakdowncategory."  WHERE id='".$ComplaintId."'");
		else if($HoldCategoryId && !$ItemId && !$Biostartdate && !$Bioenddate && !$Remarks)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', holdcategoryid='".$HoldCategoryId."' ,reasonforhold='".mysql_real_escape_string($ReasonForHold)."',breakdowncategory = ".$breakdowncategory." WHERE id='".$ComplaintId."'");
		else if(!$HoldCategoryId && $ItemId && $Biostartdate && $Bioenddate && $Remarks)	
			return mysqli_query($_SESSION['connection'],"Update complaint SET itemid='".$ItemId."',subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."',reasonforhold='".mysql_real_escape_string($ReasonForHold)."',bio_startdate='".date('Y-m-d H:i:s H:i:s', strtotime($Biostartdate))."',bio_enddate='".date('Y-m-d H:i:s', strtotime($Bioenddate))."',bio_remark='".$Remarks."',breakdowncategory = ".$breakdowncategory."  WHERE id='".$ComplaintId."'");
		else if(!$HoldCategoryId && !$ItemId && !$Biostartdate && !$Bioenddate && !$Remarks)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', reasonforhold='".mysql_real_escape_string($ReasonForHold)."',breakdowncategory = ".$breakdowncategory." WHERE id='".$ComplaintId."'");
		else if(!$HoldCategoryId && $ItemId && $Biostartdate && $Bioenddate && $StatusId)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', reasonforhold='".mysql_real_escape_string($ReasonForHold)."',breakdowncategory = ".$breakdowncategory." WHERE id='".$ComplaintId."'");
		else if($StatusId)
			return mysqli_query($_SESSION['connection'],"Update complaint SET subgroupid='".$SubDepartment."', complainttypeid='".$ComplaintTypeId."',priorityid='".$priorityid."',assignedto='".$AssignedTo."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."', reasonforhold='".mysql_real_escape_string($ReasonForHold)."',breakdowncategory = ".$breakdowncategory." WHERE id='".$ComplaintId."'");
	}
	function Complaintbiobreakdown($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select breakdowncategory From complaint WHERE id='".$ComplaintId."' ORDER BY id DEsc");
	}
	function Complaint_Comments($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From audit WHERE complaintid='".$ComplaintId."' ORDER BY id DEsc");
	}
	function Complaint_Comments_ByLimit($ComplaintId,$Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"Select * From audit WHERE complaintid='".$ComplaintId."' ORDER BY id DEsc Limit $Start,$Limit");
	}
	function Complaint_Users_Fetch($UserId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From userrole Where id='".$UserId."'");
	}
	function Complaint_Fetch_User($UserId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From user Where id='".$UserId."'");
	}
	function Complaint_Get_TechnicianById($SubGroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup Where id='".$SubGroupId."'");
	}
	function ComplaintMoveToOtherInsert($CurrentTicketNo, $CurrentGroupId, $ComplaintId2Audit,$ticketno,$description,$remarks,$assignedto,$sourceid,$departmentid,$locationid,$groupid,$priorityid,$statusid,$reasonforhold,$createdby,$updatedby)
	{
		if($locationid)
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(id,ticketno,description,remarks,assignedto,sourceid,departmentid,locationid,groupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat) values('','".$ticketno."','".$description."','".$remarks."','".$assignedto."','".$sourceid."','".$departmentid."','".$locationid."', '".$groupid."','".$priorityid."','".$statusid."','".$reasonforhold."','".$createdby."','".date('Y-m-d H:i:s')."','".$updatedby."','".date('Y-m-d H:i:s')."')");
		else
			mysqli_query($_SESSION['connection'],"INSERT INTO complaint(id,ticketno,description,remarks,assignedto,sourceid,departmentid,groupid,priorityid,statusid,reasonforhold,createdby,createdat,updatedby,updatedat) values('','".$ticketno."','".$description."','".$remarks."','".$assignedto."','".$sourceid."','".$departmentid."', '".$groupid."','".$priorityid."','".$statusid."','".$reasonforhold."','".$createdby."','".date('Y-m-d H:i:s')."','".$updatedby."','".date('Y-m-d H:i:s')."')");		
		$ComplaintId = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT id FROM complaint WHERE ticketno='".$ticketno."'"));
		mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid, comments, statusid, priorityid, addedby, addedat) VALUES('".$ComplaintId['id']."','New ticket created by ".$_SESSION["name"]."','1','3','".$_SESSION['id']."','".date('Y-m-d H:i:s')."')");

		mysqli_query($_SESSION['connection'],"Update complaint SET statusid='7' WHERE id='".$ComplaintId2Audit."'");
		$ComplaintSelectGroup = mysqli_fetch_array(ComplaintGroup($CurrentGroupId));
		$OtherGroupname = mysqli_fetch_array(Complaint_Select_GroupNameByNotId($CurrentGroupId));
		mysqli_query($_SESSION['connection'],"INSERT INTO audit(complaintid,comments,statusid,priorityid,addedby,addedat) values('".$ComplaintId2Audit."','This Issue is Not Related to ".$ComplaintSelectGroup['name']." Creating New Issue ".$ticketno." Where ".$OtherGroupname['name']."  moved by ".$_SESSION['name']."','7','".$priorityid."','".$updatedby."','".date('Y-m-d H:i:s')."')");
		return true;
	}
	function Complaint_PartDetails($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From partdetails Where complaintid='".$ComplaintId."' ORDER BY id desc");
	}
	function Complaint_PartDetailsById($Id)
	{
		return mysqli_query($_SESSION['connection'],"Select * From partdetails Where id='".$Id."' ORDER BY id desc");
	}
	function UpdatePartDetails()
	{
		return mysqli_query($_SESSION['connection'],"Update partdetails SET partname='".$_POST['partname']."',quantity='".$_POST['quantity']."',procuredfrom='".$_POST['department']."',amount='".$_POST['amount']."',bycash='".$_POST['bycash']."',addedby='".$_SESSION['id']."' where id='".$_POST['id']."'");
	}
	function Fetch_Stores()
	{
		return mysqli_query($_SESSION['connection'],"Select * From store");
	}
	function SelectStoreById($Id)
	{
		return mysqli_query($_SESSION['connection'],"Select * From store where id='".$Id."'");
	}
	// Ticket Number Search
	
	function Ticketnumber_Select_Byticket()
	{
		if($_SESSION['roleid'] == '5')
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where (ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%') order by id desc ");
		}
		else if($_SESSION['roleid'] == 1 || ($_SESSION['roleid'] == 3 && $_SESSION['groupid'] == 1))
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where ((ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%') and ((createdby = '".$_SESSION['id']."' or assignedto ='".$_SESSION['id']."') or groupid='".$_SESSION['groupid']."'))  order by id desc");
		}
		else
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where ((ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%')) and ( createdby = '".$_SESSION['id']."' or assignedto ='".$_SESSION['id']."') order by id desc ");
		}
	}
	function Ticketnumber_Close_Byticket()
	{
		if($_SESSION['roleid'] == '5')
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where (ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%') and statusid='5' order by id desc ");
		}
		else if($_SESSION['roleid'] == '1' || ($_SESSION['roleid'] == 3 && $_SESSION['groupid'] == 1))
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where ((ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%') and ((createdby = '".$_SESSION['id']."' or assignedto ='".$_SESSION['id']."') or groupid='".$_SESSION['groupid']."')) and  statusid='5' order by id desc");
		}
		else
		{
			return mysqli_query($_SESSION['connection'],"select * from complaint where ((ticketno like '".$_POST['ticketnos']."%' or ticketno like '%".$_POST['ticketnos']."'  and ticketno like '%".$_POST['ticketnos']."%')) and ( createdby = '".$_SESSION['id']."' or assignedto ='".$_SESSION['id']."') and statusid='5' order by id desc ");
		}
	}
	function PartsDelete_ById($Id)
	{
		mysqli_query($_SESSION['connection'],"Delete From partdetails where id='".$Id."'");
	}
	function ComplaintTicketCreatedBy($TicketNo)
	{
		return mysqli_query($_SESSION['connection'],"select * from complaint where ticketno='".$TicketNo."'");
	}
	function Breakdown_Category()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM breakdowncategory ");
	}
?>