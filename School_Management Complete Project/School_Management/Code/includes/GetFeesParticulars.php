<?php
	include("Config.php");
	if($_GET['FeesId'])
	{
		$FetchFeesParticulars = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from fees_particulars where categoryid='".$_GET['FeesId']."'"));
		echo $FetchFeesParticulars['name'];
	}
?>