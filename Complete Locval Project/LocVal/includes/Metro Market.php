<?php
	require("Config.php");
	require("Metromarket_Queries.php");
	require("Maintenance.php");
	ini_set("display_errors","0");
	
?>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<label>Select County <font color="red">*</font></label>
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
	<br />
	<div class="wrap">
		<div class="section group" align="center">
			<label>Select City <font color="red">*</font></label>
			<select id="city_id" name="city_id" onchange='City(document.getElementById("county_id").value,this.value);'>
				<option value="" selected>Select</option>
			</select>
		</div>
	</div>
	<div id="Metro_Market_Table">
	</div>
</div>
<script>
	function County(county_id)
	{
		var Response = $("#city_id").html(Ajax("POST","includes/Get_City_Name.php","county_id="+county_id));
	}
	function City(county_id,city_id)
	{
		var Response = $("#Metro_Market_Table").html(Ajax("POST","includes/Get_Updated_Metromarket.php","county_id="+county_id+"&city_id="+city_id));
	}
</script>