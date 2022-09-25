<?php
	function County_Select_All()
	{
		return mysql_query("SELECT * FROM county order by name asc");
	}
	function Select_City_By_CountyId()
	{
		return mysql_query("SELECT * FROM city WHERE county_id= '".$_POST['county_id']."' order by name asc");
	}
	function Maintenance_Metromarket()
	{
		return mysql_query("SELECT * FROM metro_market WHERE county_id='".$_POST['county_id']."' and city_id='".$_POST['city_id']."' order by metro_market_name asc");
	}
	function Select_Count_Metromarket_All()
	{
		return mysql_query("SELECT COUNT(*) as Total FROM metro_market WHERE county_id='".$_POST['county_id']."' and city_id='".$_POST['city_id']."' order by metro_market_name asc");
	}
?>