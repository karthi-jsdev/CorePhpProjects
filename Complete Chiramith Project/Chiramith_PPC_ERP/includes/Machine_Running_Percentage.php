<?php
 require_once("PhpChartDir.php");
 include("Config.php");
 #include("Dashboard_Queries.php");
 # The data for the pie chart 
 $Total_Machine_Number = Total_Machine();
 $Total_Numbers = mysql_num_rows($Total_Machine_Number);
 $Machine = Machine_Working();
 $Machine_Number = mysql_num_rows($Machine);
 $Machine_Not_Working = $Total_Numbers - $Machine_Number;
 $data = array($Machine_Not_Working,$Machine_Number); 
 # The labels for the pie chart 
 $labels = array("Machine Not Running", "Machine Running"); 
 # Create a PieChart object of size 450 x 270 pixels
 $c = new PieChart(450, 270); 
 # Set the center of the pie at (150, 100) and the radius to 80 pixels 
 $c->setPieSize(150, 135, 100);
 # add a legend box where the top left corner is at (330, 50) 
 $c->addLegend(270, 10);
 # modify the sector label format to show percentages only 
 $c->setLabelFormat("{percent}%");
 # Set the pie data and the pie labels 
 $c->setData($data, $labels);
 # Use rounded edge shading, with a 1 pixel white (FFFFFF) border
 $c->setSectorStyle(RoundedEdgeShading, 0xffffff, 1);
 # Output the chart 
 $chart1URL = $c->makeSession("chart1"); 
 # Create an image map for the chart
 $imageMap1 = $c->getHTMLImageMap("#", "", "title='{value|0} Machines'");
 $c->makeChart("C:\\wamp\\www\\serviceprojects\\Chiramith_PPC_ERP\\includes\\Machine_Running_Percentage.png");
 //$imageMap2 = $c->getHTMLImageMap("#", "", "title='$labels[1]: {value|0} Machines'");
if(!$_GET['export']) 
{
	?>
		<img src="includes/getchart.php?<?php echo $chart1URL;?>" border="0" usemap="#map1">
	<map name="map1"> <?php echo $imageMap1;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/Chiramith_PPC_ERP/includes/Machine_Running_Percentage.png" border="0" usemap="#map1">
<td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>