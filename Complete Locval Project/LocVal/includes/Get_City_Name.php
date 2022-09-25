<?php
	ini_set("display_errors","0");
	include("Config.php");
	include("Metromarket_Queries.php");
	if($_POST['county_id'])
	{ ?>
		<option value="" selected>Select</option>
		<?php
		$Cities = Select_City_By_CountyId();
		while($City = mysql_fetch_assoc($Cities))
		{
			if($City['id'] == $_POST['city_id'])
				echo "<option value=".$City['id']." selected>".$City['name']."</option>";
			else
				echo "<option value=".$City['id'].">".$City['name']."</option>";
		}
	}
?>