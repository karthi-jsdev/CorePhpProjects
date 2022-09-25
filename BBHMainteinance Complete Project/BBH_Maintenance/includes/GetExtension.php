<?php
	include("Config.php");
	include("Complaint_Queries.php");
	if(isset($_GET['Department']) && ($_GET['Group']))
	{
	$Extension = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From department where id='".$_GET['Department']."'"));
		echo $Extension['extension'];
	}
?>