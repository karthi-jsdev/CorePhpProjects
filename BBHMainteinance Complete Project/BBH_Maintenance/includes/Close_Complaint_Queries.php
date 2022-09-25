<?php
	function Complaint_Select_RCStatus()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM status WHERE id='6' || id='7'");
	}
	function Complaint_Select_Zone_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone WHERE id='".$Id."'");
	}
	function Complaint_Select_Subgroup_ById($departmentid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup WHERE id='".$departmentid."'");
	}
	function Complaint_Select_Store_ById($complaintid)
	{
		$Store = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM partdetails WHERE id='".$complaintid."'"));
		return mysqli_query($_SESSION['connection'],"SELECT * FROM store WHERE id='".$Store['procuredfrom']."'");
	}
	function InsertRemarks($complaintid,$skill,$standard,$courtesy,$timeliness,$addedby)
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO remarks(complaintid,skill,standard,courtesy,timeliness,addedby) values('".$complaintid."','".$skill."','".$standard."','".$courtesy."','".$timeliness."','".$addedby."')");
	}
	function UpdateRemarks($complaintid,$skill,$standard,$courtesy,$timeliness,$addedby)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE remarks SET skill='".$skill."',standard='".$standard."',courtesy='".$courtesy."',timeliness='".$timeliness."',addedby='".$addedby."' WHERE complaintid='".$complaintid."'");
	}
	function ComplaintSelectRemarks($complaintid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM remarks WHERE complaintid='".$complaintid."' ORDER BY id DESC");
	}
	function Close_Complaint_Select_AllResolvedTickets()
	{
		if($_SESSION['roleid'] == 5)
			return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE statusid='5' ORDER BY id DESC");
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
		}
	}
	
	function Close_Complaint_Select_AllResolvedTickets_ByLimit($Start,$Limit)
	{
		if($_SESSION['roleid'] == 5)
			return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE statusid='5' ORDER BY id DESC Limit $Start,$Limit");
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
			return mysqli_query($_SESSION['connection'],"Select * From complaint WHERE ($Condition OR (groupid!='".$_SESSION['groupid']."'and createdby='".$_SESSION['id']."')) and statusid='5' ORDER BY id DESC Limit $Start,$Limit");
		}
	}
	
	function ComplaintSelectRemarkTypes()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM remarkstype");
	}
	function Close_Complaint_Select_ResolvedTickets_BySessionId()
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdby='".$_SESSION['id']."' AND statusid='5' ORDER BY id DESC");
	}
	function Close_Complaint_Select_ResolvedTickets_BySessionId_ByLimit($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdby='".$_SESSION['id']."' AND statusid='5' ORDER BY id DESC Limit $Start,$Limit");
	} 
	function Complaint_Update_ById($ComplaintId,$priorityid,$StatusId,$UpdatedBy)
	{
		return mysqli_query($_SESSION['connection'],"Update complaint SET priorityid='".$priorityid."',statusid='".$StatusId."',updatedby='".$UpdatedBy."',updatedat='".date('Y-m-d H:i:s')."' WHERE id='".$ComplaintId."'");
	} ?>