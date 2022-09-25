<?php
	include("Config.php");
	if($_GET['FeesId'])
	{
		$FetchFeesParticulars = mysql_fetch_array(mysql_query("select * from fees_particulars where categoryid='".$_GET['FeesId']."'"));
		echo $FetchFeesParticulars['name'];
	}
?>