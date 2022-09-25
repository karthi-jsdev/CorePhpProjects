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
		echo '<div align="center"><h4>Inspect Needed Report </div><div align="right">Report Date:'.date("d-m-Y").'</h4></div>';
	}

if($_GET['getdata']=='Inspect_Report')
	{ ?>
<table class="paginate sortable" style="width:950px;" border="1">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Invoice Number</th>
			<th align="left">Rawmaterial Code</th>
			<th align="left">Vendor</th>
			<th align="left">Quantity</th>
		</tr>
	</thead>
	<tbody>	
	<?php
		$summary = Stock_Inspection();
		if(!mysql_num_rows($summary))
			echo '<tr><td>NO Date Found</td></tr>';
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
	</tbody>
</table>
<?php } ?>