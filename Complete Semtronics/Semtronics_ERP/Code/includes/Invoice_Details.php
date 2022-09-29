<?php
include('Config.php');
if($_GET['id'] && $_GET['number'] && $_GET['vendor'])
{
$stock_status = mysqli_fetch_assoc(
				mysqli_query($_SESSION['connection'],"SELECT batch.rawmaterialid,batch.id as bid,batch.number,locationid as lid,location.name as name,stockinventory.id,
				stockinventory.batchid as batchid,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,
				location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid 
				inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join 
				category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid
				where stockinventory.id='".$_GET['id']."' && invoice.number='".$_GET['number']."' && invoice.vendorid='".$_GET['vendor']."'"));
				
$_POST['rid'] = $stock_status['rawmaterialid'];
$_POST['bid'] = $stock_status['bid'];
$_POST['batchid'] = $stock_status['number'];
$_POST['description'] = $stock_status['description'];
$_POST['partnumber'] = $stock_status['partnumber'];
$_POST['quantity'] = $stock_status['quantity'];
$_POST['unitprice'] = $stock_status['unitprice'];
$_POST['location'] = $stock_status['name'];
$_POST['id'] = $stock_status['id'];
$_POST['lid'] = $stock_status['lid'];
$batchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from stockinventory where id='".$_GET['id']."'"));
$stinve = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unit from stockinventory where stockinventory.batchid='".$batchid['batchid']."' group by stockinventory.batchid"));
$st = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT quantity as total,unitprice from stock where stock.batchid='".$batchid['batchid']."'"));
if($batchid['inspection'] == 1)
	echo "<br/><br/><div class='message success'><b>Message</b> : No Provision to Update</div>";
	 ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<input type="hidden" name="vendorid" value="<?php if($_GET['vendor']) echo $_GET['vendor'];?>" required="required"/>
			<input type="hidden" name="number" value="<?php if($_GET['number']) echo $_GET['number'];?>" required="required"/>
			<div class="clearfix">
				<label>
					<strong>Rawmaterial </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					?>
					<select id="materialcode" required="required" name="materialcode">
						<option value="">Select</option>
					<?php
						$fetchrawmaterial = mysqli_query($_SESSION['connection'],"Select * From rawmaterial");
						echo $_POST['bid'];echo $rawmaterials['id'];
						while($rawmaterials = mysqli_fetch_array($fetchrawmaterial))
						{
							if($_GET['id'] && ($_POST['rid'] == $rawmaterials['id']))
								echo '<option value="'.$rawmaterials['id'].'" selected>'.$rawmaterials['materialcode'].'</option>';
							else
								echo'<option value="'.$rawmaterials['id'].'" >'.$rawmaterials['materialcode'].'</option>';
						}
					?>
					</select>
				</label>
				<label>
					<strong>Batch </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" autocomplete="off" id="batchid" required="required" name="batchid" value="<?php echo $_POST['batchid']; ?>"/>
				</label>
				<label>
					<strong>Quantity </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" autocomplete="off" id="quantity" required="required" name="quantity" value="<?php echo $_POST['quantity']; ?>"/>
				</label>
				<label>
					<strong>Unitprice</strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" autocomplete="off" id="unitprice" name="unitprice" required="required" value="<?php echo $_POST['unitprice']; ?>"/>
				</label>
			</div>
			<div class="clearfix">
				<label>
				<strong>Location </strong><font color="red">*</font>
					<select id="locationid" name="lid" required="required">
						<option value="">Select</option>
						<?php
							$Location = mysqli_query($_SESSION['connection'],"SELECT * from location");
							while($Locations = mysqli_fetch_array($Location))
							{
								if($_GET['id']&&($_POST['lid']==$Locations['id']))
									echo '<option value="'.$Locations['id'].'" selected>'.$Locations['name'].'</option>';
								else
									echo '<option value="'.$Locations['id'].'">'.$Locations['name'].'</option>';
							}
						?>
					</select>
				</label><br/><br/>
				<?php
					if($batchid['inspection'] == 0)
						echo '<input class="button button-green" type="submit" value="Update" id="update" name="update">';
					else					
						echo'<input class="button button-green" type="hidden" value="Update" id="update" name="update">';
				?>
			</div>
		</form>
	</div>
<?php
}
$batchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from stockinventory where id='".$_POST['id']."'"));
$stinve = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT inspection from stockinventory where stockinventory.id='".$_GET['id']."&&'stockinventory.batchid='".$batchid['batchid']."'"));
if($stinve['inspection'] == 0)
{
	if($_POST['update'])
	{
		$invoicetax = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT batchid,tax.percent,invoice.id as invoiceid FROM tax join stockinventory on tax.id=taxid join invoice on invoice.id=invoiceid WHERE invoice.number='".$_POST['number']."'"));
		$batch = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT batch.number FROM stockinventory join batch on batch.id=batchid WHERE invoice.number='".$_POST['number']."'"));
		$batch_id = $batch = mysqli_fetch_assoc(Batch_Selection()); 
		if($_POST['batchid'] != $batch['batchid'])
			mysqli_query($_SESSION['connection'],"UPDATE batch SET number='".$_POST['batchid']."',rawmaterialid='".$_POST['materialcode']."' WHERE batch.id='".$invoicetax['batchid']."'");
		
		mysqli_query($_SESSION['connection'],"UPDATE stockinventory set quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',amount=('".$_POST['quantity']."' * '".$_POST['unitprice']."'),taxamount=((('".$_POST['quantity']."' * '".$_POST['unitprice']."')*('".$invoicetax['percent']."'))/'100'),locationid='".$_POST['lid']."' WHERE id='".$_POST['id']."'");	
		$invid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from invoice where id='".$invoicetax['invoiceid']."'"));
		$s = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(amount) as amt,invoiceid FROM stockinventory where invoiceid='".$invid['id']."' group by invoiceid"));
		$etax = explode(",",$invid['excisetax']);
		mysqli_query($_SESSION['connection'],"UPDATE invoice,(select sum(amount) as amt from stockinventory where invoiceid ='".$s['invoiceid']."' group by invoiceid)as s SET exciseamount=((s.amt*('".$etax[0]."'+'".$etax[1]."'+'".$etax[2]."'))/'100') WHERE invoice.id='".$s['invoiceid']."'");
		$proc = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unit,sum(stockinventory.amount) as amount,sum(stockinventory.taxamount) as taxamount from stockinventory where stockinventory.batchid='".$batchid['batchid']."' group by stockinventory.batchid"));
		mysqli_query($_SESSION['connection'],"UPDATE stock set quantity='".$proc['total']."',unitprice='".$proc['unit']."',amount='".$proc['amount']."',taxamount='".$proc['taxamount']."' where stock.batchid='".$batchid['batchid']."'");
		echo "<br/><br/><div class='message success'><b>Message</b> : Details Updated Successfully</div>";
		echo '<br/><table class="paginate sortable full">
		<thead>
			<tr>
				<th>Sl.No.</th>
				<th>RawmaterialCode</th>
				<th>Category Name</th>
				<th>Part No</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Amount</th>
				<th>Location</th>
				<!--th>Action</th-->
			</tr>
		</thead>';
		$_POST['vendor'] = $_POST['vendorid'];
		$stock_status = mysqli_query($_SESSION['connection'],"SELECT stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendor']."'");
		$i=1;
		while($stock = mysqli_fetch_assoc($stock_status))
		{
			$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT stockinventory.inspection,taxid as tid,invoice.excise,stockinventory.taxamount,stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."'"));
			$totalamount = $stock['amount'] +  $stock['taxamount'];
			echo'<tbody>
					<tr>
						<td>'.$i++.'</td>
						<td>'.$stock['materialcode'].'</td>
						<td>'.$stock['catname'].'</td>
						<td>'.$stock['partnumber'].'</td>
						<td>'.$stock['description'].'</td>
						<td>'.$stock['quantity'].'</td>
						<td>'.$stock['unitprice'].'</td>
						<td>'.number_format($stock['amount'],2).'</td>
						<td>'.$stock['name'].'</td>';
				//if($inspection['inspection']==0)
					//echo'<td><a href="?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$_POST['number'].'&vendor='.$_POST['vendorid'].'&id='.$stock['id'].'">Edit</a></td>';
				//else
					echo'<td>No Action</td>
				</tr>
				</tbody>';
		}
		echo'</table>';
		$exciseamt = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM invoice WHERE number='".$_POST['number']."'"));
		$FetchExciseTax = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from tax where id='1'"));
		$stock = mysqli_fetch_assoc(StockInvoiceTotal());
		if($exciseamt['excise']==0)
		{
			$exciseamount = ($stock['amount']*$FetchExciseTax['percent'])/100;
			$taxnumber = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$stock['tid']."'"));
			$TotalAmount = $stock['amount']+$stock['taxamount']+$stock['couriers'];
			echo '<br/>
			<table class="paginate sortable full" style="margin-left:700px;width:300px;">
				<tr><td align="left">Total Amount:</th><td align="right">'.number_format($stock['amount'],2).'</td></tr>
				<tr><td align="left">ExciseDuty_Tax:</td><td align="right">-</td></tr>
				<tr><td align="left">Totalamount With ExciseTax:</td><td align="right">-</td></tr>
				<tr><td align="left">Tax Amount:</td><td align="right">'.number_format($stock['taxamount'],2).'</td></tr>
				<tr><td align="left">Courier Charges:</td><td align="right">'.$stock['couriers'].'</td></tr>
				<tr><td align="left">Total With Tax Amount:</td><td align="right">'.number_format($TotalAmount ,2).'</td></tr>
			</table><br/>';
		}
		else
		{
			$exciseamount = ($stock['amount']*$FetchExciseTax['percent'])/100;
			$taxnumber = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$stock['tid']."'"));
			$TotalAmountWithExcise = ($stock['amount']*$FetchExciseTax['percent'])/100+$stock['amount'];
			//$Totalamount_With_Tax = $TotalAmountWithExcise+$stock['taxamount'];
			$Taxamount = ($TotalAmountWithExcise * $taxnumber['percent'])/100;
			$Totalamount_With_Tax = $TotalAmountWithExcise+$Taxamount+$stock['couriers'];
			echo '<br/>
			<table class="paginate sortable full" style="margin-left:700px;width:300px;">
				<tr><td align="left">Total Amount:</th><td align="right">'.number_format($stock['amount'],2).'</td></tr>
				<tr><td align="left">ExciseDuty_Tax:</td><td align="right">'.$FetchExciseTax['percent'].'%</td></tr>
				<tr><td align="left">Totalamount With ExciseTax:</td><td align="right">'.number_format($TotalAmountWithExcise,2).'</td></tr>
				<tr><td align="left">Tax Amount:</td><td align="right">'.number_format($Taxamount,2).'</td></tr>
				<tr><td align="left">Courier Charges:</td><td align="right">'.$stock['couriers'].'</td></tr>
				<tr><td align="left">Total With Tax Amount:</td><td align="right">'.number_format($Totalamount_With_Tax,2).'</td></tr>
			</table><br/>';
		}
	} 
}
//else
	//echo "<br/><div class='message success'><b>Message</b> : No Provision to Update</div>";
