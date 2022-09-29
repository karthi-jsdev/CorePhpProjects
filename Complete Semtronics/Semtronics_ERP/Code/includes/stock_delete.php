<?php
	include('Config.php');
	//include('Stock_Management_Queries.php');
	ini_set("display_errors","0");
	if($_GET['Action'] == 'Delete')
	{
		$stock_batchid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT stockinventory.batchid from stockinventory where stockinventory.id='".$_GET['id']."'"));
		mysqli_query($_SESSION['connection'],"DELETE FROM stockinventory where stockinventory.id='".$_GET['id']."'");
		if($stock_update = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unitt,sum(stockinventory.amount)as amt, stockinventory.taxid, sum(stockinventory.taxamount) as taxamt from stockinventory where stockinventory.batchid='".$stock_batchid['batchid']."' group by stockinventory.batchid")))
		mysqli_query($_SESSION['connection'],"update stock set quantity='".$stock_update['total']."',unitprice='".$stock_update['unitt']."',amount='".$stock_update['amt']."',taxid='". $stock_update['taxid']."',
									taxamount='".$stock_update['taxamt']."' where stock.batchid='".$stock_batchid['batchid']."'");
		else
			mysqli_query($_SESSION['connection'],"DELETE FROM stock where stock.batchid='".$stock_batchid['batchid']."'");
	}         
	?>