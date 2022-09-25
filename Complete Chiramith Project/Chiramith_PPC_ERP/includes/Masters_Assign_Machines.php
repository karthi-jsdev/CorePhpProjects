<?php
	if($_GET['section_id'] && $_GET['subsection_id'] && $_GET['location_reference_id'] && $_GET['machine_id'])
	{
		include("Config.php");
		include("Machine_Status_Queries.php");
		Masters_Assign_Machines();
	}
	else if(!$_GET['section_id'])
		echo "Please select Section, Subsection, Location & Machine";
	else if(!$_GET['subsection_id'])
		echo "Please select Subsection";
	else if(!$_GET['location_reference_id'])
		echo "Please select Location";
	else if(!$_GET['machine_id'])
		echo "Please select Machine";
?>