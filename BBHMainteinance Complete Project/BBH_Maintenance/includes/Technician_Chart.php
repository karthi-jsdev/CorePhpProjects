<?php	
	require_once("PhpChartDir.php");
	include("Config.php");
	//include("Reports_Queries.php");
	$Test = array();
	$Test[] = array();
	$colors = array(0xFF99CC,0x990000,0x9999CC,0x996600,0x9933CC,0xCCCC33,0xFF6600,0x99CC33);
	$labels = array(); 
	$ExplodeTechnicians= array();
	$TechnicianNames = array();
	$i = 0;
	if($_SESSION['roleid'] == '5')
	{
		$SelectGroup = Reports_Technician();
		while($FetchGroup = mysqli_fetch_array($SelectGroup))
		{
			$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($FetchGroup['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status1 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '1',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status2 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '2',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status3 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '3',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status4 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '4',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status5 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '5',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status6 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '6',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			$Reports_By_Technician_And_Status7 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($FetchGroup['id'],$StatusId = '7',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
			if($Reports_By_Technician['total'])
			{
				$labels[] =  $FetchGroup['firstname'];
				$TechnicianNames[] = $ExplodeTechnician;
				$Test[0][$i] = $Reports_By_Technician['total'];
				$Test[1][$i] = $Reports_By_Technician_And_Status1['total'];
				$Test[2][$i] = $Reports_By_Technician_And_Status2['total'];
				$Test[3][$i] = $Reports_By_Technician_And_Status3['total'];
				$Test[4][$i] = $Reports_By_Technician_And_Status4['total'];
				$Test[5][$i] = $Reports_By_Technician_And_Status5['total'];
				$Test[6][$i] = $Reports_By_Technician_And_Status6['total'];
				$Test[7][$i] = $Reports_By_Technician_And_Status7['total'];
				$i++;
			}
		}
	}
	else if($_SESSION['roleid'] == '1')
	{
		
		//$i = 0;
		$selectSub_Department = Reports_Sub_Department($_SESSION['groupid']);
		while($FetchTechnician = mysqli_fetch_array($selectSub_Department))
		{
		$ExplodeTechnicians = explode(".",$FetchTechnician['users']);
		foreach($ExplodeTechnicians as $ExplodeTechnician)
		{
			if(!in_array($ExplodeTechnician,$TechnicianNames,true))
			{
				$TechnicianName = mysqli_fetch_array(Report_User($ExplodeTechnician));
				$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($TechnicianName['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status1 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '1',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status2 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '2',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status3 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '3',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status4 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '4',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status5 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '5',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status6 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '6',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				$Reports_By_Technician_And_Status7 = mysqli_fetch_array(Reports_By_Technician_And_Status_With_Dates($TechnicianName['id'],$StatusId = '7',$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				if(mysql_num_rows)
				{
					$labels[] =  $TechnicianName['firstname'];
					$TechnicianNames[] = $ExplodeTechnician;
					$Test[0][$i] = $Reports_By_Technician['total'];
					$Test[1][$i] = $Reports_By_Technician_And_Status1['total'];
					$Test[2][$i] = $Reports_By_Technician_And_Status2['total'];
					$Test[3][$i] = $Reports_By_Technician_And_Status3['total'];
					$Test[4][$i] = $Reports_By_Technician_And_Status4['total'];
					$Test[5][$i] = $Reports_By_Technician_And_Status5['total'];
					$Test[6][$i] = $Reports_By_Technician_And_Status6['total'];
					$Test[7][$i] = $Reports_By_Technician_And_Status7['total'];
					$i++;
				}
			}
		}
		}
	}
	# Create a XYChart object of size 540 x 375 pixels
	if($i>5)
		$c = new XYChart(170*$i, 375);
	else
		$c = new XYChart(170*5, 375);
	
	# Add a title to the chart using 18 pts Times Bold Italic font
	//$c->addTitle("Number Of Tickets Technician Wise", "timesbi.ttf", 18);
	//echo "<h3><b>Number Of Tickets Technician Wise</b></h3>";
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
	$c->xAxis->setTitle("Technicians");

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
	$chart2URL = $c->makeSession("chart2"); 
	# Create an image map for the chart
	$imageMap2 = $c->getHTMLImageMap("#", "", "title='{xLabel}:  {value|0} Tickets'");
	$c->makeChart("C:\\wamp\\www\\serviceprojects\\BBH_Maintenance\\includes\\Technician.png");
	# Output the chart
	//header("Content-type: image/png");
	//print($c->makeChart2(PNG));
	if(!isset($_GET['export']))
	{ ?>
	<div style="width:1350px;height:-550px;overflow-x:scroll;overflow-y:auto;">
		<img src="includes/getchart.php?ComplaintDate=<?php if(isset($_GET['ComplaintDate'])) echo $_GET['ComplaintDate'];?>&ResolvedDate=<?php if(isset($_GET['ResolvedDate'])) echo $_GET['ResolvedDate'];?>&<?php echo $chart2URL;?>" border="0" usemap="#map2">
	</div>
	<br/><br/>
	<?php
	}
	else
	{ ?>	
	<img src="C:/wamp/www/serviceprojects/BBH_Maintenance/includes/Technician.png" border="0" usemap="#map2">
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<?php
	}
	?>
	<div height="500px"></div>
	<map name="map2"> <?php echo $imageMap2;?> </map> 