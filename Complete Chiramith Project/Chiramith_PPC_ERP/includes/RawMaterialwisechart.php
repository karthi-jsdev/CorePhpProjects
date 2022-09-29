<?php
 require_once("PhpChartDir.php");
 include("Config.php");
 #include("Dashboard_Queries.php");
 # The data for the pie chart 
 $data = array();
 $labels = array();
 $Raw_Material_Machine = Raw_Material_Machineallocation();
 #$Raw_Material_Machine = Raw_Material_Product();
 while($Raw_Material_Machine_Allocation = mysqli_fetch_array($Raw_Material_Machine))
 {
	$data[] = $Raw_Material_Machine_Allocation['totalcount'];
	$labels[] = $Raw_Material_Machine_Allocation['material_type'];
 }
 #$data = array(25, 18, 15, 12, 8, 30, 35); 
 # The labels for the pie chart 
 # $labels = array("Labor", "Licenses", "Taxes", "Legal", "Insurance", "Facilities", "Production"); 
 # Create a PieChart object of size 450 x 270 pixels
 $c = new PieChart(750, 350); 
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
 $chart4URL = $c->makeSession("chart4"); 
 # Create an image map for the chart
 $imageMap4 = $c->getHTMLImageMap("#", "", "title='{value|0} Job'");
  $c->makeChart("C:\\wamp\\www\\serviceprojects\\Chiramith_PPC_ERP\\includes\\RawMaterialwisechart.png");
if(!$_GET['export']) 
{
	?>
		<img src="includes/getchart.php?<?php echo $chart4URL;?>" border="0" usemap="#map4">
	<map name="map4"> <?php echo $imageMap4;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/Chiramith_PPC_ERP/includes/RawMaterialwisechart.png" border="0" usemap="#map4">
	<td><br/><br/><br/><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>