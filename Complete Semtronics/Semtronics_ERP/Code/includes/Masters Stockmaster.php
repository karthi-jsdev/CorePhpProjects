<br/><br/>
<?php
	if(!$_GET['innersubpage'])
		$_GET['innersubpage'] = "Vendors";
		$subheaders = array("Vendors", "Vendors_Category","RM_Category","Product_Category","Product_Sub_Category","Raw_Material", "Assign_Raw_Material","Tax","Credit Period","In-house Category","Location","Dashboarde","Issuanceuser","Excisetax","Drivertype","Structure","IC","WattageRange","CurrentRange","Products");
	
	for($i = 0; $i < count($subheaders); $i++)
	{
		$split = explode("_", $subheaders[$i]);
		for($j = 0; $j < count($split); $j++)
		{
			if($j == 0)
				$subpagename = $split[$j];
			else
				$subpagename = $subpagename." ".$split[$j];
		}
		if($_GET['innersubpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	}
	
	$filename = "includes/".$_GET['page']." ".$_GET['innersubpage'].".php";
	if(file_exists($filename) && in_array($_GET['innersubpage'], $subheaders))
	{
		echo '<div class="columns">';
		include($filename);
		echo '</div>';
	}
	else
		echo '<div class="clear">&nbsp;</div>'."Don't visit this website anonymously..!";
	?>
	<div class="clear">&nbsp;</div>