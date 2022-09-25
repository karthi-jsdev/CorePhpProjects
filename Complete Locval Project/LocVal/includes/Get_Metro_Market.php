<?php
	ini_set("display_errors","0");
	include("Config.php");
	include("SalesQuery_Queries.php");
	if($_POST['county'])
	{ ?>
		<option value="">Select</option>
		<?php
		$metroMarkets = getMetroMarkets($_POST['county']);
		while($row = mysql_fetch_assoc($metroMarkets))
		{
				echo "<option value=".$row['metro_market_name'].">".$row['metro_market_name']."</option>";
		}
	}
?>