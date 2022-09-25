<?php
	include("Config.php");
	include("SalesQuery_Queries.php");
	if($_POST['metroMarket'])
	{ 
		$salesQueryResult = getSalesQuery($_POST['metroMarket']);
		
		$i = 1;
		
		$latLongString = "";
		$valuationData = "";
		
		while($row = mysql_fetch_array($salesQueryResult))
		{
			$zipCode = $row["zipCode"];
			$landArea = number_format($row["land_area"], 0, '.', ',');
			$salePrice = number_format($row["sale_price"], 0, '.', ',');
			$spsf = $row["spsf"];
			$median_spsf = $row["median_spsf"];
			$twentyfifth_spsf = $row["25th_spsf"];
			$seventyfifth_spsf = $row["75th_spsf"];
			$spsf_medSpsf = number_format($spsf/$median_spsf, 5);
			$med_loc_val = number_format($spsf/$median_spsf, 3);
			$twentyfifth_loc_val = number_format($twentyfifth_spsf/$median_spsf, 3);
			$seventyfifth_loc_val = number_format($seventyfifth_spsf/$median_spsf, 3);
			$latLongString .= $row["latitude"].",".$row["longitude"]."|";
			$valuationData .= $zipCode.",".$med_loc_val.",".$twentyfifth_loc_val."-".$seventyfifth_loc_val."|";
			
			if ($i % 2 == 0)
				echo "<tr style='background-color:#white;'>";
			else
				echo "<tr style='background-color:#CAEDFF;'>";
				
			echo "<td>".$zipCode."</td><td>".$med_loc_val."</td><td>".$twentyfifth_loc_val." - ".$seventyfifth_loc_val."</td></tr>";							
			
			$i++;
		}
		
		echo "<script>initialize();addrsplit('".$valuationData."','".$latLongString."');</script>";
	}
?>