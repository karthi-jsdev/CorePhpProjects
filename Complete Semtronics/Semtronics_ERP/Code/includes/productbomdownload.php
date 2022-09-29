<?php
	ini_set("default_errors",0);
	include("Config.php");
	if(isset($_GET['bid']))
	{
		$row = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM productbom_versioning WHERE id='".$_GET['bid']."'"));
		$names = explode('!@#%',$row['name']);
		$filedata = explode('!@#%',$row['files']);
		$type = explode('!@#%',$row['type']);
		//$sizes = explode('!@#%',$row['MAX_FILE_SIZE']);
		for($i = 0; $i < count($names); $i++)
		{
			if($names[$i] == $_GET['name'])
			{
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				//header("Content-length:".$sizes[$i]);
				header("Content-type: ".$type[$i]);
				header("Content-Disposition: attachment; filename=".$names[$i]);
				echo $filedata[$i];
			}
		}
	}
?>