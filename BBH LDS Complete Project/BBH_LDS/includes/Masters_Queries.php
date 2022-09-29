<?php
	//Master : group
	function Group_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `group` values('', '".$_POST['name']."')");
	}
	function Group_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `group` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Group_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE name='".$_POST['name']."'");
	}
	function Group_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Group_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE id='".$_GET['id']."'");
	}
	function Group_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `group` WHERE id='".$Id."' and id!='1'");
	}
	function Group_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `group` ORDER BY id DESC");
	}
	function Group_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Master : qualifiaction
	function Qualification_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `qualification` values('', '".$_POST['name']."')");
	}
	function Qualification_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `qualification` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Qualification_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `qualification` WHERE name='".$_POST['name']."'");
	}
	function Qualification_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `qualification` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Qualification_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `qualification` WHERE id='".$_GET['id']."'");
	}
	function Qualification_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `qualification` WHERE id='".$Id."'");
	}
	function Qualification_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `qualification` ORDER BY id DESC");
	}
	function Qualification_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `qualification` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Master : qualifiaction
	function Designation_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `designation` values('', '".$_POST['name']."')");
	}
	function Designation_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `designation` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Designation_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `designation` WHERE name='".$_POST['name']."'");
	}
	function Designation_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `designation` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Designation_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `designation` WHERE id='".$_GET['id']."'");
	}
	function Designation_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `designation` WHERE id='".$Id."'");
	}
	function Designation_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `designation` ORDER BY id DESC");
	}
	function Designation_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `designation` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Master : qualifiaction
	function Specialization_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `specialization` values('', '".$_POST['name']."')");
	}
	function Specialization_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `specialization` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Specialization_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `specialization` WHERE name='".$_POST['name']."'");
	}
	function Specialization_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `specialization` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Specialization_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `specialization` WHERE id='".$_GET['id']."'");
	}
	function Specialization_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `specialization` WHERE id='".$Id."'");
	}
	function Specialization_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `specialization` ORDER BY id DESC");
	}
	function Specialization_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `specialization` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	// Masters Section
	function Department_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into department values('', '".$_POST['groupid']."','".$_POST['name']."')");
	}
	function Department_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE groupid='".$_POST['groupid']."' && name='".$_POST['name']."'");
	}
	function Department_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE department SET groupid='".$_POST['groupid']."',name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Department_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE groupid='".$_POST['groupid']."' && name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Department_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE id='".$_GET['id']."'");
	}
	function Department_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM department WHERE id='".$Id."'");
	}
	function Department_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM department ORDER BY id DESC");
	}
	function Department_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Group_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` order by name asc");
	}
	function Department_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department order by name asc");
	}
	function Group_Select_ByIds($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` where id='".$GroupId."'");
	}
	function Sections_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where id='".$Id."'");
	}
	
	//Title
	function Title_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `title` values('', '".$_POST['name']."')");
	}
	function Title_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `title` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Title_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `title` WHERE name='".$_POST['name']."'");
	}
	function Title_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `title` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Title_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `title` WHERE id='".$_GET['id']."'");
	}
	function Title_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `title` WHERE id='".$Id."'");
	}
	function Title_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `title` ORDER BY id DESC");
	}
	function Title_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `title` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Leave Type
	function Leavetype_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into `leavetype` values('', '".$_POST['name']."')");
	}
	function Leavetype_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `leavetype` SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Leavetype_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `leavetype` WHERE name='".$_POST['name']."'");
	}
	function Leavetype_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `leavetype` WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Leavetype_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `leavetype` WHERE id='".$_GET['id']."'");
	}
	function Leavetype_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `leavetype` WHERE id='".$Id."'");
	}
	function Leavetype_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM `leavetype` ORDER BY id DESC");
	}
	function Leavetype_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `leavetype` ORDER BY id DESC LIMIT $Start, $Limit");
	}
?>