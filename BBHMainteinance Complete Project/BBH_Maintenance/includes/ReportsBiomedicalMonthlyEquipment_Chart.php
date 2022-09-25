<?php
require_once("PhpChartDir.php");
include("Config.php");
//include("Reports_Queries.php");
//json_decode($_GET['Allslips']);
# The data for the bar chart 
$Availability = array();
$NonAvailability = array();
if($_GET['chart'])
{
	$Months =date('F', strtotime(''.($_GET['Month']).' month'));
	$num = cal_days_in_month(CAL_GREGORIAN, date("".$_GET['Month'].""), date("".$_GET['Year'].""));
	$TotalDays =  explode("-",date("".$_GET['Year']."-".$_GET['Month']."-".$num));
	$AvailableNon = mysqli_fetch_array(BiomedicalKPIReports_All_Month_And_Year(($_GET['Month']),$_GET['Year']));
	$Totalworkinghours = $TotalDays[2]*24*$AvailableNon['critical_equipment'];
	$Breakdownhours = ((strtotime($AvailableNon['enddate'])-strtotime($AvailableNon['startdate']))/3600);
	$Actualworkinghours = $Totalworkinghours - $Breakdownhours;
	$Availability[] = (($Actualworkinghours/$Totalworkinghours)*100);
	$NonAvailability[] = (($Breakdownhours/$Totalworkinghours)*100);
	$data0 = array($Availability[0],$NonAvailability[0]);   
	$labels = array("Availability In %","Non-Availability In %"); 
}	
else
{	
	$Months =date('F', strtotime(''.($_GET['Month']-7).' month'));
	$num = cal_days_in_month(CAL_GREGORIAN, date("".date('m').""), date("".$_GET['Year'].""));
	$TotalDays =  explode("-",date("".$_GET['Year']."-".date('m')."-".$num));
	$AvailableNon = mysqli_fetch_array(BiomedicalKPIReports_All_Month_And_Year(date('m'),$_GET['Year']));
	$Totalworkinghours = $TotalDays[2]*24*$AvailableNon['critical_equipment'];
	$Breakdownhours = ((strtotime($AvailableNon['enddate'])-strtotime($AvailableNon['startdate']))/3600);
	$Actualworkinghours = $Totalworkinghours - $Breakdownhours;
	$Availability[] = (($Actualworkinghours/$Totalworkinghours)*100);
	$NonAvailability[] = (($Breakdownhours/$Totalworkinghours)*100);
	$data0 = array($Availability[0],$NonAvailability[0]);   
	$labels = array("Availability In %","Non-Availability In %"); 
}


# Create a XYChart object of size 540 x 375 pixels 
$c = new XYChart(950, 375); 

# Add a title to the chart using 18 pts Times Bold Italic font 
$c->addTitle("Critical Equipment Status", "timesbi.ttf", 18); 

# Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical 
# gradient color from grey (888888) to black (000000) as background. Set border and 
# grid lines to white (ffffff). 
$c->setPlotArea(50, 55, 350, 280, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff); 

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
$c->yAxis->setTitle("No of Critical Equipments"); 

# Add a multi-bar layer with 3 data sets and 4 pixels 3D depth 
$layer = $c->addBarLayer2(Side, 4); 
$layer->addDataSet($data0, 0x66aaee, $Months); 

# Set bar border to transparent. Use bar gradient lighting with light intensity from # 0.75 to 1.75. 
$layer->setBorderColor(Transparent, barLighting(0.75, 1.75)); 

# Configure the bars within a group to touch each others (no gap) 
//$layer->setBarGap(0.2, TouchBar); 

# Create the image and save it in a temporary location
$chart7URL = $c->makeSession("chart7"); 
# Create an image map for the chart
$imageMap7 = $c->getHTMLImageMap("", "", "title='{xLabel}:  {value|2} %Equipments'");
$c->makeChart("C:\\wamp\\www\\serviceprojects\\BBH_Maintenance\\includes\\BiomedicalMonthlyReports_Chart.png");
# Output the chart
//header("Content-type: image/png");
//print($c->makeChart2(PNG));
if(!isset($_GET['export']))
{ ?>
<img src="includes/getchart.php?<?php echo $chart7URL;?>" border="0" usemap="#map7">
<?php
}
else
{ ?>

<img src="C:/wamp/www/serviceprojects/BBH_Maintenance/includes/BiomedicalMonthlyReports_Chart.png" border="0" usemap="#map7">
<?php
}
?>
<map name="map7"> <?php echo $imageMap7;?> </map> 