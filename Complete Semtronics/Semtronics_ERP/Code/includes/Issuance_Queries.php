<?php
	if($_GET['enddate'])
		$_GET['enddate'] = $_GET['enddate']." 23:59:59";
	function Insert_Issuance()
	{
		if($Stock = mysql_fetch_assoc(mysql_query("SELECT * FROM stock WHERE batchid=".$_POST['batchid'])))
		{
			if(!$_SESSION['Issuance_Id'])
			{
				if(!$Issuance = mysql_fetch_array(mysql_query("SELECT id, number FROM issuance WHERE number=".$_POST['number']."")))
				{
					mysql_query("INSERT INTO issuance VALUES('', '".$_POST['number']."', '".date("Y-m-d H:i:s")."', '".$_POST['issuancedate']."')");
					$Issuance = mysql_fetch_array(mysql_query("SELECT id FROM issuance ORDER BY id DESC LIMIT 0,1"));
				}
				$_SESSION['Issuance_Id'] = $Issuance['id'];
			}
			mysql_query("UPDATE stock SET quantity='".($Stock['quantity'] - $_POST['quantity'])."', amount='".($Stock['amount'] - ($Stock['unitprice'] * $_POST['quantity']))."', taxamount='".($Stock['taxamount']-(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity']))."' WHERE batchid='".$_POST['batchid']."'");
			mysql_query("INSERT INTO stockissuance VALUES('', '".$_SESSION['Issuance_Id']."', '".$_POST['batchid']."', '".$_POST['quantity']."', '".$Stock['unitprice']."', '".($Stock['unitprice']*$_POST['quantity'])."', '".$Stock['taxid']."', '".(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity'])."', '".$_POST['issuedto']."')");
		}
	}
	function Select_Issuance_ByNumber()
	{
		return mysql_query("SELECT number FROM issuance WHERE number LIKE '".date("Ym")."%' ORDER BY id DESC LIMIT 1");
	}
	function Update_Issuance()
	{
		$StockIssuance = mysql_fetch_assoc(mysql_query("SELECT * FROM stockissuance WHERE id='".$_POST['id']."'"));
		mysql_query("UPDATE stock SET quantity=quantity+".$StockIssuance['quantity'].", amount=amount+".$StockIssuance['amount'].", taxamount=taxamount+".$StockIssuance['taxamount']." WHERE batchid=".$_POST['batchid']."");
		$Stock = mysql_fetch_assoc(mysql_query("SELECT * FROM stock WHERE batchid=".$_POST['batchid']));
		mysql_query("UPDATE stock SET quantity=quantity-".$_POST['quantity'].", amount=amount-(unitprice*".$_POST['quantity']."), taxamount=taxamount-((taxamount/quantity)*".$_POST['quantity'].") WHERE batchid='".$_POST['batchid']."'");
		mysql_query("UPDATE stockissuance SET batchid='".$_POST['batchid']."', quantity='".$_POST['quantity']."', unitprice='".$Stock['unitprice']."', amount='".($Stock['unitprice']*$_POST['quantity'])."', taxid='".$Stock['taxid']."', taxamount='".(($Stock['taxamount']/$Stock['quantity'])*$_POST['quantity'])."' WHERE id='".$_POST['id']."'");
	}
	function Select_StockIssuance()
	{
		return mysql_query("SELECT stockissuance.id, batch.id as batchid, rawmaterial.materialcode, rawmaterial.partnumber, batch.number, rawmaterial.id as rawmaterialid, rawmaterial.materialcode, stockissuance.quantity, stock.quantity as stockquantity
		FROM stockissuance
		JOIN stock ON stock.batchid = stockissuance.batchid
		JOIN batch ON batch.id = stockissuance.batchid
		JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
		WHERE stockissuance.issuanceid='".$_SESSION['Issuance_Id']."' && stockissuance.id".str_replace(">''", "<>''", ">'".$_SESSION['Last_Id']."'")." ORDER BY stockissuance.id ASC");
	}
	function Select_StockIssuance_ById()
	{
		return mysql_query("SELECT batch.id as batchid, rawmaterial.materialcode, rawmaterial.partnumber, batch.number, rawmaterial.id as rawmaterialid, rawmaterial.materialcode, stockissuance.quantity, stock.quantity as stockquantity FROM stockissuance
		JOIN stock ON stock.batchid = stockissuance.batchid
		JOIN stockinventory ON stockinventory.batchid = stockissuance.batchid
		JOIN batch ON batch.id = stockissuance.batchid
		JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
		WHERE stockissuance.id = '".$_POST['id']."'");
	}
	function Select_StockIssuance_ByBatch()
	{
		return mysql_query("SELECT * FROM stockissuance WHERE batchid='".$_POST['batchid']."' ORDER BY id DESC LIMIT 0,1");
	}
	function Delete_Issuance()
	{
		$StockIssuance = mysql_fetch_array(mysql_query("SELECT * FROM stockissuance WHERE id='".$_POST['id']."'"));
		mysql_query("UPDATE stock SET quantity=quantity+".$StockIssuance['quantity'].", amount=amount+".$StockIssuance['amount'].", taxamount=taxamount+".$StockIssuance['taxamount']." WHERE batchid='".$StockIssuance['batchid']."'");
		mysql_query("DELETE FROM stockissuance WHERE id='".$_POST['id']."'");
	}
	function Select_All_RawMaterial()
	{
		return mysql_query("SELECT * FROM rawmaterial ORDER BY id");
	}
	function Select_All_Users()
	{
		return mysql_query("SELECT * FROM issuanceuser ORDER BY id");
	}
	function Select_Issuance_ById()
	{
		return mysql_query("SELECT * FROM stockissuance WHERE id=".$_GET['id']);
	}
	function Count_Issuance_ByGroup()
	{
		return mysql_query("SELECT COUNT(*) as total FROM(SELECT * FROM(SELECT issuance.number,issuance.id,stockissuance.issuedto, issuance.issueddate FROM stockissuance JOIN batch ON batch.id = stockissuance.batchid JOIN issuance ON issuance.id = stockissuance.issuanceid ORDER BY stockissuance.id DESC) as newtable WHERE ".str_replace("=''","!=''", "newtable.number='".$_GET['number']."' && newtable.issuedto='".$_GET['issuedto']."'").str_replace(">=''","!=''", " && newtable.issueddate>='".$_GET['startdate']."'").str_replace("<=''","!=''", " && newtable.issueddate<='".$_GET['enddate']."'")." GROUP BY newtable.number) as tablecount");
	}
	function Select_Issuance_ByGroup($Start,$Limit)
	{
		return mysql_query("SELECT *, COUNT(newtable.number) as total FROM(SELECT issuance.issuancedate,issuance.number,issuance.id,stockissuance.issuedto,issuance.issueddate, issuanceuser.issuanceuser FROM stockissuance JOIN batch ON batch.id = stockissuance.batchid JOIN issuance ON issuance.id = stockissuance.issuanceid JOIN issuanceuser ON issuanceuser.id = stockissuance.issuedto ORDER BY stockissuance.id DESC) as newtable WHERE ".str_replace("=''","!=''", "newtable.number='".$_GET['number']."' && newtable.issuedto='".$_GET['issuedto']."'").str_replace(">=''","!=''", " && newtable.issueddate>='".$_GET['startdate']."'").str_replace("<=''","!=''", " && newtable.issueddate<='".$_GET['enddate']."'")." GROUP BY newtable.number ORDER BY newtable.id DESC LIMIT $Start,$Limit");
	}
	function Select_Issuance_ByGroupNoLimit()
	{
		return mysql_query("SELECT *, COUNT(newtable.number) as total FROM(SELECT issuance.issuancedate,issuance.number,issuance.id,stockissuance.issuedto,issuance.issueddate, issuanceuser.issuanceuser FROM stockissuance JOIN batch ON batch.id = stockissuance.batchid JOIN issuance ON issuance.id = stockissuance.issuanceid JOIN issuanceuser ON issuanceuser.id = stockissuance.issuedto ORDER BY stockissuance.id DESC) as newtable WHERE ".str_replace("=''","!=''", "newtable.number='".$_GET['number']."' && newtable.issuedto='".$_GET['issuedto']."'").str_replace(">=''","!=''", " && newtable.issueddate>='".$_GET['startdate']."'").str_replace("<=''","!=''", " && newtable.issueddate<='".$_GET['enddate']."'")." GROUP BY newtable.number ORDER BY newtable.id DESC");
	}
	function Select_Issuance_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT location.name,issuance.number, rawmaterial.id, rawmaterial.materialcode, rawmaterial.partnumber, rawmaterial.description, stockissuance.quantity, issuanceuser.issuanceuser as issuanceuser, issuance.issueddate FROM stockissuance JOIN batch ON batch.id=stockissuance.batchid JOIN rawmaterial ON rawmaterial.id=batch.rawmaterialid JOIN issuanceuser ON issuanceuser.id=stockissuance.issuedto JOIN issuance ON issuance.id=stockissuance.issuanceid JOIN stockinventory on batch.id=stockinventory.batchid join location on location.id=locationid WHERE issuance.number='".$_GET['number']."' ORDER BY stockissuance.id DESC LIMIT $Start,$Limit");
	}
	function Select_Issuance_ByNoLimit()
	{
		return mysql_query("SELECT distinct(location.name),issuance.number, rawmaterial.id, rawmaterial.materialcode, rawmaterial.partnumber, rawmaterial.description, stockissuance.quantity, issuanceuser.issuanceuser as issuanceuser, issuance.issueddate FROM stockissuance JOIN batch ON batch.id=stockissuance.batchid JOIN rawmaterial ON rawmaterial.id=batch.rawmaterialid JOIN issuanceuser ON issuanceuser.id=stockissuance.issuedto JOIN issuance ON issuance.id=stockissuance.issuanceid JOIN stockinventory on batch.id=stockinventory.batchid join location on location.id=locationid WHERE issuance.number='".$_GET['number']."' ORDER BY stockissuance.id DESC ");
	}
	function Select_RawMaterial_ById($rawmaterialid)
	{
		return mysql_query("SELECT * FROM rawmaterial WHERE id=".$rawmaterialid);
	}
	function Select_All_Batches()
	{
		return mysql_query("SELECT batch.id, batch.number, stock.quantity FROM batch
		LEFT JOIN stock ON stock.batchid=batch.id
		WHERE batch.rawmaterialid=".$_POST['rawmaterialid']." && stock.quantity>0 ORDER BY batch.id");
	}
	function Select_All_BatchesByInspection()
	{
		return mysql_query("SELECT batch.id, batch.number, sum(stockinventory.quantity) as quantity,location.name FROM batch
							JOIN stock ON stock.batchid=batch.id
							JOIN stockinventory ON stockinventory.batchid=batch.id
							JOIN location ON stockinventory.locationid=location.id
							WHERE stock.quantity>0 && batch.rawmaterialid=".$_POST['rawmaterialid']." && stockinventory.quantity>0 && stockinventory.inspection='1' group by batch.id ORDER BY batch.id");
	}
	function Issuance_Update()
	{
		return mysql_query("UPDATE stockissuance SET rawmaterialid='".$_POST['rawmaterialid']."', quantity='".$_POST['quantity']."', issuedto='".$_POST['issuedto']."', issueddate='".$_POST['issueddate']."'");
	}
	function Count_All_Issuance_ById()
	{
		return mysql_query("SELECT COUNT(stockissuance.id) as total FROM stockissuance JOIN issuance ON issuance.id=stockissuance.issuanceid WHERE issuance.number='".$_GET['number']."'");
	}
	function Delete_Issuance_ById()
	{
		return mysql_query("DELETE stockissuance WHERE id=".$_GET['id']);
	}
?>