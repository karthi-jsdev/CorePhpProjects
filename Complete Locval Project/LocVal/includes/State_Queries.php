<?php
	function Select_State_All()
	{
		return mysql_query("SELECT * FROM state order by state_code asc");
	}
	function Select_Count_State_All()
	{
		return mysql_query("SELECT COUNT(*) as Total FROM state");
	}
?>