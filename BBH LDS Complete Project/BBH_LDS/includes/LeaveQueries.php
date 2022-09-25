<?php
	function Leave_Select_ById()
	{
		return mysql_query("SELECT leave.name,resource_update.groupid,resource_update.departmentid,leave.startdate,leave.enddate,leave.comments,leave.leavetypeid FROM `leave` JOIN resource_update ON leave.name = resource_update.id where leave.id='".$_GET['id']."'");
	}
	function Leave_Update()
	{
		if($_POST['half'])
			return mysql_query("UPDATE `leave` SET group_id='".$_POST['groupid']."',name='".$_POST['name']."',startdate='".date("Y-m-d",strtotime($_POST['startdate']))."',enddate='".date("Y-m-d",strtotime($_POST['enddate']))."',comments='".$_POST['comments']."',half='".$_POST['half']."',leavetypeid='".$_POST['leavetypeid']."' WHERE id='".$_POST['id']."'");
		else
			return mysql_query("UPDATE `leave` SET group_id='".$_POST['groupid']."',name='".$_POST['name']."',startdate='".date("Y-m-d",strtotime($_POST['startdate']))."',enddate='".date("Y-m-d",strtotime($_POST['enddate']))."',comments='".$_POST['comments']."',leavetypeid='".$_POST['leavetypeid']."' WHERE id='".$_POST['id']."'");
	}
	function Leave_Insert()
	{
		if($_POST['half'])
		{
			return mysql_query("Insert Into `leave` (id,group_id,name,startdate,enddate,comments,half,leavetypeid) values('','".$_POST['groupid']."','".$_POST['name']."','".date("Y-m-d",strtotime($_POST['startdate']))."','".date("Y-m-d",strtotime($_POST['enddate']))."','".$_POST['comments']."','".$_POST['half']."','".$_POST['leavetypeid']."')");
		}
		else	
		{
			return mysql_query("Insert Into `leave` (id,group_id,name,startdate,enddate,comments,leavetypeid) values('','".$_POST['groupid']."','".$_POST['name']."','".date("Y-m-d",strtotime($_POST['startdate']))."','".date("Y-m-d",strtotime($_POST['enddate']))."','".$_POST['comments']."','".$_POST['leavetypeid']."')");
		}
	}
	//Leave insert for same day
	function User_Select_Byname_Leave()
	{
		return mysql_query("select * from `leave` where name='".$_POST['name']."' and (startdate>='".date("Y-m-d",strtotime($_POST['startdate']))."' and enddate<='".date("Y-m-d",strtotime($_POST['enddate']))."')");
	}
	//Leave Update for the same day
	function User_Select_BynameId($Id,$Name,$Startdate,$Enddate)
	{
		return mysql_query("SELECT * FROM `leave` WHERE name='".$Name."' && (startdate>='".date("Y-m-d",strtotime($Startdate))."' && enddate<='".date("Y-m-d",strtotime($Enddate))."') && id!='".$Id."'");
	}
	
	function LeaveApply_Select_Count_All()
	{
		return mysql_query("select count(*) as total from `leave`");
	}
	function Leave_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.id,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName ,resource_update.photo,leave.half,leave.leavetypeid,leavetype.name as leavetypename
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id
		JOIN title ON title.id = resource_update.titleid
		JOIN leavetype ON leave.leavetypeid = leavetype.id
		ORDER BY `leave`.id DESC  Limit $Start, $Limit");
	}
	function Present_Select_Count_All()
	{
		return mysql_query("SELECT count(*) as total FROM `leave` WHERE  (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())");
		//return mysql_query("SELECT count(*) as total FROM `leave` WHERE  (startdate BETWEEN startdate AND CURDATE())");
	}
	function Present_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
		/*return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (startdate BETWEEN startdate AND CURDATE())
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");*/
	}
	function Future_Select_Count_All()
	{
		return mysql_query("SELECT count(*) as total FROM `leave` WHERE  (enddate BETWEEN CURDATE() and enddate) and enddate!=CURDATE()");
	}
	function Future_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id 
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate BETWEEN CURDATE() and `leave`.enddate)  and `leave`.enddate!=CURDATE()
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	function Past_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM `leave` WHERE  (leave.enddate < CURDATE())");
	}
	function Past_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate < CURDATE() ) 
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
	//Searching
	function Present_Select_Count_All_Name($name)
	{
		return mysql_query("SELECT count(*) as total FROM `leave` JOIN resource_update ON leave.name = resource_update.id  WHERE  ((`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())) AND resource_update.name like '".$name."%'");
	}
	function Present_Select_ByLimit_Name($name,$Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  ((`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())) AND resource_update.name like '".$name."%'
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
	function Future_Select_Count_All_Name($name)
	{
		return mysql_query("SELECT count(*) as total FROM `leave` JOIN resource_update ON leave.name = resource_update.id WHERE  (enddate BETWEEN CURDATE() and enddate) and enddate!=CURDATE() AND resource_update.name like '".$name."%'");
	}
	function Future_Select_ByLimit_Name($name,$Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id 
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate BETWEEN CURDATE() and `leave`.enddate)  and `leave`.enddate!=CURDATE() AND resource_update.name like '".$name."%'
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
	function Past_Select_Count_All_Name($name)
	{
		return mysql_query("SELECT COUNT(*) as total FROM `leave` JOIN resource_update ON leave.name = resource_update.id WHERE  (leave.enddate < CURDATE())  AND resource_update.name like '".$name."%'");
	}
	function Past_Select_ByLimit_Name($name,$Start, $Limit)
	{
		return mysql_query("SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate < CURDATE() ) AND resource_update.name like '".$name."%' 
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
?>
