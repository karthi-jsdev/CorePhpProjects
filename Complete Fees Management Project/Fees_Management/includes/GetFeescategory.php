<?php
	ini_set("display_errors","0");
	include("Config.php");
	if($_GET['classid'])
	{ ?>
	<div class="wrap">
		<div class="section group">
			<label>FeesCategory <font color="red">*</font></label>
			<select id="feescategoryid" name="feescategoryid">
				<option value="" selected>Select</option>
				<?php
				$Cities = City_Select_All();
				while($City = mysql_fetch_assoc($Cities))
				{
					if($City['id'] == $_POST['city_id'])
						echo "<option value=".$City['id']." selected>".$City['name']."</option>";
					else
						echo "<option value=".$City['id'].">".$City['name']."</option>";
				} ?>
			</select>
		</div>
	</div>
<?php 
	}
?>