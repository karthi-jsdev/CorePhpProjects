<?php
	require("Config.php");
	require("State_Queries.php");
	require("Maintenance.php");
?>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<table border='1px'>
				<tr>
					<th bgcolor='#3399FF'>S.No.</th>
					<th bgcolor='#3399FF'>State Code</th>
					<th bgcolor='#3399FF'>Enable/Disable</th>
				</tr>
				<?php 
				$i=1;
				$Statecount = mysql_fetch_array(Select_Count_State_All());
				if($Statecount['Total'] == 0)
					echo "<tr><td align='center' colspan='3'>No Data Found</td></tr>";
				$State_Names = Select_State_All();
				while($Maintenance_State = mysql_fetch_array($State_Names))
				{
					if($i % 2 == 0)
						echo "<tr bgcolor='#3399FF'>";
					else
						echo "<tr>";
					echo "<td>".$i++."</td>
					<td>".$Maintenance_State['state_code']."</td>";
					if($Maintenance_State['enabled'] == 1)
						echo "<td><input type='checkbox' id='".$Maintenance_State['id']."' value='".$Maintenance_State['id']."' onclick='StateEnabled(this.value)' checked /></td>";
					else	
						echo "<td><input type='checkbox' id='".$Maintenance_State['id']."' value='".$Maintenance_State['id']."' onclick='StateEnabled(this.value)' /></td>";
					echo "</tr>";
				}
				?>
			</table>
			<div class="clear"></div> 
		</div>
	</div>
</div>
<script>
	function StateEnabled(stateid)
	{
		var check = (document.getElementById(stateid).checked == true) ? 1 : 0;
		var Response = Ajax("POST","includes/Get_Updated_State.php","stateid="+stateid+"&check="+check);
	}
</script>