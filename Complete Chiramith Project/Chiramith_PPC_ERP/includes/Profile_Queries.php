<?php
	function User_Select_ById()
	{
		return mysql_query("SELECT * FROM user WHERE id='".$_SESSION['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['username']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['username']."' && password='".$_POST['confirmpassword']."' && id!='".$_SESSION['id']."'");
	}
	function User_Role($Id)
	{
		return mysql_query("SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Update()
	{
		if($_POST['confirmpassword'])
			return mysql_query("UPDATE user SET phone='".$_POST['phonenumber']."', password='".$_POST['confirmpassword']."' WHERE id='".$_SESSION['id']."'");
		else
			return mysql_query("UPDATE user SET phone='".$_POST['phonenumber']."' WHERE id='".$_SESSION['id']."'");
	}
?>