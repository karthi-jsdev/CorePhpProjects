<?php
if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>All Issuance </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
if($_GET['getdata']=='Issuance_Reports')
	{ 
		include("Issuance_Queries.php");
	$TotalIssuance = mysqli_fetch_assoc(Count_Issuance_ByGroup());
		?>	
<table class="paginate sortable full" border="1">
		<thead>
			<tr>
				<th width="43px" align="center">S.No.</th>
				<th align="left">Issuance Code</th>
				<th align="left">Issued To</th>
				<th align="left">Total Raw Materials</th>
				<th align="left">Date and Time</th>
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
			while($Issuance = mysqli_fetch_assoc($Issuances))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".++$i."</td>
					<td><a href='?page=Stores&subpage=spage->Issuance,ssubpage->Status&number=".$Issuance['number']."'>".$Issuance['number']."</a></td>
					<td>".$Issuance['issuanceuser']."</td>
					<td>".$Issuance['total']."</td>
					<td>".substr($Issuance['issueddate'],0,16)."</td>
				</tr>";
			} ?>
		</tbody>
	</table>
	<div class="clear">&nbsp;</div>
	<?php
	} ?>