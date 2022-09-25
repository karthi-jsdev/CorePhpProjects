<?php
	include("config.php");
	echo $_GET['param'].",";
	if($_GET['param'] == "status")
	{
		$status_query = mysql_query("select * from status");
		while($row1 = mysql_fetch_array($status_query))
		{
			$status_query1 = mysql_query("select * from comments where status_id = '".$row1['slno']."' AND enable=1");
			echo $row1['status'].",".mysql_num_rows($status_query1).",";
		}
	}
	else if($_GET['param'] == "product")
	{
		$product_query = mysql_query("select * from producttype");
		while($row2 = mysql_fetch_array($product_query))
		{
			$product_query1 = mysql_query("select * from lead where ptype = '".$row2['slno']."' ");
			echo $row2['type'].",".mysql_num_rows($product_query1).",";
		}
	}
	else if($_GET['param'] == "assignee")
	{
		$assignee_query = mysql_query("select * from assignee");
		while($row3 = mysql_fetch_array($assignee_query))
		{
			$assignee_query1 = mysql_query("select * from lead where assign = '".$row3['slno']."' ");
			echo $row3['name'].",".mysql_num_rows($assignee_query1).",";
		}
	}	
?>