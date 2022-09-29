<?php
include('Config.php');

$i=1;
?>
<form action="" method="POST" enctype="multipart/form-data">
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
			<th align="left">Courier Charge</th>
			<th align="left">Excise Duty Tax </th>
			<th align="left">Action</th>
			<th align="left">Invoice File</th>
			<th align="left">Invoice Image</th>
		</tr>
	</thead>
<?php
	if($_GET['id'])
	{
		$inventory = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT invoiceid,batchid,sum(quantity) as quantity,sum(amount) as amount FROM stockinventory WHERE invoiceid='".$_GET['id']."' group by invoiceid, batchid"));
		//$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT count(stock.batchid ) AS total FROM stock JOIN stockinventory ON stock.batchid = stockinventory.batchid WHERE invoiceid ='".$inventory['invoiceid']."'"));
		//$stock_invoice = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT count(stockinventory.invoiceid ) AS total FROM stockinventory WHERE batchid ='".$inventory['batchid']."'"));
		
		$invoicevalues = array();
		$inventoryvalues = array();
		$invoice = mysqli_query($_SESSION['connection'],"SELECT batchid FROM stockinventory WHERE invoiceid='".$_GET['id']."'");
		while($invoiceslist =  mysqli_fetch_assoc($invoice))
		{
			$invoicevalues[] = $invoiceslist['batchid'];
		}
		$sinventory = mysqli_query($_SESSION['connection'],"SELECT * FROM stockinventory");
		while($inventoryvalue = mysqli_fetch_assoc($sinventory))
		{
			$inventoryvalues[] = $inventoryvalue['invoiceid'];
		}
		foreach($invoicevalues as $invoicevalues)
		{
			$batchcount = mysqli_query($_SESSION['connection'],"select invoiceid,batchid,count(invoiceid) as singlebatch from stockinventory where batchid='".$invoicevalues."'");
			while($invoicebatchcount = mysqli_fetch_assoc($batchcount))
			{
				if($invoicebatchcount['singlebatch']==1)
				{
					mysqli_query($_SESSION['connection'],"DELETE FROM stock where batchid in(SELECT batchid from stockinventory where invoiceid='".$_GET['id']."' && batchid='".$invoicebatchcount['batchid']."')");
					$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock WHERE batchid='".$invoicebatchcount['batchid']."'"));
					mysqli_query($_SESSION['connection'],"UPDATE stock set quantity='".$stock_value['quantity']."'-'".$inventory['quantity']."',amount='".$stock_value['amount']."'-'".$inventory['amount']."' WHERE batchid='".$invoicebatchcount['batchid']."' ");
					$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock WHERE batchid='".$invoicebatchcount['batchid']."'"));
					mysqli_query($_SESSION['connection'],"UPDATE stock set unitprice='".$stock_value['amount']."'/'".$stock_value['quantity']."' WHERE batchid='".$invoicebatchcount['batchid']."'");
				}
				else
				{	
					$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock WHERE batchid='".$invoicebatchcount['batchid']."'"));
					mysqli_query($_SESSION['connection'],"UPDATE stock set quantity='".$stock_value['quantity']."'-'".$inventory['quantity']."',amount='".$stock_value['amount']."'-'".$inventory['amount']."' WHERE batchid='".$invoicebatchcount['batchid']."' ");
					$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock WHERE batchid='".$invoicebatchcount['batchid']."'"));
					mysqli_query($_SESSION['connection'],"UPDATE stock set unitprice='".$stock_value['amount']."'/'".$stock_value['quantity']."' WHERE batchid='".$invoicebatchcount['batchid']."'");
				} 
			}
		}
		mysqli_query($_SESSION['connection'],"DELETE FROM stockinventory WHERE invoiceid='".$_GET['id']."'");
		mysqli_query($_SESSION['connection'],"DELETE FROM invoice WHERE invoice.id='".$_GET['id']."'");
		/* $stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT count(stockissuance.batchid ) AS total FROM stockissuance JOIN stockinventory ON stockissuance.batchid = stockinventory.batchid WHERE invoiceid ='".$inventory['invoiceid']."'"));
		if($stock_value['total']==1)
			mysqli_query($_SESSION['connection'],"DELETE FROM stock where batchid in(SELECT batchid from stockinventory where invoiceid='".$_GET['id']."' && batchid='".$inventory['batchid']."')");
		else
		{
			$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stockissuance WHERE batchid='".$inventory['batchid']."'"));
			mysqli_query($_SESSION['connection'],"UPDATE stockissuance set quantity='".$stock_value['quantity']."'-'".$inventory['quantity']."',amount='".$stock_value['amount']."'-'".$inventory['amount']."' WHERE batchid='".$inventory['batchid']."' ");
			$stock_value = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock WHERE batchid='".$inventory['batchid']."'"));
			mysqli_query($_SESSION['connection'],"UPDATE stockissuance set unitprice='".$stock_value['amount']."'/'".$stock_value['quantity']."' WHERE batchid='".$inventory['batchid']."'");
			mysqli_query($_SESSION['connection'],"DELETE FROM stockissuance where batchid in(SELECT batchid from stockinventory where invoiceid='".$_GET['id']."' && batchid!='".$inventory['batchid']."')");
		} */
	}
	$TotalRows = mysqli_fetch_assoc(Stock_Status_Summary_Count());
	if($TotalRows['total']==0)
		echo '<td style="color:red;" colspan=14><center>No Data Found</center></td>';
	$Limit = 10;
	$total_pages = ceil($TotalRows['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	$summary = Stock_Status_Summary($Start,$Limit);
	echo "<br/><h3>INVOICE SUMMARY:Total Number of Invoices #".mysqli_num_rows($summary).'</h3><br/>';
	while($stock_summary = mysqli_fetch_assoc($summary))
	{
		if($stock_summary['excise'] == 0)
			$totalamount = $stock_summary['amount']+$stock_summary['taxamount'];
		else
			//$totalamount = $stock_summary['amount']+$stock_summary['taxamount']+$stock_summary['exciseamount'];
			$totalamount = $stock_summary['amount']+$stock_summary['exciseamount']+(($stock_summary['amount']+$stock_summary['exciseamount'])*$stock_summary['percent']/100);
			
		$totalexciseamount = number_format($stock_summary['sum(exciseamount)'],2);
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
					echo '<td>YES</td>';
				if($stock_summary['inspection'] >= 1)
					echo'<td>No Action</td>';
				else
					echo'<td><a href="?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Summary&id='.$stock_summary['id'].'">DELETE</a></td>';
				?>
				<td><a href="#" onclick="window.open('includes/Invoicesummarydownload.php?id=<?php echo $stock_summary['id'];?>', '_blank');"><img src="images/icons/download.png"></a></td>
				<td><a href="#" onclick="window.open('includes/Invoice_Imagedownload.php?id=<?php echo $stock_summary['id'];?>&sfile=<?php echo $stock_summary['sfile'];?>', '_blank');"><img src="images/upload/<?php echo $stock_summary['sfile'];?>" width='25px' height='25px'></a></td>
		<?php
		echo '</tr>
		</tbody>';
	}
?>
</table>
</form>
<?php
	/*$GETParameters = "page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Summary&";
	if($total_pages > 1)
		include("includes/Pagination.php");*/
?>