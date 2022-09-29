<?php require_once("PhpChartDir.php");
include("Config.php");
 # The data for the bar chart
 $data1 = array(); 
 $labels = array(); 
 $SelectRawmeterials = mysqli_query($_SESSION['connection'],"select SUM(stock.quantity) as quantity,rawmaterial.materialcode as code from rawmaterial JOIN batch ON batch.rawmaterialid=rawmaterial.id JOIN stock ON stock.batchid=batch.id where categoryid='".$_GET['Category']."' group by rawmaterial.id");
 $i =0;
 while($FetchRawmeterials = mysqli_fetch_array($SelectRawmeterials))
 {
	$labels[$i] = $FetchRawmeterials['code'];
	$data1[$i] = $FetchRawmeterials['quantity'];
	$i++;
 }
 # Create a XYChart object of size 540 x 375 pixels 
 $c = new XYChart(540, 375); 
 # Add a title to the chart using 18 pts Times Bold Italic font 
 echo "<font size='3'><b><i>Stock Quantity By RawMaterial</i></b></font>";
 # Set the plotarea at (50, 55) and of 440 x 280 pixels in size. Use a vertical 
 # gradient color from grey (888888) to black (000000) as background. Set border and 
 # grid lines to white (ffffff). 
 $c->setPlotArea(50, 55, 140, 300, $c->linearGradientColor(0, 55, 0, 335, 0x888888, 0x000000), -1, 0xffffff, 0xffffff); 
 # Add a legend box at (50, 25) using horizontal layout. Use 10pts Arial Bold as font, 
 # with transparent background. 
 //$legendObj = $c->addLegend(50, 25, false, "arialbd.ttf", 10); 
 //$legendObj->setBackground(Transparent); 
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
 $c->yAxis->setTitle("Throughput (MBytes Per Hour)"); 
 # Add a multi-bar layer with 3 data sets and 4 pixels 3D depth 
 $layer = $c->addBarLayer2(Side, 4);
 $layer->addDataSet($data1, 0xeebb22, "Server #2"); 
 # Set bar border to transparent. Use bar gradient lighting with light intensity from # 0.75 to 1.75. 
 $layer->setBorderColor(Transparent, barLighting(0.75, 1.75)); 
 # Configure the bars within a group to touch each others (no gap) 
 //$layer->setBarGap(0.2, TouchBar); 
 $chart3URL = $c->makeSession("chart3"); 
 # Create an image map for the chart
 $imageMap3 = $c->getHTMLImageMap("#", "", "title='{value|0} Quantity'");
  $c->makeChart("C:\\wamp\\www\\serviceprojects\\Semtronics_ERP\\Code\\includes\\RawMaterialwisechart.png");
?>
		<img height="400px;" width="400px;" src="includes/getchart.php?<?php echo $chart3URL;?>" border="0" usemap="#map3">
	<map name="map3"> <?php echo $imageMap3;?> </map>
<?php
 
?>