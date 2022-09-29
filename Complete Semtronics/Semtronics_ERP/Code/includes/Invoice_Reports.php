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
<form method="post" action="" id="form" class="form panel">
	<fieldset>
		<div class="clearfix">
			<label>
				<strong>Vendor Name</strong>
				<select name="vendor_id" id="vendor_id">
					<option value="">All</option>
					<?php 
					$vendor_name_id = select_invoice_number();
					while($All_vendor_name = mysqli_fetch_assoc($vendor_name_id))
					{
						
						if($_GET['vendor_name_id']==$All_vendor_name['id'])
							echo '<option value="'.$All_vendor_name['id'].'" selected="selected">'.$All_vendor_name['name'].'</option>';
						else
							echo '<option value="'.$All_vendor_name['id'].'" >'.$All_vendor_name['name'].'</option>';
					} ?>
				</select>
			</label>
			<label><strong>Start Date:</strong>
				<input type="text" name="startdate" id="startdate" value="<?php if($_POST['startdate']) echo $_POST['startdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
			</label>
			<label><strong>End Date:</strong>
				<input type="text" name="enddate" id="enddate" value="<?php if($_POST['enddate']) echo $_POST['enddate']; else echo date('d-m-Y');?>">
			</label>
		</div>	
		<a class="button button-blue" name="submit" id="show" onclick="Display_Table();">Submit</a>		
	</fieldset>
</form>
	<section role="main" id="main">
		<?php
		if(!$_GET['vendor_id'])
		{	$TotalRows = mysqli_fetch_assoc(Stock_Status_Summary_Count());
			echo "<h4>INVOICE SUMMARY:Total Number of Invoices -".$TotalRows['total'].'</h4>';
			echo '<div align="right"><a href="#" title="Download" onclick=\'Export_Invoice_Data()\'><img src="images/icons/download.png"></a></div>';
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
				$i=1;
				if(!$TotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				/*$Limit = 10;
				$total_pages = ceil($TotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$i++;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		*/
				//$summary = Stock_Status_Summary($Start,$Limit);
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
			/*$GETParameters = "page=Reports&subpage=spage->Store_Reports,ssubpage->Invoice_Reports";
			if($total_pages > 1)
				include("includes/Pagination.php");*/
			?>
		<?php	
		} ?>
	</section>
<script>
	function Display_Table()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("main").innerHTML = xmlhttp.responseText;
			}
				
		}
		xmlhttp.open("GET","includes/Invoice_Display_Table.php?vendor_id="+document.getElementById("vendor_id").value+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value, true);
		xmlhttp.send();
	}	
	
	function Export_Invoice_Data()
	{
		window.open("includes/Custom_Report_Actions.php?startdate="+$("#startdate").val()+"&enddate="+$("#enddate").val()+"&Module=Invoice&vendor_id="+$("#vendor_id").val(),'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>		