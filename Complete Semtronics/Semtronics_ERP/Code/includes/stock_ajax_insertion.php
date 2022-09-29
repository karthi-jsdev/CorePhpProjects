<?php
session_start();
include('Config.php');
ini_set("display_errors","0");
include('Stock_Management_Queries.php');
if(isset($_GET['vendorid'])||isset($_GET['date'])||isset($_GET['materialcode'])||isset($_GET['batchnumber'])||isset($_GET['quantity'])||isset($_GET['unitprice'])||isset($_GET['amount'])||isset($_GET['taxid'])||isset($_GET['taxamount'])||isset($_GET['number']) || isset($_GET['excise']) || isset($_GET['excises']) || isset($_GET['ecisetax1']) || isset($_GET['ecisetax2']) || isset($_GET['ecisetax3'])|| isset($_GET['couriers']))
{
	$_POST['materialcode'] = $_GET['materialcode'];
	$_POST['batchnumber'] = $_GET['batchnumber'];
	$_POST['quantity'] = $_GET['quantity'];
	$_POST['unitprice'] = $_GET['unitprice'];
	$_POST['amount'] = $_GET['amount'];
	$_POST['taxid'] = $_GET['taxid'];
	$_POST['taxamount'] = $_GET['taxamount'];
	$_POST['vendorid'] = $_GET['vendorid'];
	$_POST['number'] = $_GET['number'];
	$_POST['date'] = $_GET['date'];
	$_POST['locationid'] = $_GET['locationid'];
	$_POST['excise'] = $_GET['excise'];
	$_POST['ecisetax1'] = $_GET['ecisetax1'];
	$_POST['ecisetax2'] = $_GET['ecisetax2'];
	$_POST['ecisetax3'] = $_GET['ecisetax3'];
	$_POST['excises'] = $_GET['excises'];
	$_POST['couriers'] = $_GET['couriers'];
	$_POST['sfile']=$_SESSION['Uploaded_Image'];
	
	function stock_inventory_insert()
	{
		$invoiceid = mysqli_fetch_assoc(Invoice_Selection_ForStock());
			$_POST['invoiceid'] = $invoiceid['id'];
		$batch_id = $batch = mysqli_fetch_assoc(Batch_Selection()); 
		if($_POST['batchnumber'] == $batch_id['number'])
		{
			$_POST['batchid'] = $batch_id['id'];
				Stock_Inventory_Insertion();
			$stock_batchid = $batch_idd = mysqli_fetch_assoc(Batch_id_Selection());
			$stockbatchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock where batchid in(select batch.id from batch where batch.number='".$_POST['batchnumber']."' && rawmaterialid='".$_POST['materialcode']."')"));
			if($stockbatchid['batchid'])
			{
				$_POST['quantity'] = $stockbatchid['quantity']+$_POST['quantity'];
				//$_POST['unitprice'] = $stockbatchid['unitprice']+$_POST['unitprice'];
				//$_POST['amount'] = $stockbatchid['amount']+$_POST['amount'];
				
				$_POST['amount'] = $stockbatchid['amount']+$_POST['amount'];
				$_POST['unitprice'] = $_POST['amount'] / $_POST['quantity'];
				
				$_POST['taxamount'] = $stockbatchid['taxamount']+$_POST['taxamount'];
				mysqli_query($_SESSION['connection'],"update stock set quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',
													amount='".$_POST['amount']."',taxid='". $_POST['taxid']."',
													taxamount='".$_POST['taxamount']."' where stock.batchid='".$stockbatchid['batchid']."'");
			}
			else if(!($_POST['batchid'] == $stock_batchid['batchid']))
				Stock_Insertion();
		}
		else
		{
			Batch_Insertion();
			$batch_id = $batch = mysqli_fetch_assoc(Batchid_Recent()); 
				$_POST['batchid'] = $batch_id['id'];
				Stock_Inventory_Insertion();
			$stock_batchid = $batch_idd = mysqli_fetch_assoc(Batch_id_Selection());
			$stockbatchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock where batchid in(select batch.id from batch where batch.number='".$_POST['batchnumber']."' && rawmaterialid='".$_POST['materialcode']."')"));
			if($stockbatchid['batchid'])
			{
				$_POST['quantity'] = $stockbatchid['quantity']+$_POST['quantity'];
				//$_POST['unitprice'] = $stockbatchid['unitprice']+$_POST['unitprice'];
				//$_POST['amount'] = $stockbatchid['amount']+$_POST['amount'];
				
				$_POST['amount'] = $stockbatchid['amount']+$_POST['amount'];
				$_POST['unitprice'] = $_POST['amount'] / $_POST['quantity'];
				$_POST['taxamount'] = $stockbatchid['taxamount']+$_POST['taxamount'];
				mysqli_query($_SESSION['connection'],"update stock set quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',
													amount='".$_POST['amount']."',taxid='". $_POST['taxid']."',
													taxamount='".$stockbatchid['taxamount']."' where stock.batchid='".$stockbatchid['batchid']."'");
			}
			else if(!($_POST['batchid'] == $stock_batchid['batchid']))
				Stock_Insertion();
		}
	}
	//$_SESSION['check']="";
	if($_SESSION['check']=="")
	{
		$invoice = Invoice_Stock_Selection();
		if(mysqli_num_rows($invoice)>0)
		{
			echo "<br /><div id='delet' class='message error'><b>Message</b> : Invoice Already Exists For This Vendor</div>";
		}
		else
		{
			Invoice_Insertion();
			stock_inventory_insert();
			$invid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from invoice ORDER BY id DESC LIMIT 0,1"));
			if($invid['excise']==0)
			{}
			else
			{
				$s = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(amount) as amt,invoiceid FROM stockinventory where invoiceid='".$invid['id']."' group by invoiceid"));
				mysqli_query($_SESSION['connection'],"UPDATE invoice,(select sum(amount) as amt from stockinventory where invoiceid ='".$s['invoiceid']."' group by invoiceid)as s SET exciseamount=((s.amt*('".$_POST['ecisetax1']."'+'".$_POST['ecisetax2']."'+'".$_POST['ecisetax3']."'))/'100') WHERE invoice.id='".$s['invoiceid']."'");
			}
			$_SESSION['check'] = $_GET['randomnumber'];
		}
	}
	else
	{
		if($_SESSION['check'] == $_GET['randomnumber'])
		{
			stock_inventory_insert();
			$invid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from invoice ORDER BY id DESC LIMIT 0,1"));
			if($invid['excise']==0)
			{}
			else
			{
				$s = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(amount) as amt,invoiceid FROM stockinventory where invoiceid='".$invid['id']."' group by invoiceid"));
				mysqli_query($_SESSION['connection'],"UPDATE invoice,(select sum(amount) as amt from stockinventory where invoiceid ='".$s['invoiceid']."' group by invoiceid)as s SET exciseamount=((s.amt*('".$_POST['ecisetax1']."'+'".$_POST['ecisetax2']."'+'".$_POST['ecisetax3']."'))/'100') WHERE invoice.id='".$s['invoiceid']."'");
			}	
		}
		else
		{
			$invoice = Invoice_Stock_Selection();
			if(mysqli_num_rows($invoice)>0)
			{
				echo "<br /><div id='dele' class='message error'><b>Message</b> : Invoice Already Exists For This Vendor</div>";
			}
			else
			{
				Invoice_Insertion();
				stock_inventory_insert();
				$invid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from invoice ORDER BY id DESC LIMIT 0,1"));
				if($invid['excise']==0)
				{}
				else
				{
					$s = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(amount) as amt,invoiceid FROM stockinventory where invoiceid='".$invid['id']."' group by invoiceid"));
					mysqli_query($_SESSION['connection'],"UPDATE invoice,(select sum(amount) as amt from stockinventory where invoiceid ='".$s['invoiceid']."' group by invoiceid)as s SET exciseamount=((s.amt*('".$_POST['ecisetax1']."'+'".$_POST['ecisetax2']."'+'".$_POST['ecisetax3']."'))/'100') WHERE invoice.id='".$s['invoiceid']."'");
				}
				//mysqli_query($_SESSION['connection'],"UPDATE invoice SET exciseamount=(('".$s['amt']."'*'10.36')/'100') WHERE invoice.id='".$s['invoiceid']."'");
				$_SESSION['check'] = $_GET['randomnumber'];
			}
		}
	}
}
	$batch_id = $batch = mysqli_fetch_assoc(Batch_Selection());
		$_POST['batchid'] = $batch_id['id'];
	$d = mysqli_fetch_assoc(Stock_Value_Batching());
		$_POST['total'] = $d['total'];		
		$_POST['unitt'] = $d['unitt'];		
		$_POST['amt'] =  $d['amt'];		
		$_POST['taxid'] =  $d['taxid'];		
		$_POST['taxamt'] =  $d['taxamt'];
	//$batchid = $batch = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM batch where batch.number = '".$_POST['batchnumber']."'"));
	/*$stockbatchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT * FROM stock where batchid in(select batch.id from batch where batch.number='".$_POST['batchnumber']."')"));
	if($stockbatchid['batchid'])
	{
		$_POST['quantity'] = $stockbatchid['quantity']+$_POST['quantity'];
		$_POST['unitprice'] = $stockbatchid['unitprice']+$_POST['unitprice'];
		$_POST['amount'] = $stockbatchid['amount']+$_POST['amount'];
		$_POST['taxamount'] = $stockbatchid['taxamount']+$_POST['taxamount'];
		mysqli_query($_SESSION['connection'],"update stock set quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',
											amount='".$_POST['amount']."',taxid='". $_POST['taxid']."',
											taxamount='".$_POST['taxamount']."' where stock.batchid='".$stockbatchid['batchid']."'");
	}*/
//	else
	//{//echo "insert into stock (batchid,quantity,unitprice,amount,taxid,taxamount) values ('".$_POST['batchid']."','".$_POST['quantity']."','".$_POST['unitprice']."','".$_POST['amount']."','".$_POST['taxid']."','".$_POST['taxamount']."')";
		//mysqli_query($_SESSION['connection'],"insert into stock (batchid,quantity,unitprice,amount,taxid,taxamount) values ('".$_POST['batchid']."','".$_POST['quantity']."','".$_POST['unitprice']."','".$_POST['amount']."','".$_POST['taxid']."','".$_POST['taxamount']."')");
	//}						
//$invoice = Invoice_Stock_Selection();			
/* if(!mysqli_num_rows($invoice)>0)
{ */
	$add_stock = Stock_Editing();
	while($stock = mysqli_fetch_assoc($add_stock))
	{
		echo'<tr id="'.$stock['id'].'">
				<td>'.$stock['materialcode'].'</td>
				<td>'.$stock['name'].'</td>
				<td>'.$stock['partnumber'].'</td>
				<td>'.$stock['description'].'</td>
				<td>'.$stock['quantity'].'</td>
				<td>'.$stock['unitprice'].'</td>
				<td>'.$stock['amount'].'</td>
				<td>'.$stock['locationname'].'</td>
				<td><a href="#" onclick="Stock_Actions('.$stock['id'].', \'Edit\')"></a><a href="#" onclick="return Stock_Actions('.$stock['id'].', \'Delete\')">Delete</a></td>
			</tr>';
	}
/* } */?>