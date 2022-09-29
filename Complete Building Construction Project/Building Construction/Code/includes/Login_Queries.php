<?php
	function User_Login()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE user_name='".$_POST["name"]."' && password='".$_POST["password"]."'");
	}
	function User_Role($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT role FROM user_role WHERE id='".$Id."'");
	}
?>