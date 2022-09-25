<?php
	include("Config.php");
	include("Assets_Queries.php");
	if($_GET['Division'])
	{
?>
		<fieldset>
			<div class="clearfix">
				<label>Department<font color="red">*</font></label>
				<select id="departmentid" name="departmentid" onchange = "Asset_Location(this.value,'')">
					<option value="">Select</option>
					<?php
						$Departments = Assets_Get_DepartmentById($_GET['Division']);
						while($Department = mysqli_fetch_array($Departments))
						{
							if($Department['id'] == $_GET['Department'])
								echo "<option value='".$Department['id']."' selected>".$Department['name']."</option>";
							else
								echo "<option value='".$Department['id']."'>".$Department['name']."</option>";
						} ?>
				</select>
			</div>	
		</fieldset>
	<?php  
	}
	?>