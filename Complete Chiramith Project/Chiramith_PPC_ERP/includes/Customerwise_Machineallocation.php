<?php
 require_once("PhpChartDir.php");
 include("Config.php");
 #include("Dashboard_Queries.php");
 # The data for the pie chart 
 $data = array();
 $labels = array();
 $Customer_Machine = Customer_Machineallocation();
 while($Customer_Machine_Allocation = mysqli_fetch_array($Customer_Machine))
 {
	$data[] = $Customer_Machine_Allocation['totalcount'];
	$labels[] = $Customer_Machine_Allocation['name'];
 }
 # The labels for the pie chart 
 # Create a PieChart object of size 450 x 270 pixels
 $c = new PieChart(450, 270); 
 # Set the center of the pie at (150, 100) and the radius to 80 pixels 
 $c->setPieSize(150, 135, 100);
 # add a legend box where the top left corner is at (330, 50) 
 $c->addLegend(330, 60);
 # modify the sector label format to show percentages only 
 $c->setLabelFormat("{percent}%");
 # Set the pie data and the pie labels 
 $c->setData($data, $labels);
 # Use rounded edge shading, with a 1 pixel white (FFFFFF) border
 $c->setSectorStyle(RoundedEdgeShading, 0xffffff, 1);
 # Output the chart 
 $chart3URL = $c->makeSession("chart3"); 
# Create an image map for the chart
$imageMap4 = $c->getHTMLImageMap("#", "", "title='{value|0} Machine Alloted'");
$c->makeChart("C:\\wamp\\www\\serviceprojects\\Chiramith_PPC_ERP\\includes\\Customerwise_Machineallocation.png");
if(!$_GET['export']) 
{
?>
	<img src="includes/getchart.php?<?php echo $chart3URL;?>" border="0" usemap="#map3">
<map name="map3"> <?php echo $imageMap4;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/Chiramith_PPC_ERP/includes/Customerwise_Machineallocation.png" border="0" usemap="#map2">
<td><br/><br/><br/><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>