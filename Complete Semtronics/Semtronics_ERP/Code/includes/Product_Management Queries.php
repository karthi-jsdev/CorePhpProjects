<?php
	//category sub category
	function Product_Subcategory()
	{
		return mysql_query("SELECT name,id,prefix from product_subcategory where category_id='".$_GET['product_category_id']."'");
	}
	function Product()
	{
		return mysql_query("SELECT prefix,id from product_subcategory where id='".$_GET['product_subcategoryid']."'");
	}
	function Product1()
	{
		return mysql_query("SELECT code,id from product where subcategory_id='".$_GET['product_subcategory_id']."'");
	}
	function ProductVersions()
	{
		return mysql_query("SELECT * from `productbom_versioning` where productcode='".$_GET['productcode']."' order by versions desc");
	}
	//PRoduct
	function SelectProductcategorycode()
	{
		return mysql_query("Select * From product_category");
	}
	function Select_ProductCode($Code)
	{
		return mysql_query("Select * From product where code like '".$Code."%' ORDER BY id desc");
	}
	function Product_Insert($Code)
	{
		return mysql_query("INSERT into product values('','".$_POST['productcode']."','".$_POST['description']."','".$_POST['watt']."','".$_POST['wattmax']."','".$_POST['inputvoltage']."','".$_POST['inputvoltagemax']."','".$_POST['outputvoltage']."','".$_POST['outputvoltagemax']."',
		'".$_POST['outputcurrent']."','".$_POST['efficiency']."','".$_POST['l']."','".$_POST['b']."','".$_POST['h']."','".$_POST['packquantity']."','".$_POST['remarks']."')");
	}
	function Product_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM product ORDER BY id DESC");
	}
	function Product_Update()
	{
		return mysql_query("UPDATE product Set productcode='".$_POST['productcode']."',description='".$_POST['description']."',watt='".$_POST['watt']."',wattmax='".$_POST['wattmax']."',inputvoltage='".$_POST['inputvoltage']."',inputvoltagemax='".$_POST['inputvoltagemax']."',outputvoltage='".$_POST['outputvoltage']."',outputvoltagemax='".$_POST['outputvoltagemax']."',
		outputcurrent='".$_POST['outputcurrent']."',efficiency='".$_POST['efficiency']."',l='".$_POST['l']."',b='".$_POST['b']."',h='".$_POST['h']."',packquantity='".$_POST['packquantity']."',remarks='".$_POST['remarks']."' WHERE id='".$_POST['id']."'");
	}
	function Product_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT product.id,products.productcode,description,watt,wattmax,inputvoltage,inputvoltagemax,outputvoltage,outputvoltagemax,outputcurrent,efficiency,l,b,h,packquantity,remarks FROM product JOIN products on products.id=product.productcode ORDER BY product.id DESC Limit $Start,$Limit");
	}
	function Product_Delete_ById()
	{
		return mysql_query("Delete FROM product where id='".$_GET['id']."'");
	}
	function Product_Select_ById()
	{
		return mysql_query("SELECT product.id,products.id as productcode,description,watt,wattmax,inputvoltage,inputvoltagemax,outputvoltage,outputvoltagemax,outputcurrent,efficiency,l,b,h,packquantity,remarks FROM product JOIN products on products.id=product.productcode where product.id='".$_GET['id']."'");
	}
	//Product-BOM
	function Select_ProductCodeByAsc($Code)
	{
		return mysql_query("Select * From product where code like '".$Code."%'");
	}
	function SelectRawMeterialcode()
	{
		return mysql_query("Select * From rawmaterial");
	}
	function SelectBomCategory()
	{
		return mysql_query("Select * From bom_category");
	}
	function ProductBOM_Delete_ById()
	{
		return mysql_query("Delete FROM productbom where id='".$_GET['id']."'");
	}
	function ProductBOM_Insert()
	{
		if(isset($_FILES['files']))
		{
			$product_subcategory = explode("/",$_POST['product_subcategory_id']);
			mysql_query("INSERT INTO productbom values('','".$_POST['productcode']."','".$product_subcategory[0]."','".$_POST['productid']."','".$_POST['rawmaterialid']."','".$_POST['quantity']."','".$_POST['reference']."','".$filesize."','".$content."')");
			mysql_query("INSERT INTO productbom_versioning values('','".$_POST['productcode']."','".$product_subcategory[0]."','".$_POST['productid']."','".$_POST['quantity']."','".$_POST['reference']."','','1','".$filesize."','".$content."')");
					
		}
		else
		{
			$product_subcategory = explode("/",$_POST['product_subcategory_id']);
			mysql_query("INSERT INTO productbom values('','".$_POST['productcode']."','".$product_subcategory[0]."','".$_POST['productid']."','".$_POST['rawmaterialid']."','".$_POST['quantity']."','".$_POST['reference']."')");
			mysql_query("INSERT INTO productbom_versioning values('','".$_POST['productcode']."','".$product_subcategory[0]."','".$_POST['productid']."','".$_POST['quantity']."','".$_POST['reference']."','','1')");
		}
	}
	function ProductBOM_Update()
	{
		return mysql_query("UPDATE productbom SET productid='".$_POST['productid']."',rawmaterialid='".$_POST['rawmaterialid']."',quantity='".$_POST['quantity']."',reference='".$_POST['reference']."'  WHERE id='".$_POST['id']."'");
	}
	function ProductBOM_Select_ById()
	{
		return mysql_query("Select * FROM productbom where id='".$_GET['id']."'");
	}
	function ProductBOM_Select_Count_All()
	{
		return mysql_query("Select COUNT(*) as total FROM productbom");
	}
	function ProductBOM_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("Select productbom.tolerance,productbom.package,productbom.make,products.productcode,productbom.id,rawmaterial.id as rawmaterialid,rawmaterial.materialcode,rawmaterial.partnumber,rawmaterial.description,productbom.quantity,productbom.reference FROM productbom join products on products.id=productbom.productcode join rawmaterial on rawmaterialid=rawmaterial.id ORDER BY id DESC Limit $Start,$Limit");
	}
	
	function SelectProductCode($Id)
	{
		return mysql_query("Select * From product where id='".$Id."' ORDER BY id desc");
	}
	function SelectRawMeterial($Id)
	{
		return mysql_query("Select * From rawmaterial where id='".$Id."'");
	}
	function SelectProductcategory($Id)
	{
		return mysql_query("Select * From  product_category where id='".$Id."'");
	}
	function SelectProductsubcategory($Id)
	{
		return mysql_query("Select * From  product_subcategory where id='".$Id."'");
	}
	function select_rawmaterialbombased()
	{
		return mysql_query("Select * From rawmaterial join bom_category on bom_category.id=rawmaterial.bom_category where bom_category.id='".$_GET['bom_category']."'");
	}
	/* function select_rawmaterialbasedbom()
	{
		return mysql_query("Select * From  rawmaterial 
		join productbom on productbom.rawmaterialid=rawmaterial.id 
		join bom_category on bom_category.id=rawmaterial.bom_category
		where 
		rawmaterial.bom_category='".$_GET['bom_categoryinversion']."'");
	} */
	//BOM Status
	//Group by rawmaterial.id   distinct(rawmaterial.id)
	function ProductBOMStatus_Select_Count_All()
	{
		return mysql_query("SELECT count(distinct(rawmaterial.id)) as total FROM productbom
			LEFT JOIN products ON productbom.productcode = products.id
			LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
			LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
			LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
			LEFT JOIN stock ON stock.batchid = batch.id
			WHERE productbom.productcode='".$_POST['productcode']."' || productbom.productcode='".$_GET['productcode']."'");

	}
	function ProductBOMStatus_Select_Count_All_kitting($Id)
	{
		return mysql_query("SELECT  count(distinct(rawmaterial.id)) as total FROM productbom
		LEFT JOIN products ON productbom.productcode = products.id
		LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
		LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
		LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
		LEFT JOIN stock ON stock.batchid = batch.id
		WHERE  productbom.productcode='".$Id."'");
	}
	//Group by rawmaterial.id
	function ProductBOMStatus_Select_Number_Count_All($ProductId)
	{
		return mysql_query("SELECT count(distinct(rawmaterial.id)) as total FROM productbom
		LEFT JOIN products ON productbom.productcode = products.id
		LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
		LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
		LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
		LEFT JOIN stock ON stock.batchid = batch.id
		WHERE productbom.productcode=$ProductId Group by rawmaterial.id ");
	}
	function ProductBOMStatus_Select_ByLimit($ProductId)
	{
		return mysql_query("SELECT productbom.productcode,rawmaterial.id as rawmaterialid,rawmaterial.materialcode as materialcode,productbom.quantity as quantity,productbom.reference as reference,rawmaterial.partnumber as partnumber,avg(stockinventory.unitprice) as unitprice,productbom.quantity as productbomquantity, stock.quantity as stockquantity FROM productbom
		LEFT JOIN products ON productbom.productcode = products.id
		LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
		LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
		LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
		LEFT JOIN stock ON stock.batchid = batch.id
		WHERE productbom.productcode=$ProductId Group by rawmaterial.id ORDER BY productbom.id DESC");
	}
	// Group by rawmaterial.id
	function ProductBOMStatus($Start,$Limit)
	{
			return mysql_query("SELECT rawmaterial.bom_category,products.id as productid,products.productcode,productbom.id as id,rawmaterial.id as rawmaterialid,rawmaterial.materialcode as materialcode, productbom.quantity as quantity,productbom.reference as reference,rawmaterial.partnumber as partnumber,avg(stockinventory.unitprice) as unitprice,productbom.quantity as productbomquantity,productbom.tolerance,productbom.package,productbom.make, stock.quantity stockquantity FROM productbom 
							LEFT JOIN products ON productbom.productcode = products.id 
							LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid 
							LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
							LEFT JOIN stockinventory ON stockinventory.batchid = batch.id 
							LEFT JOIN stock ON stock.batchid = batch.id 
							WHERE productbom.productcode='".$_POST['productcode']."' || productbom.productcode='".$_GET['productcode']."' Group by rawmaterial.id ORDER BY productbom.id DESC   Limit $Start,$Limit");

	}
	function ProductBOMStatus_Totalvalue()
	{
		return mysql_query("SELECT productbom.quantity as quantity,stockinventory.unitprice as unitprice FROM productbom 
							LEFT JOIN products ON productbom.productcode = products.id 
							LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid 
							LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
							LEFT JOIN stockinventory ON stockinventory.batchid = batch.id 
							LEFT JOIN stock ON stock.batchid = batch.id 
							WHERE productbom.productcode='".$_POST['productcode']."' || productbom.productcode='".$_GET['productcode']."' Group by rawmaterial.id");
	}
	//BOM VERSIONING Group by rawmaterial.id
	function ProductBOMVersioning_Select_Count_All()
	{
		return mysql_query("SELECT count(distinct(rawmaterial.id)) as total FROM productbom_versioning 
				LEFT JOIN productbom ON productbom_versioning.productcode = productbom.productcode
				LEFT JOIN products ON productbom.productcode = products.productcode
				LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
				LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
				LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
				LEFT JOIN stock ON stock.batchid = batch.id
				WHERE productbom_versioning.productcode='".$_POST["productcode"]."' AND productbom_versioning.versions ='".$_POST["versions"]."' Group by rawmaterial.id");
	
	}

	function ProductBOMVersioningStatus($Start,$Limit)
	{
		return mysql_query("SELECT productbom_versioning.id as versionid,products.productcode as productcode,products.id as productid,productbom.id as id, productbom.productcode as productcodes,rawmaterial.id as rawmaterialid,rawmaterial.materialcode as materialcode,productbom.quantity as quantity, productbom.reference as reference,rawmaterial.partnumber as partnumber,stockinventory.unitprice as unitprice,productbom.quantity as productbomquantity,productbom.tolerance,productbom.package,productbom.make, stock.quantity stockquantity,productbom_versioning.versions, productbom_versioning.comments,productbom_versioning.reference as bomversionreference, productbom_versioning.quantity as bomversionquantity
							FROM productbom_versioning LEFT JOIN productbom ON productbom_versioning.productcode = productbom.productcode
							LEFT JOIN products ON productbom.productcode = products.id
							LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
							LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
							LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
							LEFT JOIN stock ON stock.batchid = batch.id
							WHERE productbom_versioning.productcode='".$_POST["productcode"]."' AND productbom_versioning.versions ='".$_POST["versions"]."' Group by rawmaterial.id");		
	}
	
	//Vendors
	function Vendor_Select_ByRawmaterial()
	{
		return mysql_query("SELECT rawmaterialassignment.rawmaterialid, vendor.id, vendor.vendorid, vendor.name, vendor.creditlimit, vendor.creditperiodid,vendor.leadtime FROM rawmaterialassignment JOIN vendor ON vendor.id=rawmaterialassignment.vendorid  GROUP BY vendorid");
	}
	function Vendor_Select_Names($id)
	{
		return mysql_query("SELECT * from vendor where id='".$id."'");
	}
?>