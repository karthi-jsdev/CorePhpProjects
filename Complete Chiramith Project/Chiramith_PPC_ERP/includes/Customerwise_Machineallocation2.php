<?php
 require_once("PhpChartDir.php");
 include("Config.php");
 #include("Dashboard_Queries.php");
 # The data for the bar chart 
 $data0 = array();
 $labels = array();
 $i =0 ;
 $Customer_Machine = Customer_Machineallocation();
 while($Customer_Machine_Allocation = mysqli_fetch_array($Customer_Machine))
 {
	$data0[] = $Customer_Machine_Allocation['totalcount'];
	$labels[] = $Customer_Machine_Allocation['name'];
	$i++;
 }
 # Create a XYChart object of size 540 x 375 pixels 
	if($i>5)
		$c = new XYChart(170*$i, 375);
	else
		$c = new XYChart(170*5, 375);
 # Add a title to the chart using 18 pts Times Bold Italic font
 //$c->addTitle("Customer Wise Machine Allocation Percentage", "timesbi.ttf", 18);
 # Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical
 # gradient color from grey (888888) to black (000000) as background. Set border and # grid lines to white (ffffff). 
 //$c->setPlotArea(50, 55, 440, 280, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff); 
 $c->setPlotArea(50, 55, 33*$i, 280, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff);
 # Add a legend box at (50, 25) using horizontal layout. Use 10pts Arial Bold as font, 
 # with transparent background. 
 $legendObj = $c->addLegend(50, 25, false, "arialbd.ttf", 10); 
 $legendObj->setBackground(Transparent);
 # Set the x axis labels 
 //$c->xAxis->setLabels($labels); 
 # Draw the ticks between label positions (instead of at label positions)
 $c->xAxis->setTickOffset(0.5);
 # Set axis label style to 8pts Arial Bold
 $c->xAxis->setLabelStyle("arial.ttf", 8);
 $c->yAxis->setLabelStyle("arialbd.ttf", 8); 
 # Set axis line width to 2 pixels 
 $c->xAxis->setWidth(2); 
 $c->yAxis->setWidth(2);
 # Add axis title 
 $c->yAxis->setTitle("Total Machines");
 # Set the labels on the x axis. Rotate the labels by 45 degrees. 
 $labelsObj = $c->xAxis->setLabels($labels);
 $labelsObj->setFontAngle(20);
 # Add a multi-bar layer with 3 data sets and 4 pixels 3D depth
 $layer = $c->addBarLayer2(Side, 4);
 $layer->addDataSet($data0, 0x66aaee, "Alloted Machines");
 # Set bar border to transparent. Use bar gradient lighting with light intensity from # 0.75 to 1.75.
 $layer->setBorderColor(Transparent, barLighting(0.75, 1.75));
 # Configure the bars within a group to touch each others (no gap)
 $layer->setBarGap(0.2, TouchBar); 
 # Output the chart
 
# Create the image and save it in a temporary location
$chart5URL = $c->makeSession("chart5"); 
# Create an image map for the chart
$imageMap5 = $c->getHTMLImageMap("", "", "title='{xLabel}:  {value|0} Machine Alloted'"); 
$c->makeChart("C:\\wamp\\www\\serviceprojects\\Chiramith_PPC_ERP\\includes\\Customerwise_Machineallocation2.png");
if(!$_GET['export']) 
{
 ?>
 <div style="width:970px;overflow-x:scroll;overflow-y:auto;">
	<img src="includes/getchart.php?<?php echo $chart5URL;?>" border="0" usemap="#map5">
</div>
 <map name="map5"> <?php echo $imageMap5;?> </map> 
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/Chiramith_PPC_ERP/includes/Customerwise_Machineallocation2.png" border="0" usemap="#map5">
<td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>