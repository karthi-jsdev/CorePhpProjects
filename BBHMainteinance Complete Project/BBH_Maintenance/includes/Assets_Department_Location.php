<?php
	include("Config.php");
	include("Assets_Queries.php");
	if($_GET['Division'] || $_GET['Department'])
	{
		$results = "";
		echo "All##";
		if($_GET['Division'])
			$Assets_Select = Assets_Get_DepartmentById($_GET['Division']);
		else
			$Assets_Select = Assets_Get_LocationById($_GET['Department']);
		while($Assets_Data = mysqli_fetch_array($Assets_Select))
		{
			$results .= $Assets_Data['name']."#".$Assets_Data['id']."#";
		}
		echo substr($results, 0, -1);
	}
?>