<?php
	include("Config.php");
	include("Complaint_Queries.php");
	if(isset($_GET['Department']) && ($_GET['Group']))
	{
	$Extension = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From department where id='".$_GET['Department']."'"));
		echo $Extension['extension'].'#<select id="location" name="location">
				<option value="">Select</option>';
				$ComplaintSelect_Locations = Complaint_Select_Location($_GET['Department'],$_GET['Group']);
				if(mysqli_num_rows($ComplaintSelect_Locations))
				{
					while($ComplaintSelect_Locations_ByGroupDepartment = mysqli_fetch_array($ComplaintSelect_Locations))
						echo '<option value="'.$ComplaintSelect_Locations_ByGroupDepartment['id'].'">'.$ComplaintSelect_Locations_ByGroupDepartment['name'].'</option>';
				}
			echo '</select>';
	}
?>