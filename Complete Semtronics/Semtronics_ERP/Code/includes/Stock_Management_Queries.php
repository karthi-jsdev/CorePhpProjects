<?php
#Stock Management
function Select_All_Tax()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM tax");
}
function Vendor_Dropdowndisplay()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor");
}
function Location_Select_All()
{
	return mysqli_query($_SESSION['connection'],"SELECT * from location order by name asc");
}
function Invoice_Selection()
{
	return mysqli_query($_SESSION['connection'],"SELECT *,vendor.name as vendorname FROM vendor inner join invoice WHERE invoice.vendorid=vendor.id ORDER BY invoice.id DESC");
}
function Invoice_Selection_Byid()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM invoice WHERE invoice.id ='".$_GET['id']."'");
}
function Invoice_Selection1()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM invoice");
}
function Invoice_Selection_ByCount()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as total,vendor.name as vendorname FROM invoice join vendor WHERE invoice.vendorid=vendor.id ORDER BY invoice.id DESC");
}
function Invoice_Insert()
{	
	return mysqli_query($_SESSION['connection'],"INSERT INTO invoice (invoicedate,vendorid,number,) VALUES ('".$_POST['date']."','".$_POST['vendorid']."','".$_POST['number']."')");
}
function Invoice_Update()
{
	return mysqli_query($_SESSION['connection'],"UPDATE invoice SET invoicedate='".$_POST['date']."',vendorid='".$_POST['vendorid']."',amount='".$_POST['amount']."',number='".$_POST['number']."' WHERE id='".$_POST['id']."'");
}
function Invoice_Delete()
{
	return mysqli_query($_SESSION['connection'],"DELETE FROM invoice WHERE id='".$_GET['id']."'");
}
#Add Stock
function Invoice_number()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM invoice");
}
function Rawmaterial_Code($materialcode)
{
	$Fetch_Rawmeterial = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT rawmaterialid FROM rawmaterialassignment where vendorid='".$_POST['vendorid']."'"));
	$rawmaterial1 =  explode(".",$Fetch_Rawmeterial['rawmaterialid']);
	$Options = "";
	foreach($rawmaterial1 as $material)
	{
		$fetchrawmaterial = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From rawmaterial where id='".$material."'"));
		if($fetchrawmaterial['id'] == $materialcode)
			$Options .=  '<option value="'.$fetchrawmaterial['id'].'" selected="selected">'.$fetchrawmaterial['materialcode'].'</option>';
		else
			$Options .= '<option value="'.$fetchrawmaterial['id'].'" >'.$fetchrawmaterial['materialcode'].'</option>';
	}
	return $Options;
}
function Raw_material_Data()
{
	return mysqli_query($_SESSION['connection'],"select * from rawmaterial");
}
/*function Stock_Inventory_Insertion()
{
	return mysqli_query($_SESSION['connection'],"INSERT INTO stockinventory (vendorid,rawmaterialid,quantity,unitprice,amount,taxes) VALUES ('".$_POST['vendorid']."','".$_POST['number']."','".$_POST['quantity']."','".$_POST['unitprice']."','".$_POST['amount']."','".$_POST['taxes']."')");
}*/

#Stock Inventory Invoice
/*
function Stock_Inventory_Insert()
{
	return mysqli_query($_SESSION['connection'],"INSERT INTO stockinventory (invoiceid,batchid,rawmaterialid,quantity,unitprice,amount) VALUES ('".$_POST['number']."','".$_POST['materialcode']."','".$_POST['quantity']."','".$_POST['unitprice']."','".$_POST['amount']."')");
}
function Stock_Inventory_Display()
{
	return mysqli_query($_SESSION['connection'],"");
}
function Select_Invoice()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM invoice WHERE invoice.vendorid='".$_GET['vendorid']."'");
}
function Select_Rawmaterial()
{
	return mysqli_query($_SESSION['connection'],"Select * From rawmaterial join rawmaterialassignment on rawmaterial.id = rawmaterialassignment.rawmaterialid join vendor on vendor.id = rawmaterialassignment.vendorid  where vendor.id ='".$_GET['vendorid']."'");
}*/

