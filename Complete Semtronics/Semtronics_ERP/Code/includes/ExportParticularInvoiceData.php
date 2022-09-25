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
		$vendorname = mysql_fetch_assoc(mysql_query("SELECT * FROM invoice JOIN  vendorcategory ON invoice.vendorid = vendorcategory.id  WHERE invoice.vendorid= '".$_GET["vendor_id"]."'"));
		echo '<div align="center">
		<h4>Vendor Name:'.$vendorname['name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$_GET['startdate'].'-'.$_GET['enddate'].'</div><div align="right">Report Date:'.date("d-m-Y").'
		</h4></div>';
	}
	if($_GET['getdata']=='Invoice_Report')
	{ 
	$TotalRows = mysql_fetch_array(Stock_Status_Summary_Count_display());
		?>
		<section role="main" id="main">
			<table class="paginate sortable full" style="width:1000px;" border="1">
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
			$i =1;
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

	<?php } ?>