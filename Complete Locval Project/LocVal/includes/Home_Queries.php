<?php
	function State_Name()
	{
		return mysql_query("SELECT state.state_code,metro_market.metro_market_name as metromarketname,county.name as countyname FROM state join county on county.state_id = state.id join metro_market on metro_market.county_id = county.id group by metro_market.metro_market_name  order by state.state_code, metro_market.metro_market_name asc");
	}	
	function Announcement_Title()
	{
		return mysql_query("SELECT * FROM `announcements` order by id desc limit 0,3");
	}
?>