<?php
	function User_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE id='".$_SESSION['SM_id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['confirmpassword']."' && id!='".$_SESSION['SM_id']."'");
	}
	function User_Role($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Update()
	{
		if($_POST['confirmpassword'])
			return mysqli_query($_SESSION['connection'],"UPDATE user SET phone='".$_POST['phone']."', password='".$_POST['confirmpassword']."' WHERE id='".$_SESSION['SM_id']."'");
		else
			return mysqli_query($_SESSION['connection'],"UPDATE user SET phone='".$_POST['phone']."' WHERE id='".$_SESSION['SM_id']."'");
	}
?>