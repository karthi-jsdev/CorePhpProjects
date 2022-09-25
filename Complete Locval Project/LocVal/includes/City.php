<?php
	require("Config.php");
	require("City_Queries.php");
	require("Maintenance.php");
?>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<label>Select County Code <font color="red">*</font></label>
			<select id="county_id" name="county_id" onchange='County(this.value);'>
				<option value="" selected>Select</option>
				<?php
				$Counties = County_Select_All();
				while($County = mysql_fetch_assoc($Counties))
				{
					if($County['id'] == $_POST['county_id'])
						echo "<option value=".$County['id']." selected>".$County['name']."</option>";
					else
						echo "<option value=".$County['id'].">".$County['name']."</option>";
				} ?>
			</select>
		</div>
	</div>
	<div id='City_Table'>
	</div>
</div>
<script>
	function County(county_id)
	{
		var Response = $("#City_Table").html(Ajax("POST","includes/Get_Updated_City.php","county_id="+county_id));
	}
</script>