<?php
	session_start();
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	include("Config.php");
	$_POST['issuancedate'] = $_GET['issuancedate'];
	$_POST['number'] = $_GET['number'];
	$_POST['issuedto'] = $_GET['issuedto'];
	$_POST['id'] = $_GET['rawmaterialid'];
	$_POST['batchid'] = $_GET['batchid'];
	$_POST['quantity'] = $_GET['quantity'];
	$_POST['ids'] = $_GET['getid'];
	/* if($_GET['getid'])
	{
		echo "SELECT * FROM stockissuance WHERE id='".$_POST['id']."'";
		//$StockIssuance = mysql_fetch_assoc(mysql_query("SELECT * FROM stockissuance WHERE id='".$_POST['id']."'"));
		echo "UPDATE stock SET quantity=quantity+".$StockIssuance['quantity'].", amount=amount+".$StockIssuance['amount'].", taxamount=taxamount+".$StockIssuance['taxamount']." WHERE batchid=".$_POST['batchid']."";
		//mysql_query("UPDATE stock SET quantity=quantity+".$StockIssuance['quantity'].", amount=amount+".$StockIssuance['amount'].", taxamount=taxamount+".$StockIssuance['taxamount']." WHERE batchid=".$_POST['batchid']."");
		//$Stock = mysql_fetch_assoc(mysql_query("SELECT *,sum(stockinventory.quantity) as qty FROM stock join stockinventory on stockinventory.batchid=stock.batchid WHERE stockinventory.batchid='".$_POST['batchid']."' && stockinventory.inspection='1' group by stockinventory.batchid"));
		//mysql_query("UPDATE stock SET quantity=quantity-".$_POST['quantity'].", amount=amount-(unitprice*".$_POST['quantity']."), taxamount=taxamount-((taxamount/quantity)*".$_POST['quantity'].") WHERE batchid='".$_POST['batchid']."'");
		//mysql_query("UPDATE stockissuance SET batchid='".$_POST['batchid']."', quantity='".$_POST['quantity']."', unitprice='".$Stock['unitprice']."', amount='".($Stock['unitprice']*$_POST['quantity'])."', taxid='".$Stock['taxid']."', taxamount='".(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity'])."' WHERE id='".$_POST['id']."'");
	}
	else
	{ */
	if($Stock = mysql_fetch_assoc(mysql_query("SELECT * FROM stock WHERE batchid=".$_POST['batchid']))) 
	{
		$stockqty = mysql_fetch_assoc(mysql_query("SELECT sum(stockinventory.quantity) as qty FROM stock join stockinventory on stockinventory.batchid=stock.batchid WHERE stockinventory.batchid='".$_POST['batchid']."' && stockinventory.inspection='1' group by stockinventory.batchid"));
		if(!$_SESSION['IssuanceId'])
		{
			if(!$Issuance = mysql_fetch_array(mysql_query("SELECT id, number FROM issuance WHERE number=".$_POST['number']."")))
			{
				if($_POST['quantity']==0)
					{}//echo "<br /><div class='message error'><b>Message</b> : Sorry!!! Zero Quantity cannot be added</div>";
				else
				{
					mysql_query("INSERT INTO issuance VALUES('', '".$_POST['number']."', '".date("Y-m-d H:i:s")."', '".$_POST['issuancedate']."')");
					$Issuance = mysql_fetch_array(mysql_query("SELECT id FROM issuance ORDER BY id DESC LIMIT 0,1"));
				}
			}
			$_SESSION['IssuanceId'] = $Issuance['id'];
		}
		if($_POST['ids'])
		{
			if($_POST['quantity']==0)
				echo "<br /><div class='message error'><b>Message</b> : Sorry!!! Zero Quantity cannot be added</div>";
			else
			{
				if($stockqty['qty'] < $_POST['quantity'])
					echo "<br /><div class='message error'><b>Message</b> : Specified quantity is greater than availabile quantity</div>";
				else
				{
					mysql_query("UPDATE stock SET quantity='".($Stock['quantity'] - $_POST['quantity'])."', amount='".($Stock['amount'] - ($Stock['unitprice'] * $_POST['quantity']))."', taxamount='".($Stock['taxamount']-(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity']))."' WHERE batchid='".$_POST['batchid']."'");
					mysql_query("INSERT INTO stockissuance VALUES('', '".$_SESSION['IssuanceId']."', '".$_POST['batchid']."', '".$_POST['quantity']."', '".$Stock['unitprice']."', '".($Stock['unitprice']*$_POST['quantity'])."', '".$Stock['taxid']."', '".(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity'])."', '".$_POST['issuedto']."')"); 
				}
			}
		}
		else
		{
			if($_POST['quantity']==0)
				echo "<br /><div class='message error'><b>Message</b> : Sorry!!! Zero Quantity cannot be added</div>";
			else if($stockqty['qty'] < $_POST['quantity'])
				echo "<br /><div class='message error'><b>Message</b> : Specified quantity is greater than availabile quantity</div>";
			else
			{
				mysql_query("UPDATE stock SET quantity='".($Stock['quantity'] - $_POST['quantity'])."', amount='".($Stock['amount'] - ($Stock['unitprice'] * $_POST['quantity']))."', taxamount='".($Stock['taxamount']-(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity']))."' WHERE batchid='".$_POST['batchid']."'");
				mysql_query("INSERT INTO stockissuance VALUES('', '".$_SESSION['IssuanceId']."', '".$_POST['batchid']."', '".$_POST['quantity']."', '".$Stock['unitprice']."', '".($Stock['unitprice']*$_POST['quantity'])."', '".$Stock['taxid']."', '".(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity'])."', '".$_POST['issuedto']."')"); 
			}
		}
	}
?>
<table class="paginate sortable full">
	<tr>
		<th>slno</th>
		<th>Material Code</th>
		<th>Product Quantity</th>
		<th>Inventory Quantity</th>
		<th>Issuance Quantity</th>
		<th>Action</th>
	</tr>
<?php
	$i=1;
	$productid = $_GET['productid'];
	$kittingquantity = $_GET['kittingquantity'];
	$kittinglist = mysql_query("SELECT stockissuance.id as siid,materialcode,rawmaterial.id,productbom.quantity as qty,productbom.productcode,sum(stockinventory.quantity) as quantity,sum(stockissuance.quantity) as squantity
									FROM rawmaterial 
									join batch on batch.rawmaterialid=rawmaterial.id 
									join stockinventory on stockinventory.batchid=batch.id
									join stockissuance on stockissuance.batchid=batch.id
									join issuance on stockissuance.issuanceid=issuance.id
									join issuanceuser on stockissuance.issuedto=issuanceuser.id
									join productbom on productbom.rawmaterialid=rawmaterial.id
									join products on products.id=productbom.productcode 
									where issuance.number='".$_GET['number']."' && productbom.productcode='".$_GET['productid']."' && issuedto='".$_POST['issuedto']."' && stockinventory.inspection='1' group by batch.id");
	while($kitting_list = mysql_fetch_assoc($kittinglist))
	{
		echo '<tr>
				<td>'.$i++.'</td>
				<td>'.$kitting_list['materialcode'].'</td>
				<td>'.$kitting_list['qty'].'</td>
				<td>'.$kitting_list['quantity'].'</td>
				<td>'.$kitting_list['squantity'].'</td>
				<td><a href="?page=Stores&subpage=spage->Issuance,ssubpage->Kitting&kittingqty='.$kittingquantity.'&productid='.$productid.'&id='.$kitting_list['siid'].'&rid='.$kitting_list['id'].'&action=Edit">Edit</a>|<a href="?page=Stores&subpage=spage->Issuance,ssubpage->Kitting&kittingqty='.$kittingquantity.'&productid='.$productid.'&id='.$kitting_list['siid'].'&rid='.$kitting_list['id'].'&action=delete" onclick="return deleteissuance();">Delete</a></td></td>
		</tr>';
	}
	?>
</table>