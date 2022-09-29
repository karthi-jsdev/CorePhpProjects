<div class="clear">&nbsp;</div>
<div class="columns">
	<?php
	if(!$_GET['number'])
		echo "<h3>Please add Issuance or Select Summary to view Issuance Status</h3>";
	else
	{
		$TotalIssuance = mysqli_fetch_assoc(Count_All_Issuance_ById());
		echo "<h3>Issuance Code : ".$_GET['number'].", Total Raw Materials : ".$TotalIssuance['total']."</h3>";
			echo '<div align="right"><a href="" title="Download" onclick=\'Export_Data("getdata=Issuance_Status_Report")\'><img src="images/icons/download.png"></a></div>';
		?>
		<hr />
		<table class="paginate sortable full">
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
				if(!$TotalIssuance['total'])
					echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($TotalIssuance['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				
				$Issuances = Select_Issuance_ByLimit($Start, $Limit);
				while($Issuance = mysqli_fetch_assoc($Issuances))
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
		<div class="clear">&nbsp;</div>
		<?php 
		echo '<a class="button button-green" href="?page=Stores&subpage=spage->Issuance,ssubpage->Delivery_Challan&number='.$_GET['number'].'">Create DC</a>';
		$GETParameters = "page=Stores&subpage=spage->Issuance,ssubpage->".$_GET['ssubpage']."&number=".$_GET['number']."&";
		if($total_pages > 1)
			include("includes/Pagination.php");
	} ?>
</div>
<script>
	function Export_Data(PostBackValues)
	{
		window.open("includes/ExportIssuance_StatusData.php?export=1&"+PostBackValues+"&number=<?php echo $_GET['number'];?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>