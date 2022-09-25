<?php
	include("Config.php");
	if(isset($_GET['equipmentname']))
	{
		$Equipment_Name = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory where equipment_idname= '".$_GET['equipmentname']."'"));
		echo '<select id="serialnumber" name="serialnumber">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_Name['id']." selected>".$Equipment_Name['serialnumber']."</option>";
		echo'</select>';
		echo '#';
		echo '<select id="equipment_id" name="equipment_id">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_Name['id']." selected>".$Equipment_Name['equipmentid']."</option>";
		echo'</select>';
	}
	if(isset($_GET['serialnumber']))
	{ 
		$Equipment_SerialNumber = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id where equipment_idname= '".$_GET['serialnumber']."'"));
		echo '<select id="equipmentname" name="equipmentname">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_SerialNumber['id']." selected>".$Equipment_SerialNumber['equipment']."</option>";
		echo'</select>';
		echo '#';
		echo '<select id="equipment_id" name="equipment_id">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_SerialNumber['id']." selected>".$Equipment_SerialNumber['equipmentid']."</option>";
		echo'</select>';
	}
	if(isset($_GET['equipment_id']))
	{ 
		$Equipment_ID = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id where equipment_idname= '".$_GET['equipment_id']."'"));
		
		echo '<select id="equipmentname" name="equipmentname">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_ID['id']." selected>".$Equipment_ID['equipment']."</option>";
		echo'</select>';
		echo '#';
		echo '<select id="serialnumber" name="serialnumber">
				<option value="">Select</option>';
					echo "<option value=".$Equipment_ID['id']." selected>".$Equipment_ID['serialnumber']."</option>";
		echo'</select>';
	}
?>