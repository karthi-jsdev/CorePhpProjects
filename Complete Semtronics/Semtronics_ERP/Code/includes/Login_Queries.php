<?php
	function User_Login()
	{
		return mysqli_query($_SESSION['connection'],"SELECT userrole_id,user_role.role, user.* FROM user JOIN user_role on user_role.id = user.userrole_id WHERE user.name='".$_POST["name"]."' && user.password='".$_POST["password"]."'");
	}
	function User_Role($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT role FROM user_role WHERE id='".$Id."'");
	}
?>