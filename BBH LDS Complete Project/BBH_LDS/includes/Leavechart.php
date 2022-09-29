<?php require_once("PhpChartDir.php");
 include("Config.php");
 # The data for the bar chart 
 $data = array(); 
 # The labels for the bar chart 
 $labels = array(date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d')))),date('Y-m-d'),date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+2 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+3 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+4 days', strtotime(date('Y-m-d')))),date('Y-m-d', strtotime('+5 days', strtotime(date('Y-m-d'))))); 
 $data [0] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()-INTERVAL 3 day) || enddate=(CURDATE()-INTERVAL 3 day))"));
 $data [1] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()-INTERVAL 2 day) || enddate=(CURDATE()-INTERVAL 2 day))"));
 $data [2] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()-INTERVAL 1 day) || enddate=(CURDATE()-INTERVAL 1 day))"));
 $data [3] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"SELECT * FROM `leave` WHERE  (`leave`.startdate = CURDATE()) or (`leave`.enddate  = CURDATE())"));
 $data [4] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()+INTERVAL 1 day) || enddate=(CURDATE()+INTERVAL 1 day))"));
 $data [5] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()+INTERVAL 2 day) || enddate=(CURDATE()+INTERVAL 2 day))"));
 $data [6] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()+INTERVAL 3 day) || enddate=(CURDATE()+INTERVAL 3 day))"));
 $data [7] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()+INTERVAL 4 day) || enddate=(CURDATE()+INTERVAL 4 day))"));
 $data [8] = mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from `leave` where (startdate=(CURDATE()+INTERVAL 5 day) || enddate=(CURDATE()+INTERVAL 5 day))"));
 # Create a XYChart object of size 600 x 360 pixels 
 $c = new XYChart(1000, 360);
 # Add a title to the chart using 18pts Times Bold Italic font 
 
 $c->addTitle("Leave Status", "timesbi.ttf", 18); 

 # Set the plotarea at (60, 40) and of size 500 x 280 pixels. Use a vertical gradient 
 # color from light blue (eeeeff) to deep blue (0000cc) as background. Set border and
 # grid lines to white (ffffff). 
 $c->setPlotArea(60, 40, 800, 280, $c->linearGradientColor(60, 40, 50, 280, 0xeeeeff, 0x0000cc), -1, 0xffffff, 0xffffff); 
 # Add a multi-color bar chart layer using the supplied data. Use soft lighting effect # with light direction from left.
 $barLayerObj = $c->addBarLayer3($data); 
 $barLayerObj->setBorderColor(Transparent, softLighting(Left));
 # Set x axis labels using the given labels 
 $c->xAxis->setLabels($labels); 
 # Draw the ticks between label positions (instead of at label positions) 
 $c->xAxis->setTickOffset(0.5); 
 # Add a title to the y axis with 10pts Arial Bold font 
 $c->yAxis->setTitle("Number Of Persons (On Leave)", "arialbd.ttf", 10); 
 #$c->xAxis->setTitlePos("TopLeft",20);
 # Set axis label style to 8pts Arial Bold 
 $c->xAxis->setLabelStyle("arialbd.ttf", 8);
 $c->yAxis->setLabelStyle("arialbd.ttf", 8); 
 # Set axis line width to 2 pixels 
 $c->xAxis->setWidth(2); 
 $c->yAxis->setWidth(2); 
 # Output the chart 
# Create the image and save it in a temporary location
$chart4URL = $c->makeSession("chart4"); 
# Create an image map for the chart
$imageMap4 = $c->getHTMLImageMap("", "", "title='{xLabel}:  {value|0} Persons'");
$c->makeChart("C:\\wamp_server\\www\\serviceprojects\\BBH_LDS\\includes\\Leave_Chart.png");
# Output the chart
//header("Content-type: image/png");
//print($c->makeChart2(PNG));
if(!isset($_GET['export']))
{ ?>
<img src="includes/getchart.php?<?php echo $chart4URL;?>" border="0" usemap="#map4">
<?php
}
else
{ ?>

<img src="C:/wamp_server/www/serviceprojects/BBH_LDS/includes/Leave_Chart.png" border="0" usemap="#map4">
<?php
}
?>
<map name="map4"> <?php echo $imageMap4;?> </map> 