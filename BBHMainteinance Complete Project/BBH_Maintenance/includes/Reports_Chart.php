<?php
require_once("PhpChartDir.php");
include("Config.php");
//include("Reports_Queries.php");
//json_decode($_GET['Allslips']);
# The data for the bar chart 
$AllTickets = array();
$OnTime = array();
$Completed24Hours = array();
$Day7 = array();
$Day15 = array();
$Day30 = array();
$Pending = array();
if(!$_GET['Year'])
{
	$Months = Array(date('F', strtotime(''.($_GET['Month']-7).' month')),date('F', strtotime(''.($_GET['Month']-8).' month')),date('F', strtotime(''.($_GET['Month']-9).' month')));
	$i = 0;
	for($i = 0; $i < count($Months); $i++)
	{
		$AllTickets[] = KPI_CallSplip_CurrentMonth(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$OnTime[] = KPI_CallSplip_CurrentMonth_12Hours(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$Completed24Hours[] = KPI_CallSplip_CurrentMonth_24Hours(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$Day7[] = KPI_CallSplip_CurrentMonth_7Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$Day15[] = KPI_CallSplip_CurrentMonth_15Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$Day30[] = KPI_CallSplip_CurrentMonth_30Days(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
		$Pending[] = KPI_CallSplip_Pending(date('Y-m-d', strtotime('first day of '.(($_GET['Month']-7)-$i).' month', time())),date('Y-m-d', strtotime('last day of '.(($_GET['Month']-7)-$i).' month', time())));
	}
}
else
{
	$Months = Array(date('F', strtotime(''.($_GET['Month']).' month')),date('F', strtotime(''.($_GET['Month']-1).' month')),date('F', strtotime(''.($_GET['Month']-2).' month')));
	$i = 0;
	for($i = 0; $i < count($Months); $i++)
	{
		$AllTickets[] = KPI_CallSplip_CurrentMonth(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$OnTime[] = KPI_CallSplip_CurrentMonth_12Hours(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$Completed24Hours[] = KPI_CallSplip_CurrentMonth_24Hours(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$Day7[] = KPI_CallSplip_CurrentMonth_7Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$Day15[] = KPI_CallSplip_CurrentMonth_15Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$Day30[] = KPI_CallSplip_CurrentMonth_30Days(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
		$Pending[] = KPI_CallSplip_Pending(date($_GET['Year'].'-m-d', strtotime('first day of '.(($_GET['Month'])-$i).' month', time())),date($_GET['Year'].'-m-d', strtotime('last day of '.(($_GET['Month'])-$i).' month', time())));
	}
}
$data0 = array($AllTickets[0],$OnTime[0],$Completed24Hours[0],$Day7[0],$Day15[0],$Day30[0],$Pending[0]); 
$data1 = array($AllTickets[1],$OnTime[1],$Completed24Hours[1],$Day7[1],$Day15[1],$Day30[1],$Pending[1]);  
$data2 = array($AllTickets[2],$OnTime[2],$Completed24Hours[2],$Day7[2],$Day15[2],$Day30[2],$Pending[2]);  
$labels = array("No.Of.Slips","OnTime","Completed24Hours","Within 7 Days", "Within 15 Days","Within a Month","Pending"); 

# Create a XYChart object of size 540 x 375 pixels 
$c = new XYChart(950, 375); 

# Add a title to the chart using 18 pts Times Bold Italic font 
$c->addTitle("Call Slips", "timesbi.ttf", 18); 

# Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical 
# gradient color from grey (888888) to black (000000) as background. Set border and 
# grid lines to white (ffffff). 
$c->setPlotArea(50, 55, 750, 280, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff); 

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
$c->yAxis->setTitle("No of Tickets"); 

# Add a multi-bar layer with 3 data sets and 4 pixels 3D depth 
$layer = $c->addBarLayer2(Side, 4); 
$layer->addDataSet($data0, 0x66aaee, $Months[0]); 
$layer->addDataSet($data1, 0xeebb22, $Months[1]); 
$layer->addDataSet($data2, 0xcc0000, $Months[2]); 

# Set bar border to transparent. Use bar gradient lighting with light intensity from # 0.75 to 1.75. 
$layer->setBorderColor(Transparent, barLighting(0.75, 1.75)); 

# Configure the bars within a group to touch each others (no gap) 
//$layer->setBarGap(0.2, TouchBar); 

# Create the image and save it in a temporary location
$chart4URL = $c->makeSession("chart4"); 
# Create an image map for the chart
$imageMap4 = $c->getHTMLImageMap("", "", "title='{xLabel}:  {value|0} Tickets'");
$c->makeChart("C:\\wamp\\www\\serviceprojects\\BBH_Maintenance\\includes\\Reports_Chart.png");
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

<img src="C:/wamp/www/serviceprojects/BBH_Maintenance/includes/Reports_Chart.png" border="0" usemap="#map4">
<?php
}
?>
<map name="map4"> <?php echo $imageMap4;?> </map> 