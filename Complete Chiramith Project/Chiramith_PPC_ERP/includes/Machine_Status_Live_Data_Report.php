<?php
include("Config.php");
ini_set("display_errors","0");
include("Machine_Status_Queries.php");
$machinereport = Machine_Status_Dropdown();
$report_data = $report_options = array();
$report_data[] = array();
$name = Machine_Make();
$type = Machine_Type();
$turningtools = Machine_Turningtools();
$specification = Machine_Specification();
$machine_makee = Machine_Dropdownvalues_Make();
$machine_turnings = Machine_Dropdownvalues_Turningtool();
$machine_specification = Machine_Dropdownvalues_Specification();
$machine_types = Machine_Dropdownvalues_Type();
while($machine_report = mysqli_fetch_array($machinereport))
{
	if($machine_report['make_id'] && !in_array($machine_report['make_id'], $report_data[1]))
	{
		if($_GET['machinemake'] == $machine_report['make_id'])
			$report_options[1] .= '<option value="'.$machine_report['make_id'].'" selected="selected">'.$machine_report['name'].'</option>';
		else
			$report_options[1] .= '<option value="'.$machine_report['make_id'].'">'.$machine_report['name'].'</option>';
	}
	$report_data[1][] = $machine_report['make_id'];

	if($machine_report['specid'] && !in_array($machine_report['specid'], $report_data[2]))
	{
		if($_GET['machinespecification'] == $machine_report['specid'])
			$report_options[2] .= '<option value="'.$machine_report['specid'].'" selected="selected">'.$machine_report['specification'].'</option>';
		else
			$report_options[2] .= '<option value="'.$machine_report['specid'].'">'.$machine_report['specification'].'</option>';
	}
	$report_data[2][] = $machine_report['specid'];
	
	if($machine_report['toolid'] && !in_array($machine_report['toolid'], $report_data[3]))
	{
		if($_GET['machineturningtools'] == $machine_report['toolid'])
			$report_options[3] .= '<option value="'.$machine_report['toolid'].'" selected="selected">'.$machine_report['turningtool'].'</option>';
		else
			$report_options[3] .= '<option value="'.$machine_report['toolid'].'">'.$machine_report['turningtool'].'</option>';
	}
	$report_data[3][] = $machine_report['toolid'];
	
	if($machine_report['typeid'] && !in_array($machine_report['typeid'], $report_data[4]))
	{
		if($_GET['machinetype'] == $machine_report['typeid'])
			$report_options[4] .= '<option value="'.$machine_report['typeid'].'" selected="selected">'.$machine_report['type'].'</option>';
		else
			$report_options[4] .= '<option value="'.$machine_report['typeid'].'">'.$machine_report['type'].'</option>';
	}
	$report_data[4][] = $machine_report['typeid'];
} ?>
<fieldset>
	<div class="clearfix">
		<table width="900px">
			<tr>
				<td>
					<strong>Machine Make</strong><br/>
					<select name="machinemake" id="machinemake" onchange="Get_Module_Options('machinemake',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['machinemake'] && !$_GET['machinespecification'] && !$_GET['machineturningtools'] && !$_GET['machinetype'])
							while($allmachinemake = mysqli_fetch_assoc($machine_makee))
							{
								if($_GET['machinemake'] == $allmachinemake['id'])
									echo'<option value="'.$allmachinemake['id'].'" selected>'.$allmachinemake['name'].'</option>';
								else
									echo'<option value="'.$allmachinemake['id'].'">'.$allmachinemake['name'].'</option>';
							}
						else 
							echo $report_options[1];
						?>
					</select>
				</td>
				<td>
					<strong>Machine Specification</strong><br/>
					<select name="machinespecification" id="machinespecification" onchange="Get_Module_Options('machinespecification',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['machinespecification'] && !$_GET['machinemake']&& !$_GET['machineturningtools'] && !$_GET['machinetype'])
						while($machine_specifications = mysqli_fetch_assoc($machine_specification))
						{
							if($_GET['machinespecification'] == $machine_specifications['id'])
								echo'<option value="'.$machine_specifications['id'].'" selected>'.$machine_specifications['specification'].'</option>';
							else
								echo'<option value="'.$machine_specifications['id'].'">'.$machine_specifications['specification'].'</option>';
						}
						else
							echo $report_options[2];
						?>
					</select>
				</td>
				<td>
					<strong>Machine Turning Tool</strong><br/>
					<select name="machineturningtools" id="machineturningtools" onchange="Get_Module_Options('machineturningtools',this.value)">
						<option value="">All</option>
						<?php
						if($_GET['machineturningtools'] && !$_GET['machinemake']&& !$_GET['machinespecification'] && !$_GET['machinetype'])
							while($allmachinturn = mysqli_fetch_assoc($machine_turnings))
							{
								if($_GET['machineturningtools'] == $allmachinturn['id'])
									echo'<option value="'.$allmachinturn['id'].'" selected>'.$allmachinturn['turningtool'].'</option>';
								else
									echo'<option value="'.$allmachinturn['id'].'">'.$allmachinturn['turningtool'].'</option>';
							}
						else
							echo $report_options[3];
						?>
					</select>
				</td>
				<td>
					<strong>Machine Type</strong><br/>
					<select name="machinetype" id="machinetype" onchange="Get_Module_Options('machinetype',this.value)">
						<option value="">All</option>
						<?php 
						if($_GET['machinetype'] && !$_GET['machinemake'] && !$_GET['machinespecification'] && !$_GET['machineturningtools'])
							while($mach_type = mysqli_fetch_assoc($machine_types))
							{
								if($_GET['machinetype'] == $mach_type['id'])
									echo'<option value="'.$mach_type['id'].'" selected>'.$mach_type['type'].'</option>';
								else
									echo'<option value="'.$mach_type['id'].'">'.$mach_type['type'].'</option>';
							}
						else
							echo $report_options[4];
						?>
					</select>
				</td>
				<td>
					<strong>Section</strong><br/>
					<select name="section_id" id="section_id">
						<option value="">All</option>
						<?php
						$Sections = Select_Sections();
						while($Section = mysqli_fetch_array($Sections))
							echo "<option value='".$Section['id']."'>".$Section['name']."</option>";
						?>
					</select>
				</td>
				
				<input type="hidden" id="subsection_id" />
				<!--td>
					<strong>Sub-Section</strong><br/>
					<select name="subsection_id" id="subsection_id">
						<option value="">All</option>
						<?php
						$SubSections = Select_SubSections();
						while($SubSection = mysqli_fetch_array($SubSections))
							echo "<option value='".$SubSection['id']."'>".$SubSection['name']."</option>";
						?>
					</select>
				</td-->
			</tr>
		</table>
	</div>
</fieldset>