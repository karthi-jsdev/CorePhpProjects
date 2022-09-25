<?php
	include("config.php");	
	if($_GET['name'])
	{
		/*$mysql_hostname = "localhost";
		$mysql_user = "root";
		$mysql_password = "";
		$mysql_database = "pentamine";
		
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
		mysql_select_db($mysql_database, $bd) or die("Could not select database");*/
		$query4 = mysql_query("SELECT cname FROM client where cname='".$_GET['name']."'");
		if(mysql_num_rows($query4))
			echo "1";
		else
			echo "2";
	}
	else
		echo "0";
?>