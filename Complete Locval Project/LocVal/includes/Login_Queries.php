<?php
	function User_Login()
	{
		return mysql_query("SELECT * from user where username='".$_POST['username']."' and password='".$_POST['password']."'");
	}
?>