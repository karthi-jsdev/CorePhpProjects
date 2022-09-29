<?php 
require_once("PhpChartDir.php"); 
include("Config.php");
include("Students Queries.php");
# The data for the pie chart 
$data = array(); 
# The labels for the pie chart 
//$SelectClassAndSectionNames = Select_Section();
$labels = array(); 
$i=0;
$SelectClassAndSectionNames = mysqli_query($_SESSION['connection'],"select section.id as SectionId,class.name as ClassName,section.name as SectionName,class.id as ClassId from section join class on section.classid=class.id");
while($FetchClassAndSectionNames = mysqli_fetch_array($SelectClassAndSectionNames))
{
	$labels[$i] = $FetchClassAndSectionNames['ClassName']."/".$FetchClassAndSectionNames['SectionName'];
	$i++;
} 
$j=0;
$SelectSections = mysqli_query($_SESSION['connection'],"select * from section");
while($FetchSections = mysqli_fetch_array($SelectSections))
{
	$data[$j++] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from student_admission where section_id='".$FetchSections['id']."'"));
}
/*$FetchStudentsCount = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select count(*) as total from student_admission where section_id='".$SelectClassAndSectionNames['SectionId']."'"));
	if($FetchStudentsCount['total'])
	{
		$data[$i] = $FetchStudentsCount['total'];
		$labels[$i] = $FetchClassAndSectionNames['ClassName']."/".$FetchClassAndSectionNames['SectionName'];
		$i++;
	}*/
# Create a PieChart object of size 450 x 270 pixels 
$c = new PieChart(750, 350); 
# Set the center of the pie at (150, 100) and the radius to 80 pixels 
$c->setPieSize(150, 135, 100); 
# add a legend box where the top left corner is at (330, 50) 
# modify the sector label format to show percentages only 
 $legendbox = $c->addLegend(330, 60);
 $legendbox->setCols(2);
 $legendbox->setWidth(300);
$c->setLabelFormat("{percent}%"); # Set the pie data and the pie labels 
$c->setData($data, $labels); # Use rounded edge shading, with a 1 pixel white (FFFFFF) border 
$c->setSectorStyle(RoundedEdgeShading, 0xffffff, 1); 
# Output the chart 
$chart1URL = $c->makeSession("chart1"); 
 # Create an image map for the chart
 $imageMap1 = $c->getHTMLImageMap("#", "", "title='{value|0} Students'");
 $c->makeChart("C:\\wamp_server\\www\\serviceprojects\\School_Management\\Code\\includes\\StudentChart.png");
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
	<img src="C:/wamp_server/www/serviceprojects/School_Management/Code/includes/StudentChart.png" border="0" usemap="#map2">
<td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>