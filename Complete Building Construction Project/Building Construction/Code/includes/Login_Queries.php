<?php
	function User_Login()
	{
		return mysql_query("SELECT * FROM user WHERE user_name='".$_POST["name"]."' && password='".$_POST["password"]."'");
	}
	function User_Role($Id)
	{
		return mysql_query("SELECT role FROM user_role WHERE id='".$Id."'");
	}
?>