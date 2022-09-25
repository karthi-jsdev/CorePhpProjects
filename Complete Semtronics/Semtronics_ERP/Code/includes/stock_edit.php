<?php
session_start();
ini_set("display_errors","0");
include('Config.php');
include('Stock_Management_Queries.php');
$_POST['id'] = $_GET['id'];
$_POST['materialcode'] = $_GET['materialcode'];
$_POST['batchnumber'] = $_GET['batchnumber'];
$_POST['quantity'] = $_GET['quantity'];
$_POST['unitprice'] = $_GET['unitprice'];
$_POST['amount'] = $_GET['amount'];
$_POST['taxid'] = $_GET['taxid'];
$_POST['taxamount'] = $_GET['taxamount'];
$_POST['totalamount'] = $_GET['totalamount'];
$_POST['vendorid'] = $_GET['vendorid'];
$_POST['locationid'] = $_GET['locationid'];
if($_GET['Action'] != "Update")
{
	$stock = mysql_fetch_assoc(Stock_Edit());
	?>
	<td colspan="7">
		<div style="border:2px solid red;border-radius:15px;background-color:#C0C0C0">
		<div class="clearfix">
			<label><strong>Raw Material </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div id="divmaterialcodeE">
					<select id="materialcodeE" name="materialcode" onchange="GetTax_Edit(this.value)" required="required">
						<option value="">Select</option>
						<?php
						echo Rawmaterial_Code($stock['rawmaterialid']);
						/*
						$raw_materialcode = Rawmaterial_Code();
						while($material_code = mysql_fetch_assoc($raw_materialcode))
						{
							if($material_code['id'] == $stock['rawmaterialid'])
								echo '<option value="'.$material_code['id'].'" selected="selected">'.$material_code['materialcode'].'</option>';
							else
								echo '<option value="'.$material_code['id'].'">'.$material_code['materialcode'].'</option>';
						} */?>
					</select>
				</div>
			</label>
			<?php
			$_POST['batchid'] = $stock['number'];
			$_SESSION['batchid'] = $stock['batchid'];
			?>
			<label><strong>Batch Number </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="batchnumberE" required="required" value="<?php echo $_POST['batchid']; ?>"/>
			</label>
			<?php $_POST['quantity'] = $stock['quantity'];?>
			<label><strong>Quantity </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="quantityE" required="required" name="quantity" value="<?php echo $_POST['quantity'];?>" onkeyup="additiondata();" onkeypress="return stock_quantity(event);"/>
			</label>
		</div>
		<div class="clearfix">
			<?php $_POST['unitprice'] = $stock['unitprice'];?>
			<label><strong>Unit Price </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="unitpriceE" required="required" name="unitprice" value="<?php echo $_POST['unitprice']; ?>" onkeyup="additiondata();" onkeypress="return Stock_unitprice(event);"/>
			</label>
			<label><strong>Amount </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="amountE" required="required" name="amount" value="<?php echo $_POST['quantity']*$_POST['unitprice'];?>" style="background-color:#E0E0E0;" readonly/>
			</label>
			<input type="hidden" id="percentE" value="<?php echo $stock['percent']; ?>" />
			<input type="hidden" id="idE" value="<?php echo $stock['taxid'];?>" />
			<label><strong>Applicable Tax </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div id="changetaxE">
					<select id="taxidE" name="taxid" required="required" onchange='var OptionSplit = this.value.split(","); document.getElementById("percentE").value = OptionSplit[1];document.getElementById("idE").value = OptionSplit[0];'>
						<option value="">Select</option>
						<?php
						$Taxs = Select_All_Tax();
						while($Tax = mysql_fetch_assoc($Taxs))
						{
							if($Tax['id']==$stock['taxid'])
								echo '<option onclick="taxamountpercent();" value="'.$Tax['id'].','.$Tax['percent'].'" selected>'.$Tax['type'].'-'.$Tax['percent'].'%</option>';
							else
								echo '<option onclick="taxamountpercent();" value="'.$Tax['id'].','.$Tax['percent'].'">'.$Tax['type'].'-'.$Tax['percent'].'%</option>';
						}?>
					</select>
				</div>	
			</label>
		</div>
		<div class="clearfix">
			<?php $_POST['taxamount'] = $stock['taxamount'];?>
			<label><strong>Tax Amount </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="taxamountE" name="taxamount" value="<?php echo $_POST['taxamount']; ?>" style="background-color:#E0E0E0;" readonly/>
			</label>
			<label><strong>Total Amount </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" autocomplete="off" id="totalamountE" value="<?php echo $_POST['quantity']*$_POST['unitprice']+$_POST['taxamount']; ?>" style="background-color:#E0E0E0;" readonly/>
			</label>
			<label>
				<strong>Location </strong><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select id="locationid" name="locationid" required="required">
					<option value="">Select</option>
					<?php
						$Locations = mysql_query("SELECT * FROM location");
						
						while($Location = mysql_fetch_array($Locations))
						{
							if($Location['id']==$stock['locationid'])
								echo '<option value="'.$Location['id'].'" selected>'.$Location['name'].'</option>';
							else
								echo '<option value="'.$Location['id'].'">'.$Location['name'].'</option>';
						}
					?>
				</select>
			</label>
		</div>
		<center>
			<a class="button button-green" onclick="Stock_Actions(<?php echo $_POST['id']; ?>,'Update')">Update</a>
			<a class="button button-orange" onclick="Stock_Actions(<?php echo $_POST['id']; ?>,'Cancel')">Cancel</a>
		</center><hr />
		</div>
	</td>
<?php
}
else if($_GET['Action']=="Update")
{
	//$update = mysql_query("INSERT into batch (number) values ('".$_POST['batchnumber']."') select batchid from stockinventory where stockinventory.id='".$_POST['id']."'");
	if($batch_id = mysql_fetch_assoc(Stock_Edit_Batch()))
	{}
	else
	{
		Batch_Insertion();
		$batch_id = mysql_fetch_assoc(Stock_Edit_Batch());
	}
	//$OldBatch = mysql_fetch_array(mysql_query("SELECT batchid FROM stockinventory WHERE id=".$_POST['id']));
	mysql_query("Update stockinventory set batchid = '".$batch_id['id']."',quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',amount='".$_POST['amount']."',
		taxid='".$_POST['taxid']."',taxamount='".$_POST['taxamount']."',locationid='".$_POST['locationid']."' where stockinventory.id='".$_POST['id']."'");
	//if($stock_update = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount,sum(unitprice) as unitprice,taxid,sum(taxamount) as taxamount,stockinventory.locationid from stockinventory where batchid = '".$batch_id['id']."' group by stockinventory.batchid")))
	
	$stockinve_value = mysql_fetch_assoc(mysql_query("SELECT sum(quantity) as qty FROM `stock` WHERE batchid='".$batch_id['id']."'"));
	$stock_value = mysql_fetch_assoc(mysql_query("SELECT sum(quantity) as qt FROM `stock` WHERE batchid='".$batch_id['id']."'"));
	if($stock_update = mysql_fetch_assoc(mysql_query("select quantity,amount,unitprice,taxid,taxamount from stockinventory where batchid in(select batch.id from batch where batch.id='".$_POST['batchnumber']."')")))
	{
		if($stock_update['batchid'])
		{
			$stock_upd = mysql_fetch_assoc(mysql_query("select quantity,amount,unitprice,taxid,taxamount from stock where batchid in(select batch.id from batch where batch.id='".$_POST['batchnumber']."')"));
			$stock_update['quantity'] = $stock_update['quantity']+$stock_upd['quantity'];
			$stock_update['unitprice'] = $stock_update['unitprice']+$stock_upd['unitprice'];
			$stock_update['amount'] = $stock_update['amount']+$stock_upd['amount'];
			$stock_update['taxamount'] = $stock_update['taxamount']+$stock_upd['taxamount'];
			mysql_query("Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
				taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'");
		}
		else if($stockinve_value['qty'] != $stock_value['qt'])
		{
			$stock_update = mysql_fetch_assoc(mysql_query("select quantity,amount,unitprice,taxid,taxamount from stockinventory where batchid ='".$batch_id['id']."' ORDER BY DESC LIMIT 0,1"));
			$stock_upd = mysql_fetch_assoc(mysql_query("select quantity,amount,unitprice,taxid,taxamount from stock where batchid ='".$batch_id['id']."'"));
			if($stock_update['batchid'])
			{
				$stock_update['quantity'] = $stock_update['quantity']+$stock_upd['quantity'];
				$stock_update['unitprice'] = $stock_update['unitprice']+$stock_upd['unitprice'];
				$stock_update['amount'] = $stock_update['amount']+$stock_upd['amount'];
				$stock_update['taxamount'] = $stock_update['taxamount']+$stock_upd['taxamount'];
				mysql_query("Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
						taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'");
			}
		}
		else if($stockinve_value['qty'] == $stock_value['qt'])
		{
			$stock_update = mysql_fetch_assoc(mysql_query("select quantity,amount,unitprice,taxid,taxamount from stockinventory where batchid ='".$batch_id['id']."' ORDER BY DESC LIMIT 0,1"));
			echo "Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
			taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'";
			mysql_query("Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
			taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'");
		}
	}
		else
		{
			$stock_update = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount,sum(unitprice) as unitprice,taxid,sum(taxamount) as taxamount,stockinventory.locationid from stockinventory where batchid = '".$batch_id['id']."' group by stockinventory.batchid"));
			mysql_query("Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
			taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'");
		}
	$edited_stock = mysql_query("SELECT stockinventory.id,rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stockinventory.quantity,stockinventory.unitprice,stockinventory.amount,stockinventory.locationid
								FROM rawmaterial
								inner join batch on batch.rawmaterialid=rawmaterial.id
								inner join stockinventory on stockinventory.batchid=batch.id
								inner join category on category.id=rawmaterial.categoryid
								inner join invoice on stockinventory.invoiceid=invoice.id
								where stockinventory.id ='".$_POST['id']."'");
								
	while($stock = mysql_fetch_assoc($edited_stock))
	{
		$Locationname = mysql_fetch_array(mysql_query("SELECT * FROM location WHERE id ='".$stock['locationid']."' "));
		echo'<td>'.$stock['materialcode'].'</td>
			<td>'.$stock['name'].'</td>
			<td>'.$stock['partnumber'].'</td>
			<td>'.$stock['description'].'</td>
			<td>'.$stock['quantity'].'</td>
			<td>'.$stock['unitprice'].'</td>
			<td>'.$stock['amount'].'</td>
			<td>'.$Locationname['name'].'</td>
			<td><a href="#" onclick="Stock_Actions('.$stock['id'].', \'Edit\')">Edit|</a><a href="#" onclick="Stock_Actions('.$stock['id'].', \'Delete\')">Delete</a></td>';
	}
}
?>