<?php
	include("Config.php");
	$Equipment = mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory  JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id  WHERE department_id='".$_GET['department']."'");
	$Equipment1 = mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory  JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id  WHERE department_id='".$_GET['department']."'");
	$Equipment2 = mysqli_query($_SESSION['connection'],"SELECT * FROM  assets_inventory  JOIN  biomedical_equipment ON assets_inventory.equipment_idname = biomedical_equipment.id  WHERE department_id='".$_GET['department']."'");
	if($_GET['department'])
	{
		echo '<select id="equipmentname" name="equipmentname"  onchange=\'Equipment_Change("equipmentname")\'>
				<option value="">Select</option>';
				while($FetchQuery = mysqli_fetch_array($Equipment))
					echo "<option value=".$FetchQuery['id']." >".$FetchQuery['equipment']."</option>";
		echo'</select></label>';
		echo '#';
		echo '<select id="serialnumber" name="serialnumber"  onchange=\'Equipment_Change("serialnumber")\'>
				<option value="">Select</option>';
				while($FetchQuery1 = mysqli_fetch_array($Equipment1))
					echo "<option value=".$FetchQuery1['id']." >".$FetchQuery1['serialnumber']."</option>";
		echo'</select></label>';
		echo '#';
		echo '<select id="equipment_id" name="equipment_id" onchange=\'Equipment_Change("equipment_id")\'>
				<option value="">Select</option>';
				while($FetchQuery2 = mysqli_fetch_array($Equipment2))
					echo "<option value=".$FetchQuery2['id']." >".$FetchQuery2['equipmentid']."</option>";
		echo'</select></label>';
	}
?>