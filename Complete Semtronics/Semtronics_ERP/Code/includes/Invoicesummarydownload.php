<?php
	include("Config.php");
	ini_set('default_errors',1);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=INVOICESUMMARY.XLS");
?>
	<table class="paginate sortable full" border='1px'>
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Invoice Number</th>
			<th align="left">Vendor</th>
			<th align="left">Invoice Date</th>
			<th align="left">Amount</th>
			<th align="left">Tax Amount</th>
			<th align="left">Total Amount</th>
			<th align="left">CourierCharge</th>
			<th align="left">Excise Duty Tax </th>
		</tr>
	</thead>
<?php
	if(isset($_GET['id']))
	{
		include("Stock_Management_Queries.php");
		$i=1;
		$home = Invoice_Summary_Download();
		while($stock_summary = mysqli_fetch_assoc($home))
		{
			if($stock_summary['excise'] == 0)
				$totalamount = $stock_summary['amount']+$stock_summary['taxamount'];
			else
				$totalamount = $stock_summary['amount']+$stock_summary['exciseamount']+(($stock_summary['amount']+$stock_summary['exciseamount'])*$stock_summary['percent']/100);
			echo'<tbody>
					<tr>
						<td>'.$i++.'</td>
						<td><a href="?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$stock_summary['number'].'&vendor='.$stock_summary['vendorid'].'">'.$stock_summary['number'].'</a></td>
						<td>'.$stock_summary['name'].'</td>
						<td>'.date('d-m-Y',strtotime($stock_summary['invoicedate'])).'</td>
						<td>'.number_format($stock_summary['amount'],2).'</td>
						<td>'.number_format($stock_summary['taxamount'],2).'</td>
						<td>'.number_format($totalamount,2).'</td>
						<td>'.$stock_summary['couriers'].'</td>';
						if($stock_summary['excise'] == 0)
							echo '<td>NO</td>';
						else
							echo '<td>YES</td>
					</tr>
				</tbody>';
		}
	}
?>
</table>