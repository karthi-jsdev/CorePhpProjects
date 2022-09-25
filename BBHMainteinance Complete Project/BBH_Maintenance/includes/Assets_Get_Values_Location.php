<?php
	include("Config.php");
	include("Assets_Queries.php");
	if($_GET['Department'])
	{ ?>
	<fieldset>
		<div class="clearfix">
			<label>Location</label>
			<select id="locationid" name="locationid">
				<option value="">Select</option>
				<?php
					$Locations = Assets_Get_LocationById($_GET['Department']);
					while($Location = mysqli_fetch_array($Locations))
					{
						if($Location['id'] == $_GET['Location'])
							echo "<option value='".$Location['id']."' selected>".$Location['name']."</option>";
						else
							echo "<option value='".$Location['id']."'>".$Location['name']."</option>";
					} ?>
			</select>
		</div>	
	</fieldset>
	<?php 
	}
	?>