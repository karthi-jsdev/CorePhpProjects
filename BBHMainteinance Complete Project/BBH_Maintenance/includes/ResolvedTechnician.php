<center><b>Technician Attended Tickets</b></center>
<?php
 require_once("PhpChartDir.php");
 include("Config.php");
 #include("Dashboard_Queries.php");
 # The data for the pie chart 
 $data = array();
 $labels = array();
 $ExplodeTechnicians= array();
 $TechnicianNames = array();
 if($_SESSION['roleid'] == '5')
	{
	 $SelectGroup = Reports_Technician();
			while($FetchGroup = mysqli_fetch_array($SelectGroup))
			{
				$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($FetchGroup['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				if($Reports_By_Technician['total'])
				{
					$data[] = $Reports_By_Technician['total'];
					$labels[] =  $FetchGroup['firstname'];
				}
			}
	}
	else if($_SESSION['roleid'] == '1')
	{
		$selectSub_Department = Reports_Sub_Department($_SESSION['groupid']);
		while($FetchTechnician = mysqli_fetch_array($selectSub_Department))
		{
		$ExplodeTechnicians = explode(".",$FetchTechnician['users']);
		foreach($ExplodeTechnicians as $ExplodeTechnician)
		{
			if(!in_array($ExplodeTechnician,$TechnicianNames,true))
			{
				$TechnicianName = mysqli_fetch_array(Report_User($ExplodeTechnician));
				$Reports_By_Technician = mysqli_fetch_array(Reports_By_Technician_With_Dates($FetchGroup['id'],$_GET['ComplaintDate'],$_GET['ResolvedDate']));
				if($Reports_By_Technician['total'])
				{
					$labels[] =  $TechnicianName['firstname'];
					$TechnicianNames[] = $ExplodeTechnician;
					$data[] = $Reports_By_Technician['total'];
				}
			}
		}
		}
	}	
#$data = array(25, 18, 15, 12, 8, 30, 35); 
 # The labels for the pie chart 
# $labels = array("Labor", "Licenses", "Taxes", "Legal", "Insurance", "Facilities", "Production"); 
 # Create a PieChart object of size 450 x 270 pixels
 $c = new PieChart(750, 350); 
 # Set the center of the pie at (150, 100) and the radius to 80 pixels 
 $c->setPieSize(150, 135, 100);
 # add a legend box where the top left corner is at (330, 50) 
 $legendbox = $c->addLegend(330, 60);
 $legendbox->setCols(2);
 $legendbox->setWidth(300);
 # modify the sector label format to show percentages only 
 $c->setLabelFormat("{percent}%");
 # Set the pie data and the pie labels 
 $c->setData($data, $labels);
 # Use rounded edge shading, with a 1 pixel white (FFFFFF) border
 $c->setSectorStyle(RoundedEdgeShading, 0xffffff, 1);
 $chart5URL = $c->makeSession("chart7"); 
 # Create an image map for the chart
 $imageMap5 = $c->getHTMLImageMap("#", "", "title='{label}-{value|0} Tickets'");
  $c->makeChart("C:\\wamp\\www\\serviceprojects\\BBH_Maintenance\\includes\\ResolvedTechnician.png");
if(!$_GET['export']) 
{
	?>
	<img src="includes/getchart.php?<?php echo $chart5URL;?>" border="0" usemap="#map5">
	<map name="map5"> <?php echo $imageMap5;?> </map>
<?php
} 
else
{ ?>
	<img src="C:/wamp/www/serviceprojects/BBH_Maintenance/includes/ResolvedTechnician.png" border="0" usemap="#map5">
	<td><br/><br/><br/><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/></td><td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><td><br/><br/><br/><br/><br/><br/></td>
	<?php
}
?>