<?php
	function Present_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM `leave` WHERE  (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())");
		//return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM `leave` WHERE  (startdate BETWEEN startdate AND CURDATE())");
	}
	function Present_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
		/*return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (startdate BETWEEN startdate AND CURDATE())
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");*/
	}
	function Present_Select()
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (startdate BETWEEN startdate AND CURDATE())
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC");
	}
	function Future_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM `leave` WHERE  (enddate BETWEEN CURDATE() and enddate) and enddate!=CURDATE()");
	}
	function Future_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id 
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate BETWEEN CURDATE() and `leave`.enddate)  and `leave`.enddate!=CURDATE()
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	function Future_Select()
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id 
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate BETWEEN CURDATE() and `leave`.enddate)  and `leave`.enddate!=CURDATE()
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC");
	}
	function Past_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `leave` WHERE  (leave.enddate < CURDATE() and `leave`.enddate > YEAR(NOW()))");
	}
	function Past_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate < CURDATE() and `leave`.enddate > YEAR(NOW()))
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	function Past_Select()
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.name as departmentname,COUNT(resource_update.departmentid) as departmentnum
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate < CURDATE() ) 
		Group by(resource_update.departmentid)
		ORDER BY `resource_update`.name ASC");
	}
	
	
	function Consultantpresentleave_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM `leave` WHERE  (((`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())) and `leave`.group_id='1' )");
	} 
	function Consultantpresentleave_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE ( (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())  and `leave`.group_id='1' )
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
	function Consultantfutureleave_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM `leave` WHERE  ((enddate BETWEEN CURDATE() and enddate) and enddate!=CURDATE() and `leave`.group_id='1' )");
	}
	
	function Consultantfutureleave_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id 
		JOIN title ON title.id = resource_update.titleid
		WHERE  ((`leave`.enddate BETWEEN CURDATE() and `leave`.enddate)  and `leave`.enddate!=CURDATE() and `leave`.group_id= '1')
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
	function Consultantpastleave_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `leave` WHERE ( (leave.enddate < CURDATE() and `leave`.enddate > YEAR(NOW())) and `leave`.group_id='1' )");
	}
	function Consultantpastleave_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT title.name as title,`leave`.startdate, `leave`.enddate, `leave`.comments, `group`.name AS groupName, resource_update.name AS Name, department.name AS departmentName,resource_update.photo
		FROM `leave`
		JOIN resource_update ON `leave`.name = resource_update.id
		JOIN `group` ON resource_update.groupid = group.id
		JOIN department ON resource_update.departmentid = department.id  
		JOIN title ON title.id = resource_update.titleid
		WHERE  (`leave`.enddate < CURDATE()  and `leave`.group_id='1' ) 
		ORDER BY `resource_update`.name ASC  Limit $Start, $Limit");
	}
	
?>