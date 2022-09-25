<?php
	require("Config.php");
	require("County_Queries.php");
	if($_POST['stateid'])
	{ ?>
	<div class="content-bottom">
		<div class="wrap">
			<div class="section group" align="center">
				<table border='1px'>
					<tr>
						<th bgcolor='#3399FF'>S.No.</th>
						<th bgcolor='#3399FF'>County</th>
						<th bgcolor='#3399FF'>Enable/Disable</th>
					</tr>
					<?php 
					$i=1;
					$Contycount = mysql_fetch_array(Select_Count_County_Name());
					if($Contycount['Total'] == 0)
						echo "<tr><td align='center' colspan='3'>No Data Found</td></tr>";
					$County_Names = Select_County_Name_All();
					while($Maintenance_County = mysql_fetch_array($County_Names))
					{
						if($i % 2 == 0)
							echo "<tr bgcolor='#3399FF'>";
						else
							echo "<tr>";
						echo "<td>".$i++."</td>
						<td>".$Maintenance_County['name']."</td>";
						if($Maintenance_County['enabled'] == 1)
							echo "<td><input type='checkbox' id='".$Maintenance_County['id']."'  value='".$Maintenance_County['id']."' onclick='CountyEnabled(this.value)' checked /></td>";
						else	
							echo "<td><input type='checkbox' id='".$Maintenance_County['id']."'  value='".$Maintenance_County['id']."' onclick='CountyEnabled(this.value)' /></td>";
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
