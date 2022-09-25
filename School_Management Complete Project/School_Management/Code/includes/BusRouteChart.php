<?php 
require_once("PhpChartDir.php"); 
include("Config.php");
# Data for the chart
$data0 = array(); 
$data1 = array();
$data2 = array(); 
$labels = array(); 
$SelectBusRoute = mysql_query("SELECT b1.id,b1.name FROM `busroute` b1 JOIN busroute b2 ON b1.name=b2.name group by b1.name");
//$i = mysql_num_rows(mysql_query("SELECT b1.id,b1.name FROM `busroute` b1 JOIN busroute b2 ON b1.name=b2.name group by b1.name"));
while($FetchBusRoute = mysql_fetch_array($SelectBusRoute))
{
		$SelectBusId = mysql_query("Select * from busroute where name='".$FetchBusRoute['name']."' order by timings asc");
		$labels[] = $FetchBusRoute['name'];
		$test = array();
		while($FetchBusId = mysql_fetch_array($SelectBusId))
		{
			$FetchQuery7 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusId['id']."' and busroute_id in(select id from busroute where timings like '7%')"));
			$FetchQuery8 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusId['id']."' and busroute_id in(select id from busroute where timings like '8%')"));
			$FetchQuery9 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusId['id']."' and busroute_id in(select id from busroute where timings like '9%')"));
			if(count($data0) == 0)
			{
				$test[0] = $FetchQuery7['total'];
				$test[1] = $FetchQuery8['total'];
				$test[2] = $FetchQuery9['total'];
			}
			else
			{
				$Index = count($data0);
				if($FetchQuery7['total'])
					$test[0] = $FetchQuery7['total'];
				if($FetchQuery8['total'])
					$test[1] = $FetchQuery8['total'];
				if($FetchQuery9['total'])
					$test[2] = $FetchQuery9['total'];
			}
		}
		$data0[] = $test[0];
		$data1[] = $test[1];
		$data2[] = $test[2];
		echo '<br/>';
	/*if(!in_array($FetchBusRoute['name'],$labels))
	{
		$labels[] = $FetchBusRoute['name'];
	}*/
	/*$FetchQuery7 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusRoute['id']."' and busroute_id in(select id from busroute where timings like '7%')"));
	$FetchQuery8 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusRoute['id']."' and busroute_id in(select id from busroute where timings like '8%')"));
	$FetchQuery9 = mysql_fetch_array(mysql_query("select count(*) as total from student_admission where busroute_id='".$FetchBusRoute['id']."' and busroute_id in(select id from busroute where timings like '9%')"));
	$data0[] = $FetchQuery7['total'];
	$data1[] = $FetchQuery8['total'];
	$data2[] = $FetchQuery9['total'];
	if(!in_array($FetchBusRoute['name'],$labels))
	{
		$labels[] = $FetchBusRoute['name'];
	}	$i++;*/
}
# Create a XYChart object of size 560 x 280 pixels. 
$c = new XYChart(560, 280); 
# Add a title to the chart using 14 pts Arial Bold Italic font 
$c->addTitle("Busroute Summary", "arialbi.ttf", 14); 
# Set the plotarea at (50, 50) and of 500 x 200 pixels in size. Use alternating light # grey (f8f8f8) / white (ffffff) background. Set border to transparent and use grey # (CCCCCC) dotted lines as horizontal and vertical grid lines 
$c->setPlotArea(50, 50, 500, 200, 0xffffff, 0xf8f8f8, Transparent, $c->dashLineColor( 0xcccccc, DotLine), $c->dashLineColor(0xcccccc, DotLine)); 
# Add a legend box at (50, 22) using horizontal layout. Use 10 pt Arial Bold Italic # font, with transparent background 
$legendObj = $c->addLegend(50, 22, false, "arialbi.ttf", 10); 
$legendObj->setBackground(Transparent); 
# Set the x axis labels 
$c->xAxis->setLabels($labels); 
# Draw the ticks between label positions (instead of at label positions) 
$c->xAxis->setTickOffset(0.5); 
# Add axis title 
$c->yAxis->setTitle("Throughput (MBytes Per Hour)"); 
# Set axis line width to 2 pixels 
$c->xAxis->setWidth(2); 
$c->yAxis->setWidth(2); 
# Add a multi-bar layer with 3 data sets 
$layer = $c->addBarLayer2(Side); 
$layer->addDataSet($data0, 0xff0000, "7 PM"); 
$layer->addDataSet($data1, 0x00ff00, "8 PM"); 
$layer->addDataSet($data2, 0x0000ff, "9 PM"); 
# Set bar shape to circular (cylinder) 
$layer->setBarShape(CircleShape); 
# Configure the bars within a group to touch each others (no gap) 
$layer->setBarGap(0.2, TouchBar); 
# Output the chart 
$chart3URL = $c->makeSession("chart3"); 
 # Create an image map for the chart
 $imageMap3 = $c->getHTMLImageMap("#", "", "title='{value|0} Students'");
 $c->makeChart("C:\\wamp_server\\www\\serviceprojects\\School_Management\\Code\\includes\\BusRouteChart.png");
 //$imageMap2 = $c->getHTMLImageMap("#", "", "title='$labels[1]: {value|0} Machines'");
if(!$_GET['export']) 
{ ?>
	<img src="includes/getchart.php?<?php echo $chart3URL;?>" border="0" usemap="#map3" />
	<map name="map3"> <?php echo $imageMap3;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp_server/www/serviceprojects/School_Management/Code/includes/BusRouteChart.png" border="0" usemap="#map3" />
	<td><br/><br/><br/><br/><br/><br/></td>
<?php
} ?>