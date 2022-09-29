<?php
	function Resource_Insert($Stime,$Etime)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		if($_POST['todate']=='Present')
			return mysqli_query($_SESSION['connection'],"insert into resource_update values('','".$_POST['titleid']."','".$_POST['name']."','".$_POST['groupid']."','".$_POST['departmentid']."','".$_POST['designationid']."','".implode($_POST['qualificationid'],'$')."','".$_POST['specializationid']."','".$_POST['status']."','".implode($_POST['days'],'$')."','".$Stime."','".$Etime."','".date("Y-m-d",strtotime($_POST['fromdate']))."','".date("Y-m-d")."','".$image."','".$_POST['kmc']."','".$_POST['mobile']."','".$_POST['mail1']."','".$_POST['mail2']."','".date("Y-m-d",strtotime($_POST['dob']))."','".$_POST['sex']."','".$_POST['reason']."','".$_POST['resign']."')");
		else if($_POST['todate'])
			return mysqli_query($_SESSION['connection'],"insert into resource_update values('','".$_POST['titleid']."','".$_POST['name']."','".$_POST['groupid']."','".$_POST['departmentid']."','".$_POST['designationid']."','".implode($_POST['qualificationid'],'$')."','".$_POST['specializationid']."','".$_POST['status']."','".implode($_POST['days'],'$')."','".$Stime."','".$Etime."','".date("Y-m-d",strtotime($_POST['fromdate']))."','".date("Y-m-d",strtotime($_POST['todate']))."','".$image."','".$_POST['kmc']."','".$_POST['mobile']."','".$_POST['mail1']."','".$_POST['mail2']."','".date("Y-m-d",strtotime($_POST['dob']))."','".$_POST['sex']."','".$_POST['reason']."','".$_POST['resign']."')");
		else
			return mysqli_query($_SESSION['connection'],"insert into resource_update values('','".$_POST['titleid']."','".$_POST['name']."','".$_POST['groupid']."','".$_POST['departmentid']."','".$_POST['designationid']."','".implode($_POST['qualificationid'],'$')."','".$_POST['specializationid']."','".$_POST['status']."','".implode($_POST['days'],'$')."','".$Stime."','".$Etime."','".date("Y-m-d",strtotime($_POST['fromdate']))."','','".$image."','".$_POST['kmc']."','".$_POST['mobile']."','".$_POST['mail1']."','".$_POST['mail2']."','".date("Y-m-d",strtotime($_POST['dob']))."','".$_POST['sex']."','".$_POST['reason']."','".$_POST['resign']."')");
	}
	function Resource_Update($Stime,$Etime)
	{
		if($_FILES['photo']['tmp_name'])
		{
			$file = $_FILES['photo']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
			if($_POST['todate']=='Present')
				return mysqli_query($_SESSION['connection'],"update resource_update SET photo='".$image."',joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='".date("Y-m-d")."',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."', resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
			else if($_POST['todate'])
				return mysqli_query($_SESSION['connection'],"update resource_update SET photo='".$image."',joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='".date("Y-m-d",strtotime($_POST['todate']))."',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."', resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
			else
				return mysqli_query($_SESSION['connection'],"update resource_update SET photo='".$image."',joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."', resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
		}
		else
		{
			if($_POST['todate']=='Present')
				return mysqli_query($_SESSION['connection'],"update resource_update SET joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='".date("Y-m-d")."',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."',resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
			else if($_POST['todate'])	
				return mysqli_query($_SESSION['connection'],"update resource_update SET joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='".date("Y-m-d",strtotime($_POST['todate']))."',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."',resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
			else	
				return mysqli_query($_SESSION['connection'],"update resource_update SET joiningdate='".date("Y-m-d",strtotime($_POST['fromdate']))."',leavingdate='',name='".$_POST['name']."',groupid='".$_POST['groupid']."',departmentid='".$_POST['departmentid']."',designationid='".$_POST['designationid']."',qualification='".implode($_POST['qualificationid'],'$')."',specialization = '".$_POST['specializationid']."',status='".$_POST['status']."',days='".implode($_POST['days'],'$')."',starttime='".$Stime."',endtime='".$Etime."',titleid='".$_POST['titleid']."',kmc='".$_POST['kmc']."', mobile='".$_POST['mobile']."',mail1='".$_POST['mail1']."',mail2='".$_POST['mail2']."',dob='".date("Y-m-d",strtotime($_POST['dob']))."',sex='".$_POST['sex']."', reason ='".$_POST['reason']."',resign = '".$_POST['resign']."'  where id='".$_POST['id']."'");
		}
	}
	function ResourceUpdate_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"Select count(*) as total from resource_update");
	}
	function ResourceUpdate_Select_Search_Count_All($Search)
	{
		return mysqli_query($_SESSION['connection'],"Select count(*) as total from resource_update WHERE name like '".$Search."%'  or  name like '%".$Search."'  or  name like '%".$Search."%'");
	}
	function ResourceUpdate_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"Select title.name as titlename,resource_update.titleid,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,
		resource_update.id as id,designation.name as designationName,`group`.name as groupName,
		department.name as departmentName,resource_update.name as Name,resource_update.status as Status,resource_update.qualification AS qualification,
		resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex,resource_update.reason,resource_update.resign
		from resource_update JOIN designation ON designationid=designation.id JOIN
		department ON departmentid=department.id JOIN `group` ON resource_update.groupid=group.id
		JOIN `title` ON title.id = resource_update.titleid 
		Order by resource_update.id desc Limit $Start, $Limit");
	}
	function ResourceUpdate_Select_SearchByLimit($Start, $Limit ,$Search)
	{
		return mysqli_query($_SESSION['connection'],"Select title.name as titlename,resource_update.titleid,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,
		resource_update.id as id,designation.name as designationName,`group`.name as groupName,
		department.name as departmentName,resource_update.name as Name,resource_update.status as Status,resource_update.qualification AS qualification,
		resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex,resource_update.reason,resource_update.resign
		from resource_update JOIN designation ON designationid=designation.id JOIN
		department ON departmentid=department.id JOIN `group` ON resource_update.groupid=group.id
		JOIN `title` ON title.id = resource_update.titleid WHERE (resource_update.name like '".$Search."%'  or  resource_update.name like '%".$Search."'  or  resource_update.name like '%".$Search."%')
		Order by resource_update.id desc Limit $Start, $Limit");
	}
	function Resource_Select_ById()
	{
		
		return mysqli_query($_SESSION['connection'],"SELECT resource_update.titleid,resource_update.specialization,resource_update.id,resource_update.photo as Photo,resource_update.joiningdate as Joining,resource_update.leavingdate as Leaving,designation.id AS designationId, `group`.id AS groupId, department.id AS departmentId, resource_update.name AS Name, resource_update.status AS
		Status , resource_update.qualification AS qualification,resource_update.days as Days,resource_update.starttime as StartTime,resource_update.endtime as EndTime,resource_update.kmc,resource_update.mobile,resource_update.mail1,resource_update.mail2,resource_update.dob,resource_update.sex,resource_update.reason,resource_update.resign
		FROM resource_update
		JOIN designation ON designationid = designation.id
		JOIN department ON departmentid = department.id
		JOIN `group` ON resource_update.groupid = group.id
		WHERE resource_update.id ='".$_GET['id']."'");
	}
	function Resource_Delete_ById($Id)
	{
		
		return mysqli_query($_SESSION['connection'],"Delete From resource_update where id='".$Id."'");
	}
?>