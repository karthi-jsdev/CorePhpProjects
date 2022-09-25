<?php
ini_set("display_errors","0");
if(!$_GET['Initial'])
{ ?>
	<h3>
	<?php
	include("Config.php");
	include("Issuance_Queries.php");
	$TotalIssuance = mysql_fetch_assoc(Count_Issuance_ByGroup());
	echo "Total No. of Issuance Summaries - ".$TotalIssuance['total'];
	echo '<div align="right"><a href="#" title="Download" onclick="Export_Data()"><img src="images/icons/download.png"></a></div>';
	?>
	</h3>
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.No.</th>
				<th align="left">Issuance Code</th>
				<th align="left">Issued To</th>
				<th align="left">Total Raw Materials</th>
				<th align="left">Date and Time</th>
				<th align="left">Issuance Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$TotalIssuance['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$_GET['total_pages'] = ceil($TotalIssuance['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
				
				 
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$Issuances = Select_Issuance_ByGroupNoLimit();
			while($Issuance = mysql_fetch_assoc($Issuances))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".++$i."</td>
					<td><a href='?page=Stores&subpage=spage->Issuance,ssubpage->Status&number=".$Issuance['number']."'>".$Issuance['number']."</a></td>
					<td>".$Issuance['issuanceuser']."</td>
					<td>".$Issuance['total']."</td>
					<td>".substr($Issuance['issueddate'],0,16)."</td>
					<td>".$Issuance['issuancedate']."</td>
				</tr>";
			} ?>
		</tbody>
	</table>
	<div class="clear">&nbsp;</div>
<?php
}
?>