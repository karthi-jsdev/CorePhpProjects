<?php
	include("Config.php");
	include("Assets_Queries.php");
	/*{
		$results = "";
		echo "Select#0#";
		if($_GET['Division'])
			$Assets_Select = Assets_Get_DepartmentById($_GET['Division']);
		else
			$Assets_Select = Assets_Get_LocationById($_GET['Location']);
		while($Assets_Data = mysqli_fetch_array($Assets_Select))
		{
			$results .= $Assets_Data['name']."#".$Assets_Data['id']."#";
		}
		echo substr($results, 0, -1);
	}*/
	if($_GET['Division'])
	{
?>
	<select id="departmentid" name="departmentid" onchange = "Asset_Values('',this.value)">
		<option value="">Select</option>
		<?php
			$Departments = Assets_Get_DepartmentById($_GET['Division']);
			while($Department = mysqli_fetch_array($Departments))
			{
				if($Department['id'] == $_POST['departmentid'])
					echo "<option value='".$Department['id']."' selected>".$Department['name']."</option>";
				else
					echo "<option value='".$Department['id']."'>".$Department['name']."</option>";
			} ?>
	</select>
	<?php } 
	if($_GET['Department'])
	{ ?>
	<select id="locationid" name="locationid">
		<option value="">Select</option>
		<?php
			$Locations = Assets_Get_LocationById($_GET['Department']);
			while($Location = mysqli_fetch_array($Locations))
			{
				if($Location['id'] == $_POST['locationid'])
					echo "<option value='".$Location['id']."' selected>".$Location['name']."</option>";
				else
					echo "<option value='".$Location['id']."'>".$Location['name']."</option>";
			} ?>
	</select>
	<?php 
	}
	?>