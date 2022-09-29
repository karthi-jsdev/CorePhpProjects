<?php 
require_once("PhpChartDir.php"); 
include("Config.php");
# The data for the pie chart 
$data = array(); 
# The labels for the pie chart 
//$SelectClassAndSectionNames = Select_Section();
$labels = array(); 
$SelectDepartment = mysqli_query($_SESSION['connection'],"select * from department");
$i = 0;
while($FetchDepartment = mysqli_fetch_array($SelectDepartment))
	$labels[$i++] = $FetchDepartment['name'];

$SelectDepartments = mysqli_query($_SESSION['connection'],"select * from department");
$j = 0;
while($FetchDepartments = mysqli_fetch_array($SelectDepartments))
	$data[$j++] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from staff_admission where department_id='".$FetchDepartments['id']."'"));
# Create a PieChart object of size 450 x 270 pixels 
$c = new PieChart(750, 350); 
# Set the center of the pie at (150, 100) and the radius to 80 pixels 
$c->setPieSize(130, 135, 100); 
# add a legend box where the top left corner is at (330, 50) 
 $legendbox = $c->addLegend(240, 50);
 $legendbox->setCols(2);
 $legendbox->setWidth(200); # modify the sector label format to show percentages only 
$c->setLabelFormat("{percent}%"); # Set the pie data and the pie labels 
$c->setData($data, $labels); # Use rounded edge shading, with a 1 pixel white (FFFFFF) border 
$c->setSectorStyle(RoundedEdgeShading, 0xffffff, 1); 
# Output the chart 
$chart2URL = $c->makeSession("chart2"); 
 # Create an image map for the chart
 $imageMap2 = $c->getHTMLImageMap("#", "", "title='{value|0} Teachers'");
 $c->makeChart("C:\\wamp_server\\www\\serviceprojects\\School_Management\\Code\\includes\\TeachersChart.png");
 //$imageMap2 = $c->getHTMLImageMap("#", "", "title='$labels[1]: {value|0} Machines'");
if(!$_GET['export']) 
{
	?>
		<img src="includes/getchart.php?<?php echo $chart2URL;?>" border="0" usemap="#map2">
	<map name="map2"> <?php echo $imageMap2;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp_server/www/serviceprojects/School_Management/Code/includes/TeachersChart.png" border="0" usemap="#map2">
<td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>