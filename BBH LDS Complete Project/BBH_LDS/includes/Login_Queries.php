<?php
	function User_Login($UserName, $Password)
	{
		return mysqli_query($_SESSION['connection'],"SELECT user.id,user.firstname,userrole.role FROM user JOIN userrole ON userroleid=userrole.id WHERE username='".$UserName."' && password='".$Password."'");
	}
	function User_Role($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT role FROM userrole WHERE id='".$Id."'");
	}
	function User_Select_AllGroups()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group`");
	}
?>