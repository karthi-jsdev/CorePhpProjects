<?php
	require("Config.php");
	require("Home_Queries.php");
?>
<div class="content-top">
	<div class="wrap">
		<div class="section group">
			<h4><center><strong> Metropolitan Markets Covered. </strong><br >(Click on the metromarketname below to access Valuation)</center></h4>
		</div>
	</div>
</div>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center" style="background: lightblue">
			<table>
				<?php 
				$i=0;
				$stateCode = "";
				$All_State_Names = State_Name();
				$count = mysql_num_rows($All_State_Names);
				$numrows = ceil($count/5);
				while($State = mysql_fetch_array($All_State_Names))
				{
					if ($i%$numrows == 0)
					{
						echo "<td><table style=\"width: 200px;\">";
					}
					$i++;
					if($stateCode != $State['state_code'])
					{
						if ($i == 1 || $i%$numrows == 1)
							echo "<tr>".$State['state_code']." <br />";
						else
							echo "<tr><br />".$State['state_code']." <br />";
					}
						
					echo "<a href=\"javascript:GetSalesQuery('".$State['state_code']."','".$State["countyname"]."','".$State['metromarketname']."');\"><u>".$State['metromarketname']."</u></a>
					</tr>
					<br />";					
						
					$stateCode = $State['state_code'];
					
					if ($i%$numrows == 0)
					{
						echo "</table></td>";
					}
				}
				?>
			</table>
			<form id="form1" action="./index.php?page=SalesQuery" method="post">
				<input type="hidden" id="state" name="state" value="">
				<input type="hidden" id="county" name="county" value="">
				<input type="hidden" id="metromarket" name="metromarket" value="">
			</form>
			<div class="clear"></div> 
		</div>
	</div>
</div>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group">
			<font size="6">Announcements</font> <br />
			 <?php 
				$Announcement = Announcement_Title();
				while($Announcement_Name = mysql_fetch_array($Announcement))
				{
					echo $Announcement_Name['title'].'<a href="index.php?page=Announcements" style="text-decoration: underline">&nbsp;&nbsp;more</a><br />';
				}
			?>
		</div>
	</div>
</div>
<script>
	function GetSalesQuery(state,county,metromarket)
	{
		document.getElementById("state").value = state;
		document.getElementById("county").value = county;
		document.getElementById("metromarket").value = metromarket;
		document.forms[0].submit();
	}
</script>