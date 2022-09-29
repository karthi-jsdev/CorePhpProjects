<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['getdata'].date("d-m-Y H-i")).".xls");
		/*echo '<div style="float:left">
		<img src="http://localhost/Semtronics_ERP/Code/images/semtronics1.png" alt="semtronics" width="30%" height="10%"/>
		</div><br />';*/
		echo '<div align="center"><h4>All Invoice </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}
	if($_GET['getdata']=='Invoice_Report')
	{
	$TotalRows = mysqli_fetch_assoc(Stock_Status_Summary_Count());
		?>
		<section role="main" id="main">
		<table class="paginate sortable full" style="width:1000px;"border="1">
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
			$i=1;
			$summary = Stock_Status_Summary();
			while($stock_summary = mysqli_fetch_assoc($summary))
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
	}	
		?>