<?php
	require("Config.php");
	require("County_Queries.php");
	require("Maintenance.php");
?>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<label>Select State Code <font color="red">*</font></label>
			<select id="state_id" name="state_id" onchange='State(this.value);'>
				<option value="" selected>Select</option>
				<?php
				$States = State_Select_All();
				while($State = mysql_fetch_assoc($States))
				{
					if($State['id'] == $_POST['state_id'])
						echo "<option value=".$State['id']." selected>".$State['state_code']."</option>";
					else
						echo "<option value=".$State['id'].">".$State['state_code']."</option>";
				} ?>
			</select>
		</div>
		<div id="County_Table">
		</div>
	</div>
</div>
<script>
	function State(state_id)
	{
		$("#County_Table").html(Ajax("POST","includes/Get_Updated_County.php","stateid="+state_id));
	}
	function CountyEnabled(countyid)
	{
		var check = (document.getElementById(countyid).checked == true) ? 1 : 0;
		var Response = Ajax("POST","includes/Get_Updated_County_Enabled.php","countyid="+countyid+"&check="+check);
	}
</script>