#Stock Status
function Stock_Summary()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,rawmaterial.minquantity,stock.unitprice,category.name,sum(stock.amount) as amount,sum(stock.quantity) as quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
							FROM category
							INNER JOIN rawmaterial ON categoryid = category.id
							INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
							INNER JOIN stock ON stock.batchid = batch.id
							WHERE rawmaterialid IS NOT NULL GROUP BY batch.rawmaterialid");
}
function Stock_SummaryByInspection()
{
	return mysqli_query($_SESSION['connection'],"select stockinventory.inspection, rawmaterial.id as id,rawmaterial.materialcode as materialcode,rawmaterial.description as description,rawmaterial.partnumber as partnumber,category.name as name,sum(stockinventory.quantity) as quantity,sum(stockinventory.amount) as amount,rawmaterial.minquantity from rawmaterial 
						left join batch on rawmaterial.id = batch.rawmaterialid
						left join stockinventory on batchid = batch.id
						left join category on categoryid=category.id where (rawmaterial.id is not null || rawmaterial.id is null)
						group by rawmaterial.id");
						
}
function Stock_Search_ByAjax()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,rawmaterial.minquantity,stock.unitprice,category.name,sum(stock.amount) as amount,sum(stock.quantity) as quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
						FROM category
						INNER JOIN rawmaterial ON categoryid = category.id
						INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
						INNER JOIN stock ON stock.batchid = batch.id
						where rawmaterial.materialcode LIKE '%".$_POST['stock1']."%' OR
						stock.quantity LIKE '%".$_POST['stock1']."%' OR 
						stock.amount LIKE '%".$_POST['stock1']."%' OR
						rawmaterial.description LIKE '%".$_POST['stock1']."%' OR
						rawmaterial.partnumber LIKE '%".$_POST['stock1']."%' OR 
						category.name LIKE '%".$_POST['stock1']."%' && rawmaterial.id is not null group by batch.rawmaterialid");
}
#Stock
function Select_RawMaterial_Id()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterialid FROM rawmaterialassignment");
}
/*
function Select_Rawmaterialid_ByVendor()
{
	$raw_material = Select_RawMaterial_Id();
	while($raw = mysqli_fetch_assoc($raw_material))
	{
		$Condition = "";
		$raw_material1 =  explode(".",$raw['rawmaterialid']);
		foreach($raw_material1 as $x)
		{
			$Condition .= " OR rawmaterial.id = ".$x;
		}
		$rawmaterial = mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id, rawmaterial.materialcode FROM rawmaterial
		join rawmaterialassignment on ".substr($Condition, 3, strlen($Condition)-1)."
		join vendor on vendor.id = rawmaterialassignment.vendorid 
		where vendor.id ='".$_GET['vendorid']."'");
		while($material_code = mysqli_fetch_assoc($rawmaterial))
		{
			echo '<option value="'.$material_code['id'].'">'.$material_code['materialcode'].'</option>';
		}
	}
}
*/
function Select_Rawmaterialid_ByVendor()
{
	$FetchRawmeterial = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT rawmaterialid FROM rawmaterialassignment where vendorid='".$_GET['vendorid']."'"));
	$raw_material1 =  explode(".",$FetchRawmeterial['rawmaterialid']);
	foreach($raw_material1 as $x)
	{
		$fetchrawmeterial = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From rawmaterial where id='".$x."'"));
		if(!$fetchrawmeterial['id'])
			echo '<select disabled><option value="select"></option></select>';
		else
			echo '<option value="'.$fetchrawmeterial['id'].'$'.$fetchrawmeterial['partnumber'].'$'.$fetchrawmeterial['description'].'">'.$fetchrawmeterial['materialcode'].'</option>';
	}
}
function Total_Countof_Stock()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as total FROM stock inner join batch on stock.batchid=batch.id inner join rawmaterial on batch.rawmaterialid=rawmaterial.id inner join category on category.id=rawmaterial.categoryid");
}
function Stock_Display_ByLimit($Start,$Limit)
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stock.quantity,stock.unitprice,stock.amount FROM rawmaterial
						inner join batch on batch.rawmaterialid=rawmaterial.id
						inner join stock on stock.batchid=batch.id
						inner join category on category.id=rawmaterial.categoryid LIMIT $Start,$Limit ");
}
#Stock_Management_AjaxInsertion
function Invoice_Stock_Selection()
{
	return mysqli_query($_SESSION['connection'],"SELECT * from invoice where vendorid='".$_POST['vendorid']."' && number='".$_POST['number']."'");
}
function Invoice_Insertion()
{
	if($_POST['excises'])
	{
		$excisetaxs = array($_POST['ecisetax1'],$_POST['ecisetax2'],$_POST['ecisetax3']);
		$excisetax = implode(",",$excisetaxs);
		mysqli_query($_SESSION['connection'],"INSERT INTO invoice (vendorid,number,invoicedate,excise,exciseamount,excisetax,couriers,sfile,type,size,tmp_name) VALUES ('".$_POST['vendorid']."','".$_POST['number']."','".$_POST['date']."','1','','".$excisetax."','".$_POST['couriers']."','".$_POST['sfile']."','".$_SESSION['type']."','".$_SESSION['size']."','".$_SESSION['tmp_name']."')");
	}
	else
		return mysqli_query($_SESSION['connection'],"INSERT INTO invoice (vendorid,number,invoicedate,excise,exciseamount,couriers,sfile,type,size,tmp_name) VALUES ('".$_POST['vendorid']."','".$_POST['number']."','".$_POST['date']."','0','".$excisetax."','".$_POST['couriers']."','".$_POST['sfile']."','".$_SESSION['type']."','".$_SESSION['size']."','".$_SESSION['tmp_name']."')");

}
function Invoice_Selection_ForStock()
{
	return mysqli_query($_SESSION['connection'],"SELECT invoice.id from invoice ORDER BY invoice.id DESC");
}
function Batch_Selection()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM batch where number = '".$_POST['batchnumber']."' && rawmaterialid='".$_POST['materialcode']."'");
}
function Stock_Inventory_Insertion()
{
	return mysqli_query($_SESSION['connection'],"INSERT INTO stockinventory (invoiceid,batchid,quantity,unitprice,amount,taxid,taxamount,locationid) VALUES('".$_POST['invoiceid']."','".$_POST['batchid']."','".$_POST['quantity']."','".$_POST['unitprice']."','".$_POST['amount']."','".$_POST['taxid']."','".$_POST['taxamount']."','".$_POST['locationid']."')");
}
function Batch_id_Selection()
{
	return mysqli_query($_SESSION['connection'],"SELECT batchid from stock");
}
function Stock_Insertion()
{
	return mysqli_query($_SESSION['connection'],"INSERT INTO stock (batchid,quantity,unitprice,amount,taxid,taxamount) SELECT batchid,SUM(quantity),SUM(unitprice),SUM(amount),taxid,SUM(taxamount) FROM stockinventory where stockinventory.batchid not in (SELECT stock.batchid from stock) GROUP BY stockinventory.batchid ");
}
function Batch_Insertion()
{
	return mysqli_query($_SESSION['connection'],"INSERT INTO batch (number,rawmaterialid) VALUES ('".$_POST['batchnumber']."','".$_POST['materialcode']."')");
}
function Batchid_Recent()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM batch ORDER BY batch.id DESC");
}
function Stock_Value_Batching()
{
	return mysqli_query($_SESSION['connection'],"SELECT locationid,sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unitt,sum(stockinventory.amount)as amt, stockinventory.taxid, sum(stockinventory.taxamount) as taxamt from stockinventory where stockinventory.batchid='".$_POST['batchid']."' group by stockinventory.batchid");
}
/*function Stock_Updation()
{
		echo $d['total'];		
		$d['unitt'];		
		$d['amt'];		
		$d['taxid'];		
		$d['taxamt'];
	return mysqli_query($_SESSION['connection'],"update stock set quantity='".$d['total']."',unitprice='".$d['unitt']."',amount='".$d['amt']."',taxid='". $d['taxid']."',
									taxamount='".$d['taxamt']."' where stock.batchid='".$_POST['batchid']."'");
}*/

