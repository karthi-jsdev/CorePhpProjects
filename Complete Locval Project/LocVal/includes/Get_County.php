<?php
	ini_set("display_errors","0");
	include("Config.php");
	include("SalesQuery_Queries.php");
	if($_POST['state'])
	{ ?>
		<option value="">Select</option>
		<?php
		$counties = getCounties($_POST['state']);
		while($row = mysql_fetch_assoc($counties))
		{
				echo "<option value=".$row['name'].">".$row['name']."</option>";
		}
	}
?>