<?php

	function Reports_Complaints()
	{
		$StatusId = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From status Where name='Resolved'"));
		return mysqli_query($_SESSION['connection'],"Select * From complaint where statusid='".$StatusId['id']."' ORDER BY id,createdat,statusid DESC");
	}
	function Reports_Get_Priority($PriorityId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From priority where id='".$PriorityId."'");
	}
	function Reports_Get_Department($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From department where id='".$DepartmentId."'");
	}
	function Reports_Sub_Department($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup WHERE groupid='".$GroupId."'");
	}
	function Reports_Sub_Group($SubGroupId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup WHERE id='".$SubGroupId."'");
	}
	function Reports_SubDepartment()
	{
		return mysqli_query($_SESSION['connection'],"Select * From subgroup");
	}
	function Reports_SubDepartment_WeeklyReport()
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select * From subgroup");
		else	
			return mysqli_query($_SESSION['connection'],"Select * From subgroup WHERE groupid='".$_SESSION['groupid']."'");	
	}
	function Report_User($UserId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From user Where id='".$UserId."' order by firstname asc");
	}
	function Reports_Fetch_Amount($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From partdetails Where complaintid='".$ComplaintId."'");
	}
	function Reports_Departments()
	{
		return mysqli_query($_SESSION['connection'],"Select * From department order by name asc");
	}
	function Reports_DepartmentAdmin()
	{
		return mysqli_query($_SESSION['connection'],"Select * From user Where id='".$_SESSION['id']."'");
	}
	function Reports_Technician()
	{
		return mysqli_query($_SESSION['connection'],"Select * From user Where userroleid='3' or userroleid='1' order by firstname asc");
	}
	function Reports_Zones()
	{
		return mysqli_query($_SESSION['connection'],"Select * From zone order by name asc");
	}
	function Reports_Zones_By_Id($ZoneId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From zone Where id='".$ZoneId."'");
	}
	function Reports_Statuses()
	{
		return mysqli_query($_SESSION['connection'],"Select * From status WHERE id<>8");
	}
	function Reports_Statuses_All()
	{
		return mysqli_query($_SESSION['connection'],"Select * From status");
	}
	function Reports_Statuses_Unresolved()
	{
		return mysqli_query($_SESSION['connection'],"Select * From status Where id<>5 and id<>7 and id<>8 ");
	}
	function Reports_Statuses_By_Id($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From status Where id='".$StatusId."'");
	}
	function Reports_All()
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint ORDER BY id,createdat DESC");
	}
	
	//REPORTS QUeries
	function Reports_By_Status($StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where statusid='".$StatusId."' ORDER BY departmentid,updatedat DESC");
	}
	function Reports_By_Department($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' ORDER BY departmentid,updatedat DESC");
	}
	function Reports_By_Department_And_Status($DepartmentId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and statusid='".$StatusId."' ORDER BY departmentid,updatedat DESC");
	}
	function Reports_All_With_Dates($ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY departmentid, updatedat DESC");
	}
	function Reports_By_Status_With_Dates($StatusId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."'  ORDER BY departmentid,updatedat DESC");
	}
	function Reports_By_Department_With_Dates($DepartmentId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and departmentid='".$DepartmentId."'  ORDER BY id,createdat DESC");
		else
		{	
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and departmentid='".$DepartmentId."'  ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_SubDepartment_With_Dates($SubDepartmentId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
		{
			return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and subgroupid='".$SubDepartmentId."'  ORDER BY id,createdat DESC");
		}
		else
		{	
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select count(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and subgroupid='".$SubDepartmentId."'  ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Department_And_Status_With_Dates($DepartmentId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and departmentid='".$DepartmentId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		else
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and departmentid='".$DepartmentId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_SubDepartment_And_Status_With_Dates($SubDepartmentId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and subgroupid='".$SubDepartmentId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		
		else
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and subgroupid='".$SubDepartmentId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Technician_With_Dates($TechnicianId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Technician_And_Status_With_Dates($TechnicianId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
		{
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where assignedto='".$TechnicianId."' and createdat between '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Zone_With_Dates($ZoneId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));	
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Zone_And_Status_With_Dates($ZoneId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));	
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Priority_With_Dates($PriorityId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where priorityid='".$PriorityId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));	
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And priorityid='".$PriorityId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' ORDER BY id,createdat DESC");
		}
	}
	function Reports_By_Priority_And_Status_With_Dates($PriorityId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where priorityid='".$PriorityId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		else if($_SESSION['roleid']=='1')
		{
			$GroupName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'"));	
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint where ticketno LIKE '".$GroupName['name']."%' And priorityid='".$PriorityId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
		}
	}
	
	
	
	function Reports_By_Technician_And_Zone_With_Dates($TechnicianId,$ZoneId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$TechnicianId."' and zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."'  ORDER BY id,createdat DESC");
	}
	function Reports_By_Technician_Zone_And_Status_With_Dates($TechnicianId,$ZoneId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$TechnicianId."' and zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_And_Zone_With_Dates($DepartmentId,$ZoneId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."'  ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Zone_And_Status_With_Dates($DepartmentId,$ZoneId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and zoneid='".$ZoneId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_And_Technician_With_Dates($DepartmentId,$TechnicianId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."'  ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_And_Status_With_Dates($DepartmentId,$TechnicianId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_And_Zone_With_Dates($DepartmentId,$TechnicianId,$ZoneId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and zoneid='".$ZoneId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_Status_And_Zone_With_Dates($DepartmentId,$TechnicianId,$ZoneId,$StatusId,$ComplaintDate,$ResolvedDate)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and createdat between  '".date('Y-m-d',strtotime($ComplaintDate))."' and '".date('Y-m-d 23:59:59',strtotime($ResolvedDate))."' and zoneid='".$ZoneId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	
	function Reports_By_Technician($TechnicianId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$TechnicianId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Technician_And_Status($TechnicianId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$TechnicianId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Zone($ZoneId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where zoneid='".$ZoneId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Zone_And_Status($ZoneId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where zoneid='".$ZoneId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Technician_And_Zone($TechnicianId,$ZoneId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where zoneid='".$ZoneId."' and assignedto='".$TechnicianId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Technician_Zone_And_Status($TechnicianId,$ZoneId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where assignedto='".$TechnicianId."' and zoneid='".$ZoneId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_And_Zone($DepartmentId,$ZoneId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and zoneid='".$ZoneId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Zone_And_Status($DepartmentId,$ZoneId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and zoneid='".$ZoneId."' and statusid='".$StatusId."'  ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_And_Technician($DepartmentId,$TechnicianId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_And_Status($DepartmentId,$TechnicianId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_And_Zone($DepartmentId,$TechnicianId,$ZoneId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and zoneid='".$ZoneId."' ORDER BY id,createdat DESC");
	}
	function Reports_By_Department_Technician_Zone_And_Status($DepartmentId,$TechnicianId,$ZoneId,$StatusId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From complaint where departmentid='".$DepartmentId."' and assignedto='".$TechnicianId."' and zoneid='".$ZoneId."' and statusid='".$StatusId."' ORDER BY id,createdat DESC");
	}
	function Reports_All_Month_And_Year($Month,$Year)
	{
		if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint where Month(createdat)='".$Month."' and Year(createdat)='".$Year."'  ORDER BY id,createdat DESC");
		else if($_SESSION['roleid'] == '1')
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint where Month(createdat)='".$Month."' and Year(createdat)='".$Year."'  and ticketno LIKE '".$GroupName['name']."%' ORDER BY id,createdat DESC");
		}
	}
	function Reports_More_Month_And_Year($Month,$Year)
	{
		if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint where statusid!='5' And statusid!='7' And Month(createdat)='".$Month."' and Year(createdat)='".$Year."'  ORDER BY id,createdat DESC");
		else if($_SESSION['roleid'] == '1')
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint where statusid!='5' And statusid!='7' And Month(createdat)='".$Month."' and Year(createdat)='".$Year."' and ticketno LIKE '".$GroupName['name']."%'  ORDER BY id,createdat DESC");
		}
	}
	function Reports_Group()
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group`");
	}
	function Reports_Fetch_Remarks($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From remarks where complaintid='".$ComplaintId."'");
	}
	function Reports_Fetch_Remark_By_Type($RemarkId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From remarkstype where id='".$RemarkId."'");
	}
		//KPI Reports
	function Kpi_Tickets($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_12Hours($SubgroupId,$Month,$Year)
	{		
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where  statusid='5' AND subgroupid='".$SubgroupId."'  AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' AND (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 12 ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_1Day($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where  statusid='5' AND subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 12 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 24) ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_7Days($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where  statusid='5' AND subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 24 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 168) ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_15Days($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where statusid='5' AND subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."'  AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 168 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 360) ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_30Days($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where  statusid='5' AND subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 360 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 720) ORDER BY id,createdat DESC"));
	}
	function Kpi_Tickets_Pending($SubgroupId,$Month,$Year)
	{
		return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where  statusid!='5' AND subgroupid='".$SubgroupId."' AND Month(createdat)= '".$Month."' AND Year(createdat) = '".$Year."' ORDER BY id,createdat DESC"));
	}
	function Select_Group_Name()
	{
		return mysqli_query($_SESSION['connection'],"Select * From `group` Where id='".$_SESSION['groupid']."'");
	}
	//Asset Status All Reports
	function Assets_Status_By_Id()
	{
		$Query = "where divisionid = '".$_POST['divisionid']."' and departmentid = '".$_POST['departmentid']."' and  itemid = '".$_POST['itemid']."' ";
		if($_POST['locationid'])
			$Query .= "and locationid = '".$_POST['locationid']."'";
		if($_POST['connectiontypeid'] != '' && $_POST['connectiontypeid'] >= 0)
			$Query .= " and connectiontype = '".$_POST['connectiontypeid']."'";
		return mysqli_query($_SESSION['connection'],"Select * From assets ".str_replace("= ''", "!= ''", $Query));
	}
	
	function Report_SubDepartment()
	{
		$Query = "where ";
		if(isset($_POST['subdepartment']) && isset($_POST['status']))
			$Query .= "subgroupid = '".$_POST['subdepartment']."' and  statusid = '".$_POST['status']."' and";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc"));
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"));
		}
	}
	function Report_SubDepartment_WeeklyReport()
	{
		$Query = "where ";
		if(isset($_POST['subdepartment']) && isset($_POST['status'])&& isset($_POST['technician']))
			$Query .= "subgroupid = '".$_POST['subdepartment']."' and  statusid = '".$_POST['status']."' and assignedto = '".$_POST['technician']."' and ";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			{
				return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc"));
			}
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select COUNT(*) as total  From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"));
		}
	}
	function Report_SubDepartment_WeeklyReportQueries()
	{
		$Query = "where ";
		if(isset($_POST['subdepartment']) && isset($_POST['status'])&& isset($_POST['technician']))
			$Query .= "subgroupid = '".$_POST['subdepartment']."' and  statusid = '".$_POST['status']."' and assignedto = '".$_POST['technician']."' and ";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			{
				return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc"));
				echo "Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc");
			}
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select *  From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"));
		}
	}
	
	function Report_SubDepartment_Unresolved()
	{
		$Query = "where ";
		if(isset($_POST['subdepartment']))
			$Query .= "subgroupid = '".$_POST['subdepartment']."' and ";
		if($_POST['status'])
			$Query .= "statusid = '".$_POST['status']."' and ";
		else
			$Query .= "statusid !=5 and statusid !=7 and statusid !=8 and ";
		
		if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  (createdby='".$_SESSION['id']."' or assignedto='".$_SESSION['id']."' or (createdby!='".$_SESSION['id']."' or assignedto!='".$_SESSION['id']."')) ORDER BY id desc"));
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." (createdby='".$_SESSION['id']."' or assignedto='".$_SESSION['id']."' or (createdby!='".$_SESSION['id']."' or assignedto!='".$_SESSION['id']."'))  and ticketno LIKE '".$GroupName['name']."%' ORDER BY id desc"));
		}
	}
	function Report_Reopened()
	{
		$SelectAudit = mysqli_query($_SESSION['connection'],"Select * From audit where statusid='6'");
		$ComplaintId = "";
		$ComplaintIdsArray = array();
		$i = mysqli_num_rows($SelectAudit);
		while($FetchAudit = mysqli_fetch_array($SelectAudit))
		{
			$i -= 1;
			$ComplaintId .= "id=".$FetchAudit['complaintid'];
			$ComplaintIdsArray[] = $FetchAudit['complaintid'];
			if($i)
				$ComplaintId .= " OR ";
		}
		$Query = "where (".$ComplaintId.") AND ";
		if(isset($_POST['subdepartment']) && isset($_POST['technician']))
			$Query .= "subgroupid = '".$_POST['subdepartment']."' and  assignedto = '".$_POST['technician']."' and";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc"));
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"));
		}
	}
	function Report_Department()
	{
		$Query = "where ";
		if(isset($_POST['department']) && isset($_POST['status']))
			$Query .= "departmentid = '".$_POST['department']."' and  statusid = '".$_POST['status']."' and";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY departmentid,updatedat desc"));
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"));
		}
	}
	function Report_Priority()
	{
		$Query = "where ";
		if(isset($_POST['priority']))
			$Query .= "priorityid = '".$_POST['priority']."' and";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_SESSION['roleid']=='5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= ''", "!= ''", $Query."  ORDER BY priorityid,updatedat desc"));
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." and ticketno LIKE '".$GroupName['name']."%' ORDER BY priorityid,updatedat desc"));
		}
	}
	
	function Report_Technician()
	{
		if(isset($_POST['technician']) && isset($_POST['status']))
			$Query = "where assignedto = '".$_POST['technician']."' and  statusid = '".$_POST['status']."'";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " and createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";	
		if($_POST['technician']=="")
		{
			if($_SESSION['roleid'] == '5')
			{
				$Query .= " AND ";
				$NumTechnician = 0;
				$SelectGroup = Reports_Technician();
				$NumTechnician = mysqli_num_rows($SelectGroup);
				while($FetchGroup = mysqli_fetch_array($SelectGroup))
				{
					$NumTechnician -= 1;
					$Query .= "assignedto=".$FetchGroup['id']." ";
					if($NumTechnician)
						$Query .= " OR ";
					
				}
			}
			else if($_SESSION['roleid'] == '1')
			{
				$Query .= "AND (";
				$Reports_Sub_Department = Reports_Sub_Department($_SESSION['groupid']);
				$SubDeptNumRows = mysqli_num_rows($Reports_Sub_Department);
				$i=0;
				while($FetchTechnician = mysqli_fetch_array($Reports_Sub_Department))
				{
					$i++;
					$ExplodeTechnicians = explode(".",$FetchTechnician['users']);
					$Count_Explode = count($ExplodeTechnicians);
					foreach($ExplodeTechnicians as $ExplodeTechnician)
					{
						if($i>1)
							$Query .= " OR "; 
						$TechnicianName = mysqli_fetch_array(Report_User($ExplodeTechnician));
						$Query .= "assignedto=".$TechnicianName['id']."";
						$Count_Explode -= 1;
						
						if($Count_Explode)
							$Query .= " OR "; 
						if($i>1)
							$i--;
					}
				}
				$Query .= " )"; 
			}
		}
		if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." ORDER BY assignedto,updatedat desc"));
		else if($_SESSION['roleid'] == '1')
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],str_replace("assignedto= OR", "", "Select * From complaint ".str_replace("= ''", "!= ''", $Query."  and ticketno LIKE '".$GroupName['name']."%' ORDER BY assignedto,updatedat desc")));
		}
	}
	function Report_Zone()
	{
		$Query="";
		if(isset($_POST['zone']) && isset($_POST['status']))
			$Query = "where zoneid = '".$_POST['zone']."' and  statusid = '".$_POST['status']."'";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= "and createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."'";
		if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." ORDER BY zoneid,updatedat desc"));
		if($_SESSION['roleid'] == '1')
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint ".str_replace("= ''", "!= ''", $Query." And ticketno LIKE '".$GroupName['name']."%' ORDER BY zoneid,updatedat desc"));
		}
	}
	function Report_All()
	{
		$Query = "where ";
		if(isset($_POST['department']) && isset($_POST['technician']) && isset($_POST['status']))
			$Query .= "departmentid = '".$_POST['department']."' and  assignedto = '".$_POST['technician']."'  and  statusid = '".$_POST['status']."' and";
		if($_POST['zone']!="")
			$Query .= " zoneid = '".$_POST['zone']."' And";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_POST['technician']=="")
		{
			if($_SESSION['roleid'] == '5')
			{
				$Query .= " AND (";
				$NumTechnician = 0;
				$SelectGroup = Reports_Technician();
				$NumTechnician = mysqli_num_rows($SelectGroup);
				while($FetchGroup = mysqli_fetch_array($SelectGroup))
				{
					$NumTechnician -= 1;
					$Query .= "assignedto=".$FetchGroup['id']." ";
					if($NumTechnician)
						$Query .= " OR ";
					
				}
				$Query .= ") ";
			}
			else if($_SESSION['roleid'] == '1')
			{
				$Query .= "AND (";
				$Reports_Sub_Department = Reports_Sub_Department($_SESSION['groupid']);
				$SubDeptNumRows = mysqli_num_rows($Reports_Sub_Department);
				$i=0;
				while($FetchTechnician = mysqli_fetch_array($Reports_Sub_Department))
				{
					$i++;
					$ExplodeTechnicians = explode(".",$FetchTechnician['users']);
					$Count_Explode = count($ExplodeTechnicians);
					foreach($ExplodeTechnicians as $ExplodeTechnician)
					{
						if($i>1)
							$Query .= " OR "; 
						$TechnicianName = mysqli_fetch_array(Report_User($ExplodeTechnician));
						$Query .= "assignedto=".$TechnicianName['id']."";
						$Count_Explode -= 1;
						/*$SubDeptNumRows -= 1;*/
						if($Count_Explode)
							$Query .= " OR "; 
						if($i>1)
							$i--;
					}
				}
				$Query .= " )"; 
			}
		}
		if($_SESSION['roleid']=='5')
		{
			return mysqli_query($_SESSION['connection'],"Select * From complaint  ".str_replace("= '8'", "!= '5' and statusid != '7'", str_replace("= ''", "!= ''", $Query." ORDER BY departmentid,updatedat desc")));
		}
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],str_replace("assignedto= OR", "","Select * From complaint  ".str_replace("= '8'", "!= '5' and statusid != '7'", str_replace("= ''", "!= ''", $Query." And ticketno LIKE '".$GroupName['name']."%' ORDER BY departmentid,updatedat desc"))));
		}
	}
	function KPI_CallSplip_CurrentMonth($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
		{		
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59'"));
		}
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' And ticketno LIKE '".$GroupName['name']."%'"));
		}
	}
	function KPI_CallSplip_CurrentMonth_12Hours($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 12 AND (statusid=5 OR statusid=7)"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' And ticketno LIKE '".$GroupName['name']."%'  AND (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 12 AND (statusid=5 OR statusid=7)"));
		}
	}
	function KPI_CallSplip_CurrentMonth_24Hours($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 12 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 24) AND (statusid=5 OR statusid=7)"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 12 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 24) AND (statusid=5 OR statusid=7)"));
		}
	}
	function KPI_CallSplip_CurrentMonth_7Days($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 24 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 168) AND (statusid=5 OR statusid=7) "));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 24 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 168) AND (statusid=5 OR statusid=7) "));
		}
	}
	function KPI_CallSplip_CurrentMonth_15Days($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 168 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 360) AND (statusid=5 OR statusid=7) "));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 168 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 360) AND (statusid=5 OR statusid=7) "));
		}
	}
	function KPI_CallSplip_CurrentMonth_30Days($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 360 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 720) AND (statusid=5 OR statusid=7) "));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) > 360 and (time_to_sec(timediff(updatedat, createdat)) / 3600) <= 720) AND (statusid=5 OR statusid=7) "));
		}
	}
	function KPI_CallSplip_CurrentMonth_After30Days($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) >= 720) AND (statusid=5 OR statusid=7) "));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND ((time_to_sec(timediff(updatedat, createdat)) / 3600) >= 720) AND (statusid=5 OR statusid=7) "));
		}
	}
	function KPI_CallSplip_Pending($StartDate,$EndDate)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND statusid!=5 AND statusid!=7"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' AND statusid!=5 AND statusid!=7"));
		}
	}
	function Reports_Reason()
	{
		return mysqli_query($_SESSION['connection'],"Select * From holdcategory ORDER By name asc");
	}
	function Reports_Reason_Count($StartDate,$EndDate,$HoldCategoryId)
	{
		if($_SESSION['roleid']=='5')
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate."' AND holdcategoryid='".$HoldCategoryId."' AND statusid!=5 AND statusid!=7"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where ticketno LIKE '".$GroupName['name']."%' AND createdat between '".$StartDate."' AND '".$EndDate."' AND holdcategoryid='".$HoldCategoryId."' AND statusid!=5 AND statusid!=7"));
		}
	}
	
	//AMC Period Report
	function Amc_Period_Report($SelectedDate)
	{
		return mysqli_query($_SESSION['connection'],"SELECT *,TIMESTAMPDIFF(MONTH, warrantydate, '".$SelectedDate."') as monthdiff from assets");
	}
	//Complaint Status Search For The Users Benefit
	//Complaint Status For Admin
	function Reports_Admin()
	{	
		return mysqli_query($_SESSION['connection'],"Select * From user Where userroleid!='1' and userroleid!='5' and groupid = '".$_SESSION['groupid']."' order by firstname asc");
	}
	function Reports_SuperAdmin()
	{	
		return mysqli_query($_SESSION['connection'],"Select * From user Where userroleid!='1' and userroleid!='5' order by firstname asc");
	}
	function Reports_Audit($ComplaintId)
	{
		return mysqli_query($_SESSION['connection'],"Select * From audit Where complaintid='".$ComplaintId."' order by id desc");
	}
	
	//critical Equipment Report
	function Reports_BioDepartments()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where  biomedical_department='1' order by name asc");
	}
	function Reports_BioStatuses_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM status where id!='5' AND  id!='6' AND id!='8'order by id asc");
	}
	function Reports_Equipments_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory  JOIN biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id GROUP BY biomedical_equipment.equipment");
	}
	function Report_BiomedicalAll()
	{
		$Query = "where ";
		//echo $_POST['department']."#".$_POST['technician']."#".$_POST['status']."#".$_POST['equipment']."#".$_POST['complaintdate']."#".$_POST['resolveddate']."#".$_POST['critical']."==================";
		//if(isset($_POST['department']) && isset($_POST['technician']) && isset($_POST['status']) && $_POST['equipment'])
			$Query .= "departmentid = '".$_POST['department']."' and  assignedto = '".$_POST['technician']."'  and  statusid = '".$_POST['status']."' and itemid = '".$_POST['equipment']."' and ";
		//if($_POST['equipment']!="")
			//$Query .= " itemid = '".$_POST['equipment']."' And";
		if(isset($_POST['complaintdate']) && isset($_POST['resolveddate']))
			$Query .= " createdat between  '".date('Y-m-d',strtotime($_POST['complaintdate']))."' and '".date('Y-m-d 23:59:59',strtotime($_POST['resolveddate']))."' ";
		if($_POST['technician']=="")
		{
			if($_SESSION['roleid'] == '5')
			{
				$Query .= " AND (";
				$NumTechnician = 0;
				$SelectGroup = Reports_Technician();
				$NumTechnician = mysqli_num_rows($SelectGroup);
				while($FetchGroup = mysqli_fetch_array($SelectGroup))
				{
					$NumTechnician -= 1;
					$Query .= "assignedto=".$FetchGroup['id']." ";
					if($NumTechnician)
						$Query .= " OR ";
					
				}
				$Query .= ") ";
			}
			else if($_SESSION['roleid'] == '1')
			{
				$Query .= "AND (";
				$Reports_Sub_Department = Reports_Sub_Department($_SESSION['groupid']);
				$SubDeptNumRows = mysqli_num_rows($Reports_Sub_Department);
				$i=0;
				while($FetchTechnician = mysqli_fetch_array($Reports_Sub_Department))
				{
					$i++;
					$ExplodeTechnicians = explode(".",$FetchTechnician['users']);
					$Count_Explode = count($ExplodeTechnicians);
					foreach($ExplodeTechnicians as $ExplodeTechnician)
					{
						if($i>1)
							$Query .= " OR "; 
						$TechnicianName = mysqli_fetch_array(Report_User($ExplodeTechnician));
						$Query .= "assignedto=".$TechnicianName['id']."";
						$Count_Explode -= 1;
						/*$SubDeptNumRows -= 1;*/
						if($Count_Explode)
							$Query .= " OR "; 
						if($i>1)
							$i--;
					}
				}
				$Query .= " )"; 
			}
		}
		if($_SESSION['roleid']=='5')
		{
			if($_POST['critical'])
				return mysqli_query($_SESSION['connection'],"Select complaint.* From complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname ".str_replace("= '8'", "!= '5' and complaint.statusid != '7'", str_replace("= ''", "!= ''", $Query."  and complaint.groupid='3' and assets_inventory.critical_equipment='1' group by complaint.id ORDER BY complaint.departmentid,complaint.updatedat desc")));
			else
				return mysqli_query($_SESSION['connection'],"Select complaint.* From complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname ".str_replace("= '8'", "!= '5' and complaint.statusid != '7'", str_replace("= ''", "!= ''", $Query."  and complaint.groupid='3' group by complaint.id ORDER BY complaint.departmentid,complaint.updatedat desc")));
		}
		else
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			if($_POST['critical'])
				return mysqli_query($_SESSION['connection'],str_replace("assignedto= OR", "","Select complaint.* From complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname  ".str_replace("= '8'", "!= '5' and complaint.statusid != '7'", str_replace("= ''", "!= ''", $Query." And ticketno LIKE '".$GroupName['name']."%' and assets_inventory.critical_equipment='1' group by complaint.id ORDER BY complaint.departmentid,complaint.updatedat desc"))));
			else
				return mysqli_query($_SESSION['connection'],str_replace("assignedto= OR", "","Select complaint.* From complaint  ".str_replace("= '8'", "!= '5' and complaint.statusid != '7'", str_replace("= ''", "!= ''", $Query." And ticketno LIKE '".$GroupName['name']."%' group by complaint.id ORDER BY complaint.departmentid,complaint.updatedat desc"))));
		}
	}
	function Reports_Equipment_By_Id($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment where id='".$Id."'");
	}
	
	//Biomedical KPI Reports
	
	
	function BiomedicalKPIReports_All_Month_And_Year($Month,$Year)
	{
		/*if($_SESSION['roleid'] == '5')
			return mysqli_query($_SESSION['connection'],"Select * From complaint where Month(createdat)='".$Month."' and Year(createdat)='".$Year."'  ORDER BY id,createdat DESC");
		else if($_SESSION['roleid'] == '1')
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_query($_SESSION['connection'],"Select * From complaint where Month(createdat)='".$Month."' and Year(createdat)='".$Year."'  and ticketno LIKE '".$GroupName['name']."%' ORDER BY id,createdat DESC");
		}*/
		//echo "SELECT count(assets_inventory.critical_equipment) as critical_equipment,complaint.*,DATEDIFF(hh,".date('Y-m-d 23:59:59',strtotime(complaint.bio_startdate))." , ".date('Y-m-d 23:59:59',strtotime(complaint.bio_enddate))." ) FROM complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname where assets_inventory.critical_equipment='1' and ( Month(complaint.bio_startdate)='".$Month."' or  Month(complaint.bio_enddate)='".$Month."' ) and  ( Year(complaint.bio_startdate)='".$Year."'  or Year(complaint.bio_enddate)='".$Year."')";
		//echo "SELECT count(assets_inventory.critical_equipment) as critical_equipment,complaint.*,DATEDIFF(hh,".date('Y-m-d') ,strtotime('complaint.bio_startdate').",".date('Y-m-d'),strtotime('complaint.bio_enddate').") FROM complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname where assets_inventory.critical_equipment='1' and ( Month(complaint.bio_startdate)='".$Month."' or  Month(complaint.bio_enddate)='".$Month."' ) and  ( Year(complaint.bio_startdate)='".$Year."'  or Year(complaint.bio_enddate)='".$Year."')";
		return mysqli_query($_SESSION['connection'],"SELECT count(assets_inventory.critical_equipment) as critical_equipment,complaint.*,min(complaint.bio_startdate) as startdate,max(complaint.bio_enddate)as enddate FROM complaint JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname where assets_inventory.critical_equipment='1' and ( Month(complaint.createdat)='".$Month."' or  Month(complaint.updatedat)='".$Month."' ) and  ( Year(complaint.createdat)='".$Year."'  or Year(complaint.updatedat)='".$Year."')");
	
	}
	function BiomedicalKPIReports_Department_Equipment($Month,$Year)
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,biomedical_equipment.equipment,complaint.bio_remark,complaint.createdat as startdate,complaint.updatedat as enddate,breakdowncategory.breakdowncategory,biomedical_make.make
		FROM complaint 
		JOIN  breakdowncategory ON breakdowncategory.id = complaint.breakdowncategory
		JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname 
		JOIN biomedical_make on assets_inventory.make_id = biomedical_make.id
		JOIN department ON department.id = complaint.departmentid 
		JOIN biomedical_equipment ON complaint.itemid = biomedical_equipment.id
		where assets_inventory.critical_equipment='1' and ( Month(complaint.createdat)='".$Month."' or Month(complaint.updatedat)='".$Month."' ) and 
		( Year(complaint.createdat)='".$Year."' or Year(complaint.updatedat)='".$Year."') ");
		/*
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,complaint.bio_remark ,biomedical_equipment.equipment ,count(biomedical_equipment.id)as quantity,min(complaint.bio_startdate) as startdate,max(complaint.bio_enddate) as enddate
		FROM complaint 
		JOIN assets_inventory ON complaint.itemid = assets_inventory.equipment_idname 
		JOIN department ON department.id = complaint.departmentid 
		JOIN biomedical_equipment ON complaint.itemid = biomedical_equipment.id
		where assets_inventory.critical_equipment='1' and ( Month(complaint.bio_startdate)='".$Month."' or Month(complaint.bio_enddate)='".$Month."' ) and 
		( Year(complaint.bio_startdate)='".$Year."' or Year(complaint.bio_enddate)='".$Year."') group by(complaint.departmentid)");*/
	}
	function Biomedical_CurrentMonthavailability($StartDate,$EndDate)
	{
		/*if($_SESSION['roleid']=='5')		
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59'"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' And ticketno LIKE '".$GroupName['name']."%'"));
		}*/
		return mysqli_query($_SESSION['connection'],"SELECT * from complaint where bio_startdate between '".$StartDate."' AND '".$EndDate."'");
	}
	function Biomedical_CurrentMonthNonavailability($StartDate,$EndDate)
	{
		/*if($_SESSION['roleid']=='5')		
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59'"));
		else 
		{
			$GroupName = mysqli_fetch_array(Select_Group_Name());
			return mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From complaint where createdat between '".$StartDate."' AND '".$EndDate." 23:59:59' And ticketno LIKE '".$GroupName['name']."%'"));
		}*/
	}
	function Reports_Technician_Biomedical()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where userroleid='3' and groupid='3' order by firstname");
	}
?>