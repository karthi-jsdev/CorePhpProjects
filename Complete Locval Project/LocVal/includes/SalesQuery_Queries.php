<?php
	function getStates()
	{
		return mysql_query("SELECT state_code FROM state where enabled = 1 Order by state_code ASC");
	}
	
	function getCounties($state)
	{
		return mysql_query("SELECT name FROM county, state where state.id = county.state_id and state.state_code = '".$state."' and county.enabled = 1 Order by name ASC");
	}
	
	function getMetroMarkets($county)
	{
		return mysql_query("SELECT metro_market_name FROM metro_market, county where county.id = metro_market.county_id and county.name = '".$county."' and metro_market.enabled = 1 group by metro_market.metro_market_name Order by metro_market_name ASC");
	}
	
	function getSalesQuery($metroMarket)
	{
		if ($metroMarket == "PHOENIX")
			return mysql_query("Select * from salesquery_by_zipcode Where state_code = 'AZ' and metro_market = 'PHOENIX'");
		else
			return mysql_query("Call getSalesQuery('".$metroMarket."')");
	}
?>