if($_GET['number'] && $_GET['vendor'])
{
$_POST['number']= $_GET['number'];
$_POST['vendorid']= $_GET['vendor'];
$i=1;
echo '<br/><br/><table class="paginate sortable full">
		<thead>
			<tr>
				<th>Sl.No.</th>
				<th>RawmaterialCode</th>
				<th>Category Name</th>
				<th>Part No</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Amount</th>
				<th>Location</th>
				<!--th>Action</th-->
			</tr>
		</thead>';
	$stock_status = Stock_Status_Onaddnumber();
	while($stock = mysqli_fetch_assoc($stock_status))
	{
		$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT stockinventory.inspection,taxid as tid,invoice.excise,stockinventory.taxamount,stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."'"));
		$totalamount = $stock['taxamount'] + $stock['amount'];
		echo'<tbody><tr>
					<td>'.$i++.'</td>
					<td>'.$stock['materialcode'].'</td>
					<td>'.$stock['catname'].'</td>
					<td>'.$stock['partnumber'].'</td>
					<td>'.$stock['description'].'</td>
					<td>'.$stock['quantity'].'</td>
					<td>'.$stock['unitprice'].'</td>
					<td>'.number_format($stock['amount'],2).'</td>
					<td>'.$stock['name'].'</td>';
				//if($inspection['inspection']==0)
					//echo'<td><a href="?page=Stores&subpage=spage->Stock_Management,ssubpage->Invoice_Details&number='.$_POST['number'].'&vendor='.$_POST['vendorid'].'&id='.$stock['id'].'">Edit</a></td>';
				//else
					echo'<!--td>No Action</td-->
				</tr>
				</tbody>';
	}
	echo'</table>';
	$exciseamt = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM invoice WHERE number='".$_GET['number']."'"));
	$FetchExciseTax = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from tax where id='1'"));
	$stock = mysqli_fetch_assoc(StockInvoiceTotal());
	if($exciseamt['excise']==0)
	{
		$exciseamount = ($stock['amount']*$FetchExciseTax['percent'])/100;
		$taxnumber = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$stock['tid']."'"));
		$TotalAmount = $stock['amount']+$stock['taxamount']+$stock['couriers'];
		echo '<br/>
		<table class="paginate sortable full" style="margin-left:700px;width:300px;">
			<tr><td align="left">Total Amount:</th><td align="right">'.number_format($stock['amount'],2).'</td></tr>
			<tr><td align="left">ExciseDuty_Tax:</td><td align="right">-</td></tr>
			<tr><td align="left">Totalamount With ExciseTax:</td><td align="right">-</td></tr>
			<tr><td align="left">Tax Amount:</td><td align="right">'.number_format($stock['taxamount'],2).'</td></tr>
			<tr><td align="left">Courier Charges:</td><td align="right">'.number_format($stock['couriers'],2).'</td></tr>
			<tr><td align="left">Total With Tax Amount:</td><td align="right">'.number_format($TotalAmount,2).'</td></tr>
		</table><br/>';
	}
	else
	{
		$exciseamount = ($stock['amount']*$FetchExciseTax['percent'])/100;
		$taxnumber = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$stock['tid']."'"));
		$TotalAmountWithExcise = ($stock['amount']*$FetchExciseTax['percent'])/100+$stock['amount'];
		$Taxamount = ($TotalAmountWithExcise * $taxnumber['percent'])/100;
		$Totalamount_With_Tax = $TotalAmountWithExcise+$Taxamount+$stock['couriers'];
		echo '<br/>
		<table class="paginate sortable full" style="margin-left:700px;width:300px;">
			<tr><td align="left">Total Amount:</th><td align="right">'.number_format($stock['amount'],2).'</td></tr>
			<tr><td align="left">ExciseDuty_Tax:</td><td align="right">'.$FetchExciseTax['percent'].'%</td></tr>
			<tr><td align="left">Totalamount With ExciseTax:</td><td align="right">'.number_format($TotalAmountWithExcise,2).'</td></tr>
			<tr><td align="left">Tax Amount:</td><td align="right">'.number_format($Taxamount,2).'</td></tr>
			<tr><td align="left">Courier Charges:</td><td align="right">'.number_format($stock['couriers'],2).'</td></tr>
			<tr><td align="left">Total With Tax Amount:</td><td align="right">'.number_format($Totalamount_With_Tax,2).'</td></tr>
		</table><br/>';
	}
}
if(!$_GET['id'] && !$_GET['invoiceid'] && !$_GET['vendor'] && !$_GET['number'] && !$_POST['update'])
	echo "<br/><br/><b>Please add Invoice Or Select Invoice From Invoice Summary to view Invoice Details</b>";
else{}
?>