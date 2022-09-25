<select id="d" size="10" multiple="multiple">								
<?php
	include("Config.php");
	include("Masters_Queries.php");
	if($_GET['option'] == "code")
	{
		$results = "";
		$Material = Materials_Select_All();
		while($Materials = mysql_fetch_assoc($Material))
		{
			echo "<option value='".$Materials['id']."'>".$Materials['materialcode']."-".$Materials['description']."</option>";
		}
	}
	else
	{
		$results = "";
		$Material = Materials_Select_All();
		while($Materials = mysql_fetch_assoc($Material))
		{
			echo "<option value='".$Materials['id']."'>".$Materials['partnumber']."-".$Materials['description']."</option>";
		}
	}	
?>
</select>
