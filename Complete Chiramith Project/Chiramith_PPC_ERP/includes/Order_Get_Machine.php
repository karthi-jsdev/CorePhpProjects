<?php
	include("Config.php");
	include("Create_Order_Queries.php");
	
	$Machines = Machine_Select_Orderno();
	if(mysqli_num_rows($Machines))
	{ ?>
		<select id="" name="machine_id" onchange='var OptionSplit = this.value.split("$"); document.getElementById("machine_id").value = OptionSplit[0]; document.getElementById("machine_number").value = OptionSplit[1];document.getElementById("section_name").value = OptionSplit[2];document.getElementById("DisplaySection").innerHTML = "&nbsp;Section : "+OptionSplit[2];'>
		<option value="$$">Select</option>
		<?php
			while($Machine = mysqli_fetch_assoc($Machines))
			{
				if($Machine['id'] == $_GET['machineid'])
					echo "<option value='".$Machine['id']."$".$Machine['machine_number']."$".$Machine['section_name']."' selected>".$Machine['machine_number']."</option>";
				else
					echo "<option value='".$Machine['id']."$".$Machine['machine_number']."$".$Machine['section_name']."'>".$Machine['machine_number']."</option>";
			}
		echo '</select>
		<div id="DisplaySection"></div>
		<input type="hidden" id="machine_id" />
		<input type="hidden" id="machine_number" />
		<input type="hidden" id="section_name" />';
	}
	/*else
	{
	
	$Allmachines = mysqli_query($_SESSION['connection'],"SELECT machine.id,machine.machine_number  FROM machine where machine.id not in(select `job`.machine_id from job  WHERE (job.tentative_date >='".date('Y-m-d', strtotime($_GET['startdate']))."' and job.tentative_enddate <='".date('Y-m-d', strtotime($_GET['enddate']))."')) ");
	echo'<select id="machine_id" name="machine_id">
		<option value="">Select</option>';
			while($Machines = mysqli_fetch_assoc($Allmachines))
			{
				echo "<option value='".$Machines['id']."'>".$Machines['machine_number']."</option>";
			}
		echo '</select>';
	}*/
?>