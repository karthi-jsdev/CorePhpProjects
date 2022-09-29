<?php
	include("Config.php");
	date_default_timezone_set('Asia/Kolkata');
	ini_set("display_errors","0");
	if($_GET['Action'] == "Select")
	{
		if($_GET['Export'])
		{
			header("Content-Type: application/msexcel");
			header("Content-Disposition: attachment; filename=".date("d_m_Y",strtotime($_GET['date']))."_DailyStatus.xls");
			echo "<h2 align='left'>Machine Daily Status : ".$_GET['date']."</h2>";
		}
		$MachineStatus = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT status FROM machine_daily_status WHERE datetime like '".$_GET['date']."%' ORDER BY id DESC LIMIT 1"));
		echo $MachineStatus['status'];
	}
	else if($_GET['Action'] == "Insert")
	{
		ob_start();	
		$Contents = 1;
		include("Machine_Status_Live_Data.php");
		$HtmlCode = ob_get_contents();
		ob_end_clean();
		mysqli_query($_SESSION['connection'],'INSERT INTO machine_daily_status VALUES("", "'.date("Y-m-d H:i:s").'", "'.$HtmlCode.'")');
	}
?>