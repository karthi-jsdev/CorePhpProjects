<?php include("Config.php");?>
<br /><br /><br />
<table class="paginate sortable" style="width:950px;">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Invoice Number</th>
			<th align="left">Rawmaterial Code</th>
			<th align="left">Vendor</th>
			<th align="left">Quantity</th>
		</tr>
	</thead>
	<?php
		$summary = Stock_Inspection();
		if(!mysql_num_rows($summary))
			echo '<tr><td>No Data Found</td></tr>';
		echo "<h3>Total Number Stocks to be Inspected -".mysql_num_rows($summary).'</h3>';
		echo '<div align="right"><a href="#" title="Download" onclick=Export_InspectionData()><img src="images/icons/download.png"></a></div>';
		$i=1;
		while($stock_summary = mysql_fetch_assoc($summary))
		{
			echo'<tbody>
				<tr>
					<td  style="vertical-align:top">'.$i++.'</td>
					<td  style="vertical-align:top"><a href="?index.php&page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$stock_summary['number'].'&vendor='.$stock_summary['vendorid'].'">'.$stock_summary['number'].'</a></td>
					<td  style="vertical-align:top">'.$stock_summary['materialcode'].'</td>
					<td  style="vertical-align:top">'.$stock_summary['name'].'</td>
					<td  style="vertical-align:top">'.$stock_summary['sum(quantity)'].'</td>
			</tbody>';
		}
	?>
</table>
<script>
	function Export_InspectionData()
	{
		window.open("includes/Custom_Report_Actions.php?startdate=1990-01-01&enddate=<?php echo date("Y-m-d");?>&Module=Inspection",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>