//Invoice Summary
function StockQtyAmt()
{
	return mysqli_query($_SESSION['connection'],"SELECT locationid as lid,location.name as name,stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where stockinventory.id='".$_GET['id']."' && invoice.number='".$_GET['number']."' && invoice.vendorid='".$_GET['vendor']."'");
}
function StockId()
{
	return mysqli_query($_SESSION['connection'],"select * from stockinventory where id='".$_POST['id']."'");
}
function StockInventoryQtysum()
{
	return mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unit from stockinventory where stockinventory.batchid='".$batchid['batchid']."' group by stockinventory.batchid");
}
function StockQty()
{
	return mysqli_query($_SESSION['connection'],"SELECT quantity as total,unitprice from stock where stock.batchid='".$batchid['batchid']."'");
}
function StockStatusInfo()
{
	return mysqli_query($_SESSION['connection'],"SELECT stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendor']."'");
}
function StockinventoryUpdates()
{
	return mysqli_query($_SESSION['connection'],"UPDATE stockinventory set quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',amount=('".$_POST['quantity']."' * '".$_POST['unitprice']."'),locationid='".$_POST['lid']."' WHERE id='".$_POST['id']."'");
}
/*function StockinventorySelect()
{
	return mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unit,sum(stockinventory.amount) as amount from stockinventory where stockinventory.batchid='".$_POST['batchid']."' group by stockinventory.batchid");
}
function StockUpdateS()
{
	return mysqli_query($_SESSION['connection'],"UPDATE stock set quantity='".$proc['total']."',unitprice='".$proc['unit']."',amount='".$proc['amount']."' where stock.batchid='".$_POST['batchid']."'");
}*/
//Stock Status
function Stock_Status_Onadd()
{
	return mysqli_query($_SESSION['connection'],"SELECT stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."'");
	
	/*echo "SELECT category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` 
						inner join invoice on invoiceid=invoice.id 
						inner join vendor on vendor.id=invoice.vendorid
						inner join batch on batch.id=stockinventory.batchid 
						inner join rawmaterial on rawmaterialid =  ".$Condition."
						inner join category on category.id=rawmaterial.categoryid
						inner join location on location.id=stockinventory.locationid
						where invoice.id='".$_POST['id']."' && invoice.vendorid='".$_POST['vendorid']."'";*/
}
function Stock_Status_Onaddnumber()
{
	return mysqli_query($_SESSION['connection'],"SELECT stockinventory.inspection,taxid as tid,invoice.excise,stockinventory.taxamount,stockinventory.id,category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` inner join invoice on invoiceid=invoice.id inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."'");
	/*return mysqli_query($_SESSION['connection'],"SELECT category.name as catname,quantity,unitprice,description,partnumber,materialcode,amount,location.name FROM `stockinventory` 
						inner join invoice on invoiceid=invoice.id 
						inner join vendor on vendor.id=invoice.vendorid
						inner join batch on batch.id=stockinventory.batchid 
						inner join rawmaterial on rawmaterial.id=".$Condition."
						inner join category on category.id=rawmaterial.categoryid
						inner join location on location.id=stockinventory.locationid
						where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."'");*/
}
function StockInvoiceTotal()
{
	return mysqli_query($_SESSION['connection'],"SELECT invoice.couriers,invoice.exciseamount,taxid as tid,sum(amount) as amount,sum(taxamount) as taxamount FROM `stockinventory` inner join invoice on invoiceid=invoice.id 
						inner join vendor on vendor.id=invoice.vendorid inner join batch on batch.id=stockinventory.batchid 
						inner join rawmaterial on rawmaterial.id = batch.rawmaterialid inner join category on category.id=rawmaterial.categoryid
						inner join location on location.id=stockinventory.locationid where invoice.number='".$_POST['number']."' && invoice.vendorid='".$_POST['vendorid']."' group by invoiceid");
}
function Rawmaterialbatch()
{
	return mysqli_query($_SESSION['connection'],"SELECT batch.rawmaterialid,batch.number,invoice.number as numbers FROM batch inner join stockinventory on  batchid=batch.id
						inner join invoice on invoice.id=invoiceid
						inner join vendor on invoice.vendorid=vendor.id
						inner join rawmaterialassignment on rawmaterialassignment.vendorid=vendor.id
						inner join rawmaterial on batch.rawmaterialid= rawmaterial.id
						where batch.rawmaterialid='".$_GET['materialcode']."' && batch.number='".$_GET['batchnumber']."' && invoice.number='".$_GET['number']."'");
}
/*function Stock_Status_Summary()
{
	return mysqli_query($_SESSION['connection'],"select stockinventory.id as id,invoice.vendorid,vendor.name,invoice.number,sum(unitprice),sum(amount),sum(quantity),invoice.invoicedate from stockinventory join invoice on invoice.id=stockinventory.invoiceid join vendor on vendor.id=invoice.vendorid group by invoiceid");
}*/
function Stock_Status_Summary($Start,$Limit)
{
	return mysqli_query($_SESSION['connection'],"SELECT invoice.couriers,invoice.sfile,tax.percent,invoice.exciseamount,invoice.excise,stockinventory.id as sid,stockinventory.locationid,
						minquantity, invoice.vendorid, vendor.name,invoice.id, invoice.number,sum(inspection) as inspection,sum(taxamount) as taxamount,sum(amount) as amount,
						invoice.invoicedate
						FROM stockinventory
						JOIN invoice ON invoice.id = stockinventory.invoiceid
						JOIN vendor ON vendor.id = invoice.vendorid
						JOIN batch ON batch.id = stockinventory.batchid
						JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
						JOIN location on stockinventory.locationid=location.id
						JOIN tax on tax.id=taxid
						GROUP BY stockinventory.invoiceid ORDER BY invoice.id DESC LIMIT $Start,$Limit");
}
function Invoice_Summary_Download()
{
	return mysqli_query($_SESSION['connection'],"SELECT invoice.sfile,invoice.couriers,tax.percent,invoice.exciseamount,invoice.excise,stockinventory.id as sid,stockinventory.locationid,
						 invoice.vendorid, vendor.name,invoice.id, invoice.number,taxamount,amount,
						invoice.invoicedate
						FROM stockinventory
						JOIN invoice ON invoice.id = stockinventory.invoiceid
						JOIN vendor ON vendor.id = invoice.vendorid
						JOIN location on stockinventory.locationid=location.id
						JOIN tax on tax.id=taxid WHERE stockinventory.invoiceid='".$_GET['id']."'");
}
function Stock_Status_Summary_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from (SELECT count(*) as total FROM stockinventory
						JOIN invoice ON invoice.id = stockinventory.invoiceid
						JOIN vendor ON vendor.id = invoice.vendorid
						JOIN batch ON batch.id = stockinventory.batchid
						JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
						JOIN location on stockinventory.locationid=location.id
						GROUP BY stockinventory.invoiceid)as counttable");
}
function Stock_Inspection()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode, batch.id, stockinventory.inspection, stockinventory.status, stockinventory.inspectionquantity, stockinventory.inspectedby, stockinventory.datetime, stockinventory.id AS id, invoice.vendorid, vendor.name, invoice.number, sum(unitprice) , sum(amount) , sum(quantity) , invoice.invoicedate
						FROM stockinventory
						JOIN invoice ON invoice.id = stockinventory.invoiceid
						JOIN vendor ON vendor.id = invoice.vendorid
						JOIN batch ON batch.id = stockinventory.batchid
						JOIN rawmaterial ON rawmaterial.id = rawmaterialid  where (inspection='' and status='') || (inspection!='1' && inspection!='2' && inspection!='3') 
						GROUP BY invoiceid, batchid ORDER BY invoice.id asc");
}
function Stock_InspectionSummary()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode, batch.id, stockinventory.inspection, stockinventory.status, stockinventory.inspectionquantity, stockinventory.inspectedby, stockinventory.datetime, stockinventory.id AS id, invoice.vendorid, vendor.name, invoice.number, sum(unitprice) , sum(amount) , sum(quantity) , invoice.invoicedate
						FROM stockinventory
						JOIN invoice ON invoice.id = stockinventory.invoiceid
						JOIN vendor ON vendor.id = invoice.vendorid
						JOIN batch ON batch.id = stockinventory.batchid
						JOIN rawmaterial ON rawmaterial.id = rawmaterialid
						GROUP BY invoiceid, batchid ORDER BY invoice.id desc");
}
//Stock Display
function Stock_Editing()
{
	return mysqli_query($_SESSION['connection'],"SELECT location.name as locationname,stockinventory.id,rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stockinventory.quantity,stockinventory.unitprice,stockinventory.amount
						FROM rawmaterial
						inner join batch on batch.rawmaterialid=rawmaterial.id
						inner join stockinventory on stockinventory.batchid=batch.id
						inner join category on category.id=rawmaterial.categoryid
						inner join invoice on stockinventory.invoiceid=invoice.id
						inner join location on stockinventory.locationid=location.id
						where stockinventory.invoiceid in(select id from invoice where invoice.number='".$_POST['number']."'&& invoice.vendorid='".$_POST['vendorid']."')ORDER BY stockinventory.id DESC LIMIT 0,1");
}
//Stock Edit
function Stock_Edit()
{
	return mysqli_query($_SESSION['connection'],"select locationid,percent,taxid,rawmaterialid,rawmaterial.materialcode,batch.id as batchid,batch.number,stockinventory.quantity,stockinventory.unitprice,stockinventory.taxamount,stockinventory.locationid from stockinventory join batch on batchid=batch.id
											join rawmaterial on rawmaterial.id=rawmaterialid 
											join tax on taxid=tax.id where stockinventory.id='".$_POST['id']."'");
}
function Stock_Edit_Batch()
{
	return mysqli_query($_SESSION['connection'],"select batch.id from batch where batch.number='".$_POST['batchnumber']."' && rawmaterialid='".$_POST['materialcode']."'");
}
function Updated_StockInventory()
{
	return mysqli_query($_SESSION['connection'],"Update stockinventory set batchid = '".$batch_id['id']."',quantity='".$_POST['quantity']."',unitprice='".$_POST['unitprice']."',amount='".$_POST['amount']."',
		taxid='".$_POST['taxid']."',taxamount='".$_POST['taxamount']."',locationid='".$_POST['locationid']."' where stockinventory.id='".$_POST['id']."'");
}
function StockInventory_Batching()
{
	return mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount,sum(unitprice) as unitprice,taxid,sum(taxamount) as taxamount,stockinventory.locationid from stockinventory where batchid = '".$batch_id['id']."' group by stockinventory.batchid");
}
function Update_Stock()
{
	return mysqli_query($_SESSION['connection'],"Update stock set batchid = '".$batch_id['id']."',quantity='".$stock_update['quantity']."',unitprice='".$stock_update['unitprice']."',amount='".$stock_update['amount']."',
		taxid='".$stock_update['taxid']."',taxamount='".$stock_update['taxamount']."' where batchid = '".$_SESSION['batchid']."'");
}
function Stock_Edited()
{
	return mysqli_query($_SESSION['connection'],"SELECT stockinventory.id,rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stockinventory.quantity,stockinventory.unitprice,stockinventory.amount,stockinventory.locationid
						FROM rawmaterial
						inner join batch on batch.rawmaterialid=rawmaterial.id
						inner join stockinventory on stockinventory.batchid=batch.id
						inner join category on category.id=rawmaterial.categoryid
						inner join invoice on stockinventory.invoiceid=invoice.id
						where stockinventory.id ='".$_POST['id']."'");
}
//Invoice Stock Insertion Via Ajax
function Invoice_Stockajax()
{
	return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode,category.name,rawmaterial.partnumber,rawmaterial.description,stock.quantity,stock.unitprice,stock.amount FROM rawmaterial
						inner join batch on batch.rawmaterialid=rawmaterial.id
						inner join stock on stock.batchid=batch.id
						inner join category on category.id=rawmaterial.categoryid");
}
//Stock Delete
function Stock_AfterDelete()
{
	return mysqli_query($_SESSION['connection'],"SELECT sum(stockinventory.quantity) as total,sum(stockinventory.unitprice) as unitt,sum(stockinventory.amount)as amt, stockinventory.taxid, sum(stockinventory.taxamount) as taxamt from stockinventory where stockinventory.batchid='".$stock_batchid['batchid']."' group by stockinventory.batchid");
}
function Stock_ForDelete()
{
	return mysqli_query($_SESSION['connection'],"SELECT stockinventory.batchid from stockinventory where stockinventory.id='".$_GET['id']."'");
}
function Stock_InventoryDelete()
{
	return mysqli_query($_SESSION['connection'],"DELETE FROM stockinventory where stockinventory.id='".$_GET['id']."'");
}
?>