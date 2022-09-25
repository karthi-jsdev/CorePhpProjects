<?php
	#Dashboard
	function UserSelection()
	{
		return mysql_query("SELECT * FROM user where id='".$_SESSION['id']."'");
	}
	function Dashboardids($s)
	{
		return mysql_query("SELECT * FROM user JOIN dashboarded on dashboarded.id='".$s."'");
	}
	function Latest_News()
	{
		return mysql_query("select * from latestnews where enable='1'");
	}
	function News()
	{
		return mysql_query("select * from news where enable='1'");
	}
?>