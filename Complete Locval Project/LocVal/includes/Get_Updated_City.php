<?php
	require("Config.php");
	require("City_Queries.php");
	ini_set("display_errors","0");
	if($_POST['county_id'])
	{ ?>
	<div class="content-bottom">
		<div class="wrap">
			<div class="section group" align="center">
				<table border='1px'>
					<tr>
						<th bgcolor='#3399FF'>S.No.</th>
						<th bgcolor='#3399FF'>City</th>
						<th bgcolor='#3399FF'>Enable/Disable</th>
					</tr>
					<?php 
					$i=1;
					$Citycount = mysql_fetch_array(Select_Count_city_All());
					if($Citycount['Total'] == 0)
						echo "<tr><td align='center' colspan='3'>No Data Found</td></tr>";
					$Maintenance_City_Names = Maintenance_City_Name();
					while($Maintenance_City = mysql_fetch_array($Maintenance_City_Names))
					{
						if($i % 2 == 0)
							echo "<tr bgcolor='#3399FF'>";
						else
							echo "<tr>";
						echo "<td>".$i++."</td>
						<td>".$Maintenance_City['name']."</td>";
						if($Maintenance_City['enabled'] == 1)
							echo "<td><input type='checkbox' id='".$Maintenance_City['id']."'  value='".$Maintenance_City['id']."' onclick='CityEnabled(this.value)' checked /></td>";
						else	
							echo "<td><input type='checkbox' id='".$Maintenance_City['id']."'  value='".$Maintenance_City['id']."' onclick='CityEnabled(this.value)' /></td>";
						echo "</tr>";
					}
					?>
				</table>
				<div class="clear"></div> 
			</div>
		</div>
	</div>
<?php	}
?>
<script>
	function CityEnabled(cityid)
	{
		var check = (document.getElementById(cityid).checked == true) ? 1 : 0;
		var Response = Ajax("POST","includes/Get_Updated_City_Enabled.php","cityid="+cityid+"&check="+check);
	}
</script>