<?php 	
	//if(isset($_GET['export']))
	//{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Issuance_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['number'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>Issuance Status </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	//}
?>
<table class="paginate sortable full" border="1">
			<thead>
				<tr>
					<th width="43px" align="center">S.No.</th>
					<th align="left">Rawmaterial Code</th>
					<th align="left">Issued To</th>
					<th align="left">Issued Date</th>
					<th align="left">Part No.</th>
					<th align="left">Description</th>
					<th align="left">PHY Quantity</th>
					<th align="left">Location</th>
				</tr>
			</thead>
			<tbody>
				<?php	
				$i = 0;
				$Issuances = Select_Issuance_ByNoLimit();
				while($Issuance = mysql_fetch_assoc($Issuances))
				{
					echo "<tr style='valign:middle;'>
						<td align='center'>".++$i."</td>
						<td>".$Issuance['materialcode']."</td>
						<td>".$Issuance['issuanceuser']."</td>
						<td>".substr($Issuance['issueddate'], 0,16)."</td>
						<td>".$Issuance['partnumber']."</td>
						<td>".$Issuance['description']."</td>
						<td>".$Issuance['quantity']."</td>
						<td>".$Issuance['name']."</td>
					</tr>";
				} ?>
			</tbody>
		</table>