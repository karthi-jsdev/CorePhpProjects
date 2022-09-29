<?php
	function Select_Vendors()
	{
		return mysqli_query($_SESSION['connection'],"SELECT vendor.*, creditperiod.period FROM vendor
		JOIN creditperiod on creditperiod.id=vendor.creditperiodid
		WHERE ".str_replace("=''", "!=''", "vendor.id='".$_GET['vendor_category_id']."'")."
		ORDER BY vendor.id DESC");
	}
	function Select_VendorCategory_ById($CategoryId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory where id='".$CategoryId."'");
	}
	
	function Select_Invoices()
	{
		return mysqli_query($_SESSION['connection'],"SELECT stockinventory.locationid,minquantity, invoice.vendorid, vendor.name,invoice.id, invoice.number,sum(taxamount),sum(amount),invoice.invoicedate
		FROM stockinventory
		JOIN invoice ON invoice.id = stockinventory.invoiceid
		JOIN vendor ON vendor.id = invoice.vendorid
		JOIN batch ON batch.id = stockinventory.batchid
		JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
		JOIN location on stockinventory.locationid=location.id
		WHERE invoice.invoicedate>='".$_GET['startdate']."' && invoice.invoicedate<='".$_GET['enddate']."' && ".str_replace("=''", "!=''", "vendor.id='".$_GET['vendor_id']."'")."
		GROUP BY stockinventory.invoiceid ORDER BY invoice.id DESC");
	}
	
	function Select_Stock_Status_By_Limit()
	{
		return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,rawmaterial.minquantity, stock.unitprice,category.name, sum(stock.amount) AS amount, sum(stock.quantity) AS quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
		FROM category
		INNER JOIN rawmaterial ON categoryid = category.id
		INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
		INNER JOIN stock ON stock.batchid = batch.id
		WHERE (rawmaterialid IS NOT NULL || rawmaterialid IS NULL) AND ".str_replace("=''", "!=''", "rawmaterial.categoryid='".$_GET['rawmaterial_category_id']."'")."
		GROUP BY batch.rawmaterialid LIMIT 1");
	}
	
	function Select_Stock_Status()
	{
		return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,rawmaterial.minquantity, stock.unitprice,category.name, sum(stock.amount) AS amount, sum(stock.quantity) AS quantity, rawmaterial.materialcode, rawmaterial.description, rawmaterial.partnumber
		FROM category
		INNER JOIN rawmaterial ON categoryid = category.id
		INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
		INNER JOIN stock ON stock.batchid = batch.id
		WHERE (rawmaterialid IS NOT NULL || rawmaterialid IS NULL) AND ".str_replace("=''", "!=''", "rawmaterial.categoryid='".$_GET['rawmaterial_category_id']."'")."
		GROUP BY batch.rawmaterialid");
	}
	
	function Select_Stock_Status_Inspection1($Stock_quantity)
	{
		//$Stock_quantity = mysqli_fetch_assoc(Select_Stock_Status());
		return mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='0') group by rawmaterialid"));	
	}
	
	function Select_Stock_Status_Inspection($Stock_quantity)
	{
		return mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
	}

	function Select_Stock_Location()
	{
		$Stock_quantity = mysqli_fetch_assoc(Select_Stock_Status());
		return mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT location.name as locationname FROM category
		INNER JOIN rawmaterial ON categoryid = category.id
		INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
		INNER JOIN stockinventory ON stockinventory.batchid = batch.id
		INNER JOIN location ON location.id = stockinventory.locationid
		INNER JOIN stock ON stock.batchid = batch.id
		WHERE rawmaterial.id='".$Stock_quantity['id']."'")); 	
	}
	
	function Select_Inspections()
	{
		return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode, batch.id, stockinventory.inspection, stockinventory.status, stockinventory.inspectionquantity, stockinventory.inspectedby, stockinventory.datetime, stockinventory.id AS id, invoice.vendorid, vendor.name, invoice.number, sum(unitprice) , sum(amount) , sum(quantity) , invoice.invoicedate
		FROM stockinventory
		JOIN invoice ON invoice.id = stockinventory.invoiceid
		JOIN vendor ON vendor.id = invoice.vendorid
		JOIN batch ON batch.id = stockinventory.batchid
		JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
		WHERE ((stockinventory.inspection='' && stockinventory.status='') || (stockinventory.inspection!='1' && stockinventory.inspection!='2' && stockinventory.inspection!='3'))
		GROUP BY stockinventory.invoiceid, stockinventory.batchid ORDER BY stockinventory.inspection asc");
	}
	
	function Select_Issuances()
	{
		return mysqli_query($_SESSION['connection'],"SELECT *, COUNT(newtable.number) as total FROM
		(SELECT issuance.issuancedate,issuance.number,issuance.id,stockissuance.issuedto,issuance.issueddate, issuanceuser.issuanceuser
		FROM stockissuance
		JOIN batch ON batch.id = stockissuance.batchid
		JOIN issuance ON issuance.id = stockissuance.issuanceid
		JOIN issuanceuser ON issuanceuser.id = stockissuance.issuedto
		ORDER BY stockissuance.id DESC)
		as newtable WHERE ".str_replace("=''","!=''", "newtable.number='".$_GET['number']."' && newtable.issuedto='".$_GET['issuedto']."'").str_replace(">=''","!=''", "&& newtable.issueddate>='".$_GET['startdate']."'").str_replace("<=''","!=''", " && newtable.issueddate<='".$_GET['enddate']."'")." GROUP BY newtable.number ORDER BY newtable.id DESC");
	}
	
	function Select_Product()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product 
		JOIN products on products.id=product.productcode 
		WHERE ".str_replace("=''", "!=''", "product.productcode='".$_GET['productcode']."'")."
		ORDER BY product.id DESC");
	}
?>