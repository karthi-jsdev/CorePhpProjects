<?php
	function User_Login()
	{
		return mysql_query("SELECT user_role.modules,user_role.role, user.* FROM user JOIN user_role on user_role.id = user.userrole_id WHERE user.name='".$_POST["name"]."' && user.password='".$_POST["password"]."'");
	}
	function User_Role($Id)
	{
		return mysql_query("SELECT role FROM user_role WHERE id='".$Id."'");
	}
?>