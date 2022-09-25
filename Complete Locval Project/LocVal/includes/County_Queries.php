<?php
	function State_Select_All()
	{
		return mysql_query("SELECT * from state order by state_code asc");
	}
	function Select_County_Name_All()
	{
		return mysql_query("SELECT * from county where state_id='".$_POST['stateid']."' order by name asc");
	}
	function Select_Count_County_Name()
	{
		return mysql_query("SELECT COUNT(*) as Total from county where state_id='".$_POST['stateid']."' order by name asc");
	}
?>