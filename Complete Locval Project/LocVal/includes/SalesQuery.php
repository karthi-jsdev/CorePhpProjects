<?php
	ini_set("display_errors","1");
	require("Config.php");
	require("SalesQuery_Queries.php");
	require("support_functions.php");
	
	$selectedState = $_POST['state'];
	$selectedCounty = $_POST['county'];
	$selectedMetroMarket = $_POST['metromarket'];
?>
<div class="content-top">
	<div class="wrap">
		<div class="section group">
			<h4><center><strong>Property Location Valuation</strong></h4>
		</div>
	</div>
</div>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<table>
				<tr>
					<td>
						<strong>State : </strong>
					</td>
					<td>
						<select id="state" name="state" onchange="updateCounty(this.value)">
							<option value="">Select</option>
							<?php
								$states = getStates();
								
								while($row = mysql_fetch_array($states))
								{
									$state = $row["state_code"];
									
									if ($selectedState == $state)
										echo "<option value='".$state."' selected='true'>".$state."</option>";
									else
										echo "<option value='".$state."'>".$state."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr style="height:10px;">
				</tr>
				<tr>
					<td>
						<strong>County : </strong>
					</td>
					<td>
						<select id="county" name="county" onchange="updateMetroMarket(this.value)">
							<option value="">Select</option>
							<?php
								$counties = getCounties($selectedState);
								
								while($row = mysql_fetch_array($counties))
								{
									$county = $row["name"];
									
									if ($selectedCounty == $county)
										echo "<option value='".$county."' selected='true'>".$county."</option>";
									else
										echo "<option value='".$county."'>".$county."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr style="height:10px;">
				</tr>
				<tr>
					<td>
						<strong>Metro Market : </strong>
					</td>
					<td>
						<select id="metromarket" name="metromarket" onchange="updateSalesQuery(this.value)">
							<option value="">Select</option>
							<?php
								$metroMarkets = getMetroMarkets($selectedCounty);
								
								while($row = mysql_fetch_array($metroMarkets))
								{
									$metroMarket = $row["metro_market_name"];
									
									if ($selectedMetroMarket == $metroMarket)
										echo "<option value='".$metroMarket."' selected='true'>".$metroMarket."</option>";
									else
										echo "<option value='".$metroMarket."'>".$metroMarket."</option>";
								}
							?>
						</select>
					</td>
				</tr>
			</table>
			<br />
			<?php				
				$salesQueryResult = getSalesQuery($selectedMetroMarket);
				
				if ($selectedMetroMarket != "" && $selectedMetroMarket != null && mysql_num_rows($salesQueryResult) == 0)
				{
			?>
			<label>No data found</label>
			<?php
				}
			?>
			<table id="salesQueryData" class="salesQuery" border="2" style="<?php if ($selectedMetroMarket == "" && $selectedMetroMarket == null) echo 'display: none;'; ?>">
				<thead style="color:White;background-color:#347FAC;font-weight:bold;">
					<th>ZIP CODE</th>
					<th>MED LOC VAL</th>
					<th>LOC VAL RANGE</th>
				</thead>
				<tbody id="sales_query">
					<?php						
						$i = 1;
						$latLongString = "";
						$valuationData = "";
						while($row = mysql_fetch_array($salesQueryResult))
						{
							$zipCode = $row["zipcode"];
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
						
						$q_str = "SELECT AsText(shape) AS POLY FROM zipcode_geometry";
	   
						$polyLookup = mysqli_query($con,"SELECT AsText(shape) AS POLY,color FROM zipcode_geometry") or die(mysql_error());
						
						
						$max_lat = -999999;
$min_lat =  999999;
$max_lon = -999999;
$min_lon =  999999;

$js_coord_str = "";

$js_coord_str_arr = array();
//echo mysqli_num_rows($polyLookup);
//$row_polyLookup = mysqli_fetch_array($polyLookup);
while($row_polyLookup = mysqli_fetch_array($polyLookup))
{
//echo $row_polyLookup['POLY'];

						$poly_arr = convert_wkt_to_poly_arr($row_polyLookup['POLY']);
						
						$js_coords_arr = array();
						

/*
Now we go through every polygon and coordinate pair, construct the Google Maps LatLng() object
and stuff each into the $js_coords_arr.
*/
foreach($poly_arr as $poly)
{
  $coords = explode(',',$poly);
  foreach($coords as $coord)
  {
    list($lon,$lat) = explode(' ',$coord);
    $js_coords_arr[] = '      new google.maps.LatLng('.$lat.', '.$lon.')';
    
    // Expand the boundaries
    if($lat>$max_lat)
    {
      $max_lat = $lat;
    }
    if($lat<$min_lat)
    {
      $min_lat = $lat;
    }
    if($lon>$max_lon)
    {
      $max_lon = $lon;
    }
    if($lon<$min_lon)
    {
      $min_lon = $lon;
    }
  }
}

// $nl is used to draw human-readable JavaScript code
$nl = '
';

// Now, let's tie the coordinates together into a string that will be echoed in the JS map code below
$js_coord_str = implode(','.$nl, $js_coords_arr);

$js_coord_str_arr[] = [$js_coord_str];

$js_color_str_arr[] = [$row_polyLookup['color']];
}

//echo count($js_coord_str_arr);
//echo $js_coord_str_arr[2][0];
//echo $js_coord_str;

					?>
				</tbody>
			</table>
			<br />
			<div id="map_canvas" style="height: 600px; width: 920px; display: none;">
            </div>
			<div class="clear"></div> 
		</div>
	</div>
</div>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
	var geocoder;
	var map;
	var animarker;
	var displaysub = "";
	function initialize() {
	document.getElementById("map_canvas").style.display = "";
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(41.521674, -71.311906);
	var myOptions = {
	  zoom: 10,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  
  var count = 0;
<?php
$count = 0;
foreach($js_coord_str_arr as $js_coord) { 
//echo "(".$js_coord.")";
?>
var boundary_coords = [
<?php echo $js_coord[0]; ?>
  ];
//alert(Number(<?php echo $js_color_str_arr[$count][0] ?>).toString(16));
var color = '#FF' + Number(<?php echo $js_color_str_arr[$count][0] ?>).toString(16) + '000';
  var county_boundary = new google.maps.Polygon({
    paths: boundary_coords,
    strokeColor: color,
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: color,
    fillOpacity: 0.35
  });
  county_boundary.setMap(map);
  
  count++;
	<?php 
$count++;
 } ?>
	
	}
	
	function aniCodeAddress(data,coordinate) {
	  var dataArray = data.split(",");
	  var contentString = '<div id="content"><label>Zipcode: ' +
		dataArray[0] + "</label><br /><label>Med Loc Val: " + dataArray[1] + "</label><br /><label>Loc val Range: " + dataArray[2] + 
		'</label></div>';
	  var infowindow = new google.maps.InfoWindow({
		  content: contentString
	  });
	  var coords = coordinate.split(",");
			   var latLng = new google.maps.LatLng(coords[0], coords[1]);
			  map.setCenter(latLng);
				  animarker = new google.maps.Marker({
				  map: map,

	icon: {
	url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
	size: new google.maps.Size(25,30)
	},
				  position: latLng,
				  title: dataArray[0]
			  });
			  google.maps.event.addListener(animarker, 'click', function() {
				  infowindow.open(map, animarker);
			  });
	}

	function codeAddress(data,coordinate) {
		var dataArray = data.split(",");
	  var contentString = '<div id="content"><label>Zipcode: ' +
		dataArray[0] + "</label><br /><label>Med Loc Val: " + dataArray[1] + "</label><br /><label>Loc val Range: " + dataArray[2] + 
		'</label></div>';
	  var infowindow = new google.maps.InfoWindow({
		  content: contentString
	  });
	  
	  var coords = coordinate.split(",");
			   var latLng = new google.maps.LatLng(coords[0], coords[1]);
			  //map.setCenter(latLng);
			  var marker = new google.maps.Marker({
				  map: map,
	icon: {
	url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
	size: new google.maps.Size(25,30)
	},
				  position: latLng,
				  title: dataArray[0]
			  });
			  google.maps.event.addListener(marker, 'click', function() {
				  infowindow.open(map, marker);
			  });
	}

	function addrsplit(data,coordinates) {
	  var arr = data.split("|");
	  
	  var coordinatesarr = coordinates.split("|");		  
	  
	  aniCodeAddress(arr[0],coordinatesarr[0]);
	  
	  for (i = 1; i < coordinatesarr.length; i++)
	  {
		codeAddress(arr[i],coordinatesarr[i]);
	  }
	}

	function updateCounty(state)
	{
		$("#county").html(Ajax("POST","includes/Get_County.php","state="+state));
		
		$("#metromarket").html("<option value=''>Select</option>");
	}
	
	function updateMetroMarket(county)
	{
		$("#metromarket").html(Ajax("POST","includes/Get_Metro_Market.php","county="+county));
	}
	
	function updateSalesQuery(metroMarket)
	{
		$("#salesQueryData").css("display","none");
		
		$("#sales_query").html(Ajax("POST","includes/Get_Sales_Query.php","metroMarket="+metroMarket));
		
		$("#salesQueryData").css("display","");
	}
	
	<?php
		if ($selectedMetroMarket != "" && $selectedMetroMarket != null)
		{
	?>
	initialize();//addrsplit('<?php echo $valuationData."','".$latLongString; ?>');
	<?php } ?>
	
	/*var layer = new google.maps.FusionTablesLayer();
         var where = "State-County = 'MI-Wayne'";

        layer.setOptions({
          query: {
            select: 'geometry',
            from: '1GfU2gtugYPjfeNvnapj1-GYrs5WOW3SRkE_Apw',
            where: where
          }
        });
        layer.setMap(map);*/

</script>