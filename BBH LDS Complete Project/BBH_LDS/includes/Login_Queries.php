<?php
	function User_Login($UserName, $Password)
	{
		return mysql_query("SELECT user.id,user.firstname,userrole.role FROM user JOIN userrole ON userroleid=userrole.id WHERE username='".$UserName."' && password='".$Password."'");
	}
	function User_Role($Id)
	{
		return mysql_query("SELECT role FROM userrole WHERE id='".$Id."'");
	}
	function User_Select_AllGroups()
	{
		return mysql_query("SELECT * FROM `group`");
	}
?>