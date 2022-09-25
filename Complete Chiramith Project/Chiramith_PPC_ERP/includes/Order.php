<section class="grid_6 first">
	<br />
	<?php
	date_default_timezone_set('Asia/Kolkata');
	include("includes/Create_Order_Queries.php");
	include("includes/Job_Queries.php");
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Add";
	
	$Subpages = array("Add", "Summary");
	$Buttons = "";
	foreach($Subpages as $Subpage)
	{
		if($_GET['subpage'] == $Subpage)
			echo '<a class="button button-blue" href="?page='.$_GET['page'].'&subpage='.$Subpage.'" selected>'.$Subpage.'</a>&nbsp;';
		else
			echo '<a class="button button-gray" href="?page='.$_GET['page'].'&subpage='.$Subpage.'">'.$Subpage.'</a>&nbsp;';
	}
	if($_GET['subpage'] == "Job Status")
		echo '<a class="button button-blue" href="#" selected>Job Status</a>';
	else
		echo '<a class="button button-gray" href="#">Job Status</a>';
	
	include("includes/Order_".$_GET['subpage'].".php");
	$Lastorderdate = mysql_fetch_array(mysql_query("SELECT order_date FROM `order` order by order_date DESC LIMIT 1"));
	echo "<b><font color='blue'>Last updated date:&nbsp;&nbsp;".date("d-m-Y", strtotime($Lastorderdate['order_date']))."</font></b>";	
	?>
</section>