<?php
	include("Config.php");
	include("Metromarket_Queries.php");
	if($_POST['county_id'] && $_POST['city_id'])
	{ ?>
	<div class="content-bottom">
		<div class="wrap">
			<div class="section group" align="center">
				<table border='1px'>
					<tr>
						<th bgcolor='#3399FF'>S.No.</th>
						<th bgcolor='#3399FF'>MetroMarket</th>
						<th bgcolor='#3399FF'>Enable/Disable</th>
					</tr>
					<?php 
					$i=1;
					$Metromarketcount = mysql_fetch_array(Select_Count_Metromarket_All());
					if($Metromarketcount['Total'] == 0)
						echo "<tr><td align='center' colspan='3'>No Data Found</td></tr>";
					$Maintenance_Metromarket_Names = Maintenance_Metromarket();
					while($Metromarket = mysql_fetch_array($Maintenance_Metromarket_Names))
					{
						if($i % 2 == 0)
							echo "<tr bgcolor='#3399FF'>";
						else
							echo "<tr>";
						echo "<td>".$i++."</td>
						<td>".$Metromarket['metro_market_name']."</td>";
						if($Metromarket['enabled'] == 1)
							echo "<td><input type='checkbox' id='".$Metromarket['id']."'  value='".$Metromarket['id']."' onclick='MetromarketEnabled(this.value)' checked /></td>";
						else	
							echo "<td><input type='checkbox' id='".$Metromarket['id']."'  value='".$Metromarket['id']."' onclick='MetromarketEnabled(this.value)' /></td>";
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
	function MetromarketEnabled(metromarketid)
	{
		var check = (document.getElementById(metromarketid).checked == true) ? 1 : 0;
		var Response = Ajax("POST","includes/Get_Updated_Metromarket_Enabled.php","metromarketid="+metromarketid+"&check="+check);
	}
</script>