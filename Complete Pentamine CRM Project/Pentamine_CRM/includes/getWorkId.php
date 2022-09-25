<?php
	include("config.php");
	echo 'Work:<select id="work" >
	<option value="">All</option>';
	$query_Work = mysql_query("Select * From work where client='".$_GET['ClientId']."'");
	while($row_work = mysql_fetch_array($query_Work))
	{
		echo '<option value="'.$row_work['work_id'].'">'.$row_work['work_id'].'</option>';
	}
	echo '</select>';
?>