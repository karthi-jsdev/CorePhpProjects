<?php
if(!$_GET['startdate'] && !$_GET['startdate'])
{ ?>
	<head>
		<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script>
			$(function()
			{
				$("#startdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
				$("#enddate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
			});
		</script>
	</head>
	<label><strong>Start Date:</strong>
		<input type="text" name="startdate" id="startdate" value="<?php echo date('d-m-Y');?>">
	</label>
	<label>&nbsp;&nbsp;<strong>End Date:</strong>
		<input type="text" name="enddate" id="enddate" value="<?php echo date('d-m-Y');?>">
	</label>
	&nbsp;&nbsp;<a href="#" class="button button-gray" onclick="Validate()">Export</a>

	<iframe style="display:none;" id="download_IFrame"></iframe>
	<script>
		function Validate()
		{
			document.getElementById('download_IFrame').src="includes/Custom_Report_Actions.php?startdate="+$("#startdate").val()+"&enddate="+$("#enddate").val();
			//window.open("includes/Custom_Report_Actions.php?startdate="+$("#startdate").val()+"&enddate="+$("#enddate").val(), 'mypopup', 'status=1,width=1,height=1,scrollbars=1');

		}
	</script>
<?php
}
else
{
	include("includes/Custom_Reports_Queries.php");
	
	ob_clean();
	date_default_timezone_set('Asia/Kolkata');
	header("Content-Type: application/msexcel");
	header("Content-Disposition: attachment; filename=test.xls");
	?>
	<section role="main" id="main">
	<?php
		$TotalRows = mysqli_fetch_assoc(Stock_Status_Summary_Count());
		echo "<h4>INVOICE SUMMARY : Total Number of Invoices -".$TotalRows['total'].'</h4>';
		?>
		<table class="paginate sortable full" id="Filter_Display">
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
	</section>
<?php
} ?>