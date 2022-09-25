<?php
	function User_Select_ById()
	{
		return mysql_query("SELECT * FROM user WHERE id='".$_SESSION['SM_id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['confirmpassword']."' && id!='".$_SESSION['SM_id']."'");
	}
	function User_Role($Id)
	{
		return mysql_query("SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Update()
	{
		if($_POST['confirmpassword'])
			return mysql_query("UPDATE user SET phone='".$_POST['phone']."', password='".$_POST['confirmpassword']."' WHERE id='".$_SESSION['SM_id']."'");
		else
			return mysql_query("UPDATE user SET phone='".$_POST['phone']."' WHERE id='".$_SESSION['SM_id']."'");
	}
?>