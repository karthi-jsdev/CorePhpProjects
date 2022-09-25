<?php 
	ini_set("display_errors","0");
	include("Config.php");
	
	echo '<label>Department</label>';
	if(isset($_GET['var']))
		echo '<select name="departmentid" id="departmentid">';
	else
		echo '<select name="departmentid" id="departmentid">';
	echo '<option value="" >';
	if(isset($_GET['All']))
		echo 'All';
	else
		echo 'Select';
	echo '</option>';
	
	$Select_Department= mysql_query("select * from `department` where groupid='".$_GET['GroupId']."' order by name asc ");
	while($Fetch_Department = mysql_fetch_array($Select_Department))
	{
		echo '<option value="'.$Fetch_Department['id'].'">'.$Fetch_Department['name'].'</option>';
	}
	echo "</select>";
?>