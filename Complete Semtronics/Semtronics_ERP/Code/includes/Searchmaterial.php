<?php
	include("Config.php");
	if($_GET['Code'] && !$_GET['part'])
	{
		$results = "";
		if($_GET['search'])
			$search = mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE materialcode like '".$_GET['search']."%' or materialcode like '%".$_GET['search']."'  or materialcode like '%".$_GET['search']."%'");
		else
			$search = mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE materialcode like '%".$_GET['search']."%'");
		while($Fetchsearch = mysqli_fetch_array($search))
			echo "<option value='".$Fetchsearch['id']."'>".$Fetchsearch['materialcode']."-".$Fetchsearch['description']."</option>";
	}
	if($_GET['part']&& !$_GET['Code'])
	{
		$results = "";
		if($_GET['search'])
			$search = mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE partnumber like '".$_GET['search']."%' or partnumber like '%".$_GET['search']."'  or partnumber like '%".$_GET['search']."%'");
		else
			$search = mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE partnumber  like '%".$_GET['search']."%'");
		while($Fetchsearch = mysqli_fetch_array($search))
			echo "<option value='".$Fetchsearch['id']."'>".$Fetchsearch['partnumber']."-".$Fetchsearch['description']."</option>";
	}
?>