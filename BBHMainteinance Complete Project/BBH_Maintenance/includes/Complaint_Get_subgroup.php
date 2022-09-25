<?php
	include("Config.php");
	include("Masters_Queries.php");
	if($_GET['subgroup'] !=3)
	{
		$results = "";
		$Users = User_Select_ByGroupByValue($_GET['subgroup']);
		while($User = mysqli_fetch_assoc($Users))
		{
			$results .= $User['firstname']."#". $User['id']."#";
		}
		echo substr($results, 0, -1);
	}
	else if($_GET['subgroup'] == 3)
	{
		$results1 = "";
		$Usersname = User_Select_ByGroupByAdminandtechnicianValue($_GET['subgroup']);
		while($User1 = mysqli_fetch_assoc($Usersname))
		{
			$results1 .= $User1['firstname']."#". $User1['id']."#";
		}
		echo substr($results1, 0, -1);
	}
?>