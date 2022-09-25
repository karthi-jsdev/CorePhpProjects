<?php
	function County_Select_All()
	{
		return mysql_query("SELECT * FROM county order by name asc");
	}
	function Maintenance_City_Name()
	{
		return mysql_query("SELECT * FROM city WHERE county_id='".$_POST['county_id']."' order by name asc");
	}
	function Select_Count_city_All()
	{
		return mysql_query("SELECT COUNT(*) as Total FROM city WHERE county_id='".$_POST['county_id']."' order by name asc");
	}
?>