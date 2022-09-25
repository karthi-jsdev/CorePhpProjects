<?php
	session_start();
	/*foreach($_SESSION as $key => $value)
	{
		$_SESSION[$key]="";
		unset($_SESSION[$key]);
		session_unregister($key);
	}
	session_unset();
	session_destroy();
	header ("Location:../login.php");*/
	if($_SESSION['clientId'])
		$_SESSION['clientId']="";
		header('Location:../login.php');
?>
