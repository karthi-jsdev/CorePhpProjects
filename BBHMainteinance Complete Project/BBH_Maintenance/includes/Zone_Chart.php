<?php 
require_once("PhpChartDir.php");
include("Config.php");
//include("Reports_Queries.php");
# The data for the bar chart
	$Test = array();
	$Test[] = array();
	$colors = array(0xFF99CC,0x990000,0x9999CC,0x996600,0x9933CC,0xCCCC33,0xFF6600,0x99CC33);
	$labels = array(); 
	$SelectZone = Reports_Zones();
	$i = 0;
	while($FetchZone = mysqli_fetch_assoc($SelectZone))
	{
		$Reports_By_Zone = mysqli_fetch_array(Reports_By_Zone_With_Dates($FetchZone['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
		$Reports_By_Zone_And_Status = mysqli_fetch_array(Reports_By_Zone_And_Status_With_Dates($FetchZone['id'],$StatusId = '1',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
		if($Reports_By_Zone['total'])
		{
			$labels[] = $FetchZone['name'];	
			$Test[0][$i] = $Reports_By_Zone['total'];
			$Test[1][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[2][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[3][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[4][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[5][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[6][$i] = $Reports_By_Zone_And_Status['total'];
			$Test[7][$i] = $Reports_By_Zone_And_Status['total'];
			//$Test[7][$i] = mysqli_num_rows(Reports_By_Department_And_Status_With_Dates($FetchDepartment['id'],$StatusId = '1',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$i++;
		}	
	}
		
	# Create a XYChart object of size 540 x 375 pixels
	if($i>5)
		$c = new XYChart(170*$i, 375);
	else
		$c = new XYChart(170*5, 375);
		

	# Add a title to the chart using 18 pts Times Bold Italic font
	//$c->addTitle("Number Of Tickets Zone Wise", "timesbi.ttf", 18);
	//echo "<h3><b>Number Of Tickets Zone Wise</b></h3>";
	# Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical
	# gradient color from light blue (f9f9ff) to blue (6666ff) as background. Set border
	# and grid lines to white (ffffff).
	$c->setPlotArea(50, 55, 147*$i, 280, $c->linearGradientColor(0, 55, 0, 335, 0xf9f9ff,
		0x6666ff), -1, 0xffffff, 0xffffff);

	# Add a legend box at (50, 28) using horizontal layout. Use 10pts Arial Bold as font,
	# with transparent background.
	$legendObj = $c->addLegend(50, 28, false, "arialbd.ttf", 10);
	$legendObj->setBackground(Transparent);

	# Set the x axis labels
	$c->xAxis->setLabels($labels);

	# Draw the ticks between label positions (instead of at label positions)
	$c->xAxis->setTickOffset(0.5);

	# Set axis label style to 8pts Arial Bold
	$c->xAxis->setLabelStyle("arialbd.ttf", 8);
	$c->yAxis->setLabelStyle("arialbd.ttf", 8);

	# Set axis line width to 2 pixels
	$c->xAxis->setWidth(2);
	$c->yAxis->setWidth(2);

	# Add axis title
	$c->yAxis->setTitle("Number Of Tickets");
	$c->xAxis->setTitle("Zones");

	# Add a multi-bar layer with 3 data sets
	$layer = $c->addBarLayer2(Side);
	$SelectStatus = Reports_Statuses();
	$i=1;
	$layer->addDataSet($Test[0], $colors[0], "All");
	while($FetchStatus = mysqli_fetch_array($SelectStatus))
	{
		$layer->addDataSet($Test[$i], $colors[$i], $FetchStatus["name"]);
		$i++;
	}

	# Set bar border to transparent. Use glass lighting effect with light direction from
	# left.
	$layer->setBorderColor(Transparent, glassEffect(NormalGlare, Left));

	# Configure the bars within a group to touch each others (no gap)
	//$layer->setBarGap(0.2, TouchBar);

	# Create the image and save it in a temporary location
	$chart3URL = $c->makeSession("chart3"); 
	# Create an image map for the chart
	$imageMap3 = $c->getHTMLImageMap("#", "", "title='{xLabel}:  {value|0} Tickets'");
	$c->makeChart("C:\\wamp\\www\\serviceprojects\\BBH_Maintenance\\includes\\Zone.png");
	# Output the chart
	//header("Content-type: image/png");
	//print($c->makeChart2(PNG));
	if(!isset($_GET['export']))
	{ ?>
	<div style="width:1350px;height:-550px;overflow-x:scroll;overflow-y:auto;">
		<img src="includes/getchart.php?ComplaintDate=<?php if(isset($_GET['ComplaintDate'])) echo $_GET['ComplaintDate'];?>&ResolvedDate=<?php if(isset($_GET['ResolvedDate'])) echo $_GET['ResolvedDate'];?>&<?php echo $chart3URL;?>" border="0" usemap="#map3">
	</div>
	<br/>
	<?php
	}
	else
	{ ?>
	<img src="C:/wamp/www/serviceprojects/BBH_Maintenance/includes/Zone.png" border="0" usemap="#map2">
	<?php
	}
	?>
	<div height="500px"></div>
	<map name="map3"> <?php echo $imageMap3;?> </map>
	