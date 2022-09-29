<?php
	require_once("PhpChartDir.php");
	include("Config.php");
	#include("Dashboard_Queries.php");	
	# The data for the bar chart 
	$labels = array();
	$data0 = array();
	$data1 = array();
	$data2 = array();
	/*$FetchMachine = Select_MachineId();
	$TotalMachine = $TotalRunning = $Total = 0;
	while($FetchSections = mysqli_fetch_array($FetchMachine))
	{
		$MachineId = $FetchSections['MachineId'];
		$TotalMachine += $MachineId;
		$JobMachineId = $FetchSections['JobMachineId'];
		$TotalRunning += $JobMachineId;
		$TotalRunningAndAvailable = $MachineId+$JobMachineId;
		$Total += $TotalRunningAndAvailable;
		$FetchSections = mysqli_fetch_array(Select_Sections($FetchSections['section_id']));
		$labels[] = "Section ".$FetchSections['name'];
		$data2[] = $JobMachineId;
		$data1[] = ($MachineId-$JobMachineId);
		$data0[] = $MachineId;
	}*/
	$SectionMachineAllocation = SectionWiseMachineAllocation();
	while($SectionAllocation = mysqli_fetch_array($SectionMachineAllocation))
	{
		
		$Sections = mysqli_fetch_array(Section_Name($SectionAllocation['section_id']));
		$AvailableMachines = $SectionAllocation['MachineId'] - $SectionAllocation['JobMachineId'];
		$labels[] = "Section ".$Sections['name'];
		$data0[] = $SectionAllocation['MachineId'];
		$data1[] = $AvailableMachines;
		$data2[] = $SectionAllocation['JobMachineId'];
	}
	# Create a XYChart object of size 540 x 375 pixels 
	$c = new XYChart(540, 375); 
	# Add a title to the chart using 18 pts Times Bold Italic font
	$c->addTitle("", "", 11);
	# Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical
	# gradient color from grey (888888) to black (000000) as background. Set border and # grid lines to white (ffffff). 
	$c->setPlotArea(50, 55, 440, 280, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff); 
	# Add a legend box at (50, 25) using horizontal layout. Use 10pts Arial Bold as font, 
	# with transparent background. 
	$legendObj = $c->addLegend(50, 25, false, "arialbd.ttf", 10); 
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
	$c->yAxis->setTitle("Number Of Machines");
	# Add a multi-bar layer with 3 data sets and 4 pixels 3D depth
	$layer = $c->addBarLayer2(Side, 4);
	$layer->addDataSet($data0, 0x66aaee, "Total Machines");
	$layer->addDataSet($data1, 0xeebb22, "Available Machines");
	$layer->addDataSet($data2, 0xeebbee, "Alloted Machines");
	# Set bar border to transparent. Use bar gradient lighting with light intensity from # 0.75 to 1.75.
	$layer->setBorderColor(Transparent, barLighting(0.75, 1.75));
	# Configure the bars within a group to touch each others (no gap)
	#$layer->setBarGap(0.2, TouchBar); 
	# Output the chart

	# Create the image and save it in a temporary location
	$chart2URL = $c->makeSession("chart2"); 
	# Create an image map for the chart
	$imageMap2 = $c->getHTMLImageMap("", "", "title='{xLabel}:  {value|0} Machines'"); 
	$c->makeChart("C:\\wamp\\www\\serviceprojects\\Chiramith_PPC_ERP\\includes\\SectionwiseMachineallocation.png");
if(!$_GET['export']) 
{
 ?>
<img src="includes/getchart.php?<?php echo $chart2URL;?>" border="0"  usemap="#map2">
<map name="map2"><?php echo $imageMap2;?></map>
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/Chiramith_PPC_ERP/includes/SectionwiseMachineallocation.png" border="0" usemap="#map2">
	<td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
<?php
}
?>