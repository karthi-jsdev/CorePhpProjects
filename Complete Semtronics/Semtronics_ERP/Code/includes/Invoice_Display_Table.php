<?php
	ini_set("display_errors","0");
	require("Config.php");
	require("Reports_Queries.php");
	$TotalRows = mysql_fetch_array(Stock_Status_Summary_Count_display());
	echo "<h4>INVOICE SUMMARY:Total Number of Invoices - ".$TotalRows['total'].'</h4>';
	echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Invoice_Data()\'><img src="images/icons/download.png"></a></div>';
?>
<section role="main" id="main">
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th align="left">Sl.No.</th>
				<th align="left">Invoice Number</th>
				<th align="left">Vendor</th>
				<th align="left">Invoice Date</th>
				<th align="left">Amount</th>
				<th align="left">Tax Amount</th>
				<th align="left">Total Amount</th>
			</tr>
		</thead>
		<?php
		if(!$TotalRows['total'])
			echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
		/*$Limit = 10;
		$total_pages = ceil($TotalRows['total'] / $Limit);
		if(!$_GET['pageno'])
			$_GET['pageno'] = 1;
		$i = $Start = ($_GET['pageno']-1)*$Limit;
		$i++;
		$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
		$summary = Stock_Status_Summary_display($Start,$Limit);*/
		$i = 1;
		$summary = Stock_Status_Summary_display();
		while($stock_summary = mysql_fetch_assoc($summary))
		{
			$totalamount = round($stock_summary['sum(amount)']+$stock_summary['sum(taxamount)'],2);
			echo'<tbody>
				<tr>
					<td>'.$i++.'</td>
					<td><a href="?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&id='.$stock_summary['id'].'&vendor='.$stock_summary['vendorid'].'">'.$stock_summary['number'].'</a></td>
					<td>'.$stock_summary['name'].'</td>
					<td>'.date('d-m-Y',strtotime($stock_summary['invoicedate'])).'</td>
					<td>'.$stock_summary['sum(amount)'].'</td>
					<td>'.round($stock_summary['sum(taxamount)'],2).'</td>
					<td>'.$totalamount.'</td>
				</tr>
			</tbody>';
		} ?>
	</table>
	<?php
	/*$GETParameters = "page=Reports&subpage=spage->Store_Reports,ssubpage->Invoice_Reports";
	if($total_pages > 1)
		include("includes/Pagination.php");*/
	?>
</section>
