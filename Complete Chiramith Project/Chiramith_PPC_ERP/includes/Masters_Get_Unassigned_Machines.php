<?php
include("Config.php");
include("Machine_Status_Queries.php");
?>
<label>Machine <font color="red">*</font></label>
<select id="machine_id" name="machine_id">
	<option value=''>Select</option>
	<?php
	$Machines = Machines_Select_NotAllocated();
	while($Machine = mysql_fetch_array($Machines))
		echo '<option value="'.$Machine['id'].'">'.$Machine['machine_number'].'</option>';
	?>
</select>