<?php
	session_start();
	ini_set("display_errors","0");
	include("Config.php");
	//include("Login_Queries.php");
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		//$User_data = User_Login();
		$User_data = mysql_query("SELECT * FROM user WHERE username='".$_POST['username']."' && password='".$_POST['password']."'");
		if($User = mysql_fetch_array($User_data))
		{
			$_SESSION['id'] = $User['id'];
			$_SESSION['username'] = $User['username'];
			$_SESSION['password'] = $User['password'];
			echo 1;
		}
		else
			echo 0;
	}
	else
		echo 0;
?>