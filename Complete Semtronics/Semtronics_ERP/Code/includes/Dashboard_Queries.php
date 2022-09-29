<?php
	#Dashboard
	function UserSelection()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where id='".$_SESSION['id']."'");
	}
	function Dashboardids($s)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user JOIN dashboarded on dashboarded.id='".$s."'");
	}
	function Latest_News()
	{
		return mysqli_query($_SESSION['connection'],"select * from latestnews where enable='1'");
	}
	function News()
	{
		return mysqli_query($_SESSION['connection'],"select * from news where enable='1'");
	}
?>