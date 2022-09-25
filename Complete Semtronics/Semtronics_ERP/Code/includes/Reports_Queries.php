<?php
	//vendor_Reports
	function vendor_category_name()
	{
		return mysql_query("SELECT * FROM  vendorcategory order by id DESC");
	}
	function Vendors_Count()
	{
		return mysql_query("SELECT COUNT(*) as total from vendor");
	}
	//function Vendor_Select_ByLimit($Start, $Limit)
	function Vendor_Select_ByLimit()
	{
		return mysql_query("SELECT * FROM vendor ORDER BY id DESC");
	}
	function Select_VendorCategoryById($CategoryId)
	{
		return mysql_query("SELECT * FROM vendorcategory where id='".$CategoryId."'");
	}
	function FetchCreditPeriodById($Periodid)
	{
		return mysql_query("SELECT * FROM creditperiod where id='".$Periodid."'");
	}
	function VendorsCategory_Count()
	{
		if($_GET['vendor_category_id'])
			return mysql_query("SELECT COUNT(*) as total from vendor WHERE id='".$_GET['vendor_category_id']."'");
		else
			return mysql_query("SELECT COUNT(*) as total from vendor");
	}
	//function Vendor_Category_Select_ByLimit($Start, $Limit)
	function Vendor_Category_Select_ByLimit()
	{
		if($_GET['vendor_category_id'])
			return mysql_query("SELECT * FROM vendor WHERE id='".$_GET['vendor_category_id']."' ORDER BY id DESC");
		else
			return mysql_query("SELECT * FROM vendor  ORDER BY id DESC");
	}
	//Invoice_Reports
	function select_invoice_number()
	{
		return mysql_query("SELECT distinct(vendor.name),vendor.id FROM invoice join vendor on invoice.vendorid=vendor.id order by vendor.id desc");
	}
	function select_vendor_name($Id)
	{
		return mysql_query("SELECT * FROM vendor WHERE id='".$Id."'");
	}
	function Stock_Status_Summary_Count()
	{
		return mysql_query("SELECT count(*) as total from (SELECT count(*) as total FROM stockinventory
							JOIN invoice ON invoice.id = stockinventory.invoiceid
							JOIN vendor ON vendor.id = invoice.vendorid
							JOIN batch ON batch.id = stockinventory.batchid
							JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
							JOIN location on stockinventory.locationid=location.id
							GROUP BY stockinventory.invoiceid)as counttable");
	}
	//function Stock_Status_Summary($Start,$Limit)
	function Stock_Status_Summary()
	{
		return mysql_query("SELECT stockinventory.locationid,minquantity, invoice.vendorid, vendor.name,invoice.id, invoice.number,sum(taxamount),sum(amount),invoice.invoicedate
							FROM stockinventory
							JOIN invoice ON invoice.id = stockinventory.invoiceid
							JOIN vendor ON vendor.id = invoice.vendorid
							JOIN batch ON batch.id = stockinventory.batchid
							JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
							JOIN location on stockinventory.locationid=location.id
							GROUP BY stockinventory.invoiceid ORDER BY invoice.id DESC");
	}
	function Stock_Status_Summary_Count_display()
	{
		echo "SELECT count(*) as total from (SELECT count(*) as total FROM stockinventory
							JOIN invoice ON invoice.id = stockinventory.invoiceid
							JOIN vendor ON vendor.id = invoice.vendorid
							JOIN batch ON batch.id = stockinventory.batchid
							JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
							JOIN location on stockinventory.locationid=location.id
							GROUP BY stockinventory.invoiceid WHERE invoice.invoicedate >='".$_GET['startdate']."' && invoice.invoicedate <='".$_GET['enddate']."')as counttable";
		$Query = "WHERE ";
			if(isset($_GET['vendor_id']))
				$Query .= "vendor.id='".$_GET['vendor_id']."' AND ";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))	
				$Query .= "invoice.invoicedate between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";	
			return mysql_query("SELECT count(*) as total from (SELECT count(*) as total FROM stockinventory
			JOIN invoice ON invoice.id = stockinventory.invoiceid
			JOIN vendor ON vendor.id = invoice.vendorid
			JOIN batch ON batch.id = stockinventory.batchid
			JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
			JOIN location on stockinventory.locationid=location.id ".str_replace("=''","!=''",$Query)."
			GROUP BY stockinventory.invoiceid) as counttable");
					
	}
	//function Stock_Status_Summary_display($Start,$Limit)
	function Stock_Status_Summary_display()
	{	
		$Query = "WHERE ";
			if(isset($_GET['vendor_id']))
				$Query .= "vendor.id='".$_GET['vendor_id']."' AND ";
			if(isset($_GET['startdate']) && isset($_GET['enddate']))	
				$Query .= "invoice.invoicedate between '".date("Y-m-d",strtotime($_GET['startdate']))."' AND '".date("Y-m-d",strtotime($_GET['enddate']))."'";	
		return mysql_query("SELECT stockinventory.locationid,minquantity, invoice.vendorid, vendor.name,invoice.id, invoice.number,sum(taxamount),sum(amount),invoice.invoicedate
							FROM stockinventory
							JOIN invoice ON invoice.id = stockinventory.invoiceid
							JOIN vendor ON vendor.id = invoice.vendorid
							JOIN batch ON batch.id = stockinventory.batchid
							JOIN rawmaterial ON rawmaterial.id = batch.rawmaterialid
							JOIN location on stockinventory.locationid=location.id ".str_replace("=''","!=''",$Query)."
							GROUP BY stockinventory.invoiceid ORDER BY invoice.id DESC");
	}
	
	//Stock Status Reports
	function rawmaterial_category_name()
	{
		return mysql_query("SELECT * FROM category order by id desc");
	}
	//Inspectiion Reports
	function Stock_Inspection()
	{
		return mysql_query("SELECT rawmaterial.materialcode, batch.id, stockinventory.inspection, stockinventory.status, stockinventory.inspectionquantity, stockinventory.inspectedby, stockinventory.datetime, stockinventory.id AS id, invoice.vendorid, vendor.name, invoice.number, sum(unitprice) , sum(amount) , sum(quantity) , invoice.invoicedate
							FROM stockinventory
							JOIN invoice ON invoice.id = stockinventory.invoiceid
							JOIN vendor ON vendor.id = invoice.vendorid
							JOIN batch ON batch.id = stockinventory.batchid
							JOIN rawmaterial ON rawmaterial.id = rawmaterialid  where (inspection='' and status='') || (inspection!='1' && inspection!='2' && inspection!='3') 
							GROUP BY invoiceid, batchid ORDER BY stockinventory.inspection asc");
	}
	//Issuance Reports
	function Select_All_Users()
	{
		return mysql_query("SELECT * FROM user ORDER BY id");
	}
	//Product Reports
	function product_category_name()
	{
		return mysql_query("SELECT * FROM product_category order by id desc");
	}
	function product_subcategory_name($Id)
	{
		return mysql_query("SELECT * FROM product_subcategory WHERE category_id = '".$Id."' ORDER BY id desc");
	}
	function Product_Select_Count_All()
	{
		if($_POST['productcode'])
			return mysql_query("SELECT COUNT(*) as total FROM product JOIN products on products.id=product.productcode WHERE product.productcode='".$_POST['productcode']."'ORDER BY product.id DESC");
		else
			return mysql_query("SELECT COUNT(*) as total FROM product JOIN products on products.id=product.productcode ORDER BY product.id DESC");
	}
	function Product_Select_Count_SubcategoryAll()
	{
		if($_POST['productcode'])
			return mysql_query("SELECT COUNT(*) as total FROM product product JOIN products on products.id=product.productcode ORDER BY product.id");		
	}
	function Product_Select_Count_Productcode()
	{
		if($_GET['productcode'])
			return mysql_query("SELECT COUNT(*) as total FROM product product JOIN products on products.id=product.productcode  WHERE product.productcode='".$_GET['productcode']."' ORDER BY product.id");		
	}
	function Product_Select_ByNoLimit()
	{
		return mysql_query("SELECT * FROM product JOIN products on products.id=product.productcode ORDER BY product.id DESC");
	}
	function Product_Select_Subcategory_ByNoLimit()
	{
		if($_POST['productcode'])
			return mysql_query("SELECT * FROM product JOIN products on products.id=product.productcode WHERE product.productcode = '".$_POST['productcode']."'  ORDER BY product.id DESC");
	}
	function Product_Select_Subcategory_ByNoLimit_particulardata()
	{
		if($_GET['productcode'])
			return mysql_query("SELECT * FROM product JOIN products on products.id=product.productcode WHERE product.productcode = '".$_GET['productcode']."'  ORDER BY product.id DESC");
	}
	
	//Product BOM Queries
	function ProductBOM_Select_Count_All()
	{
		return mysql_query("Select COUNT(*) as total FROM productbom order by id desc");
	}
	function ProductBOM_Select_ByNOLimit()
	{
		return mysql_query("SELECT rawmaterial.materialcode,products.productcode,productbom.quantity,reference,tolerance,package,make,rawmaterial.partnumber FROM productbom JOIN products on products.id=productbom.productcode JOIN rawmaterial on rawmaterial.id=rawmaterialid ORDER BY productbom.id DESC");
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
	function ProductBOM_displaySelect_Count_All()
	{
		if($_GET['stock'] && (!$_GET['productcode'] || !$_GET['product_subcategory_id'] || !$_GET['productid']))
		{
			return mysql_query("SELECT  count(distinct(rawmaterial.id)) as total FROM productbom
			LEFT JOIN product ON productbom.productid = product.id
			LEFT JOIN product_subcategory ON product_subcategory.id = product.subcategory_id
			LEFT JOIN product_category ON product_category.id = product_subcategory.category_id
			LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
			LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
			LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
			LEFT JOIN stock ON stock.batchid = batch.id");
		}
		else if($_GET['stock'] && ($_GET['productcode'] || $_GET['product_subcategory_id'] || $_GET['productid']))
		{
			$product_subcategory = explode("/",$_GET['product_subcategory_id']);
			$Query = "WHERE ";
			if(isset($_GET['productcode']))
				$Query .= "productbom.productcategory_id='".$_GET['productcode']."' AND ";
			if(isset($_GET['product_subcategory_id']))
				$Query .= "productbom.productsubcategory_id='".$product_subcategory[0]."' AND ";
			if(isset($_GET['productid']))
				$Query .= "productbom.productid='".$_GET['productid']."'";
			return mysql_query("SELECT  count(distinct(rawmaterial.id)) as total FROM productbom
			LEFT JOIN product ON productbom.productid = product.id
			LEFT JOIN product_subcategory ON product_subcategory.id = product.subcategory_id
			LEFT JOIN product_category ON product_category.id = product_subcategory.category_id
			LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
			LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
			LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
			LEFT JOIN stock ON stock.batchid = batch.id
			".str_replace("=''","!=''",$Query)."");
		}
		else
		{
			$product_subcategory = explode("/",$_GET['product_subcategory_id']);
			$Query = "WHERE ";
			if(isset($_GET['productcode']))
				$Query .= "productcategory_id='".$_GET['productcode']."' AND ";
			if(isset($_GET['product_subcategory_id']))
				$Query .= "productsubcategory_id='".$product_subcategory[0]."' AND ";
			if(isset($_GET['productid']))
				$Query .= "productid='".$_GET['productid']."'";
			return  mysql_query("SELECT COUNT(*) as total FROM productbom ".str_replace("=''","!=''",$Query)."");	
		}
	}
	function ProductBOM_displaySelect_ByNOLimit()
	{
		if($_GET['stock'] && (!$_GET['productcode'] || !$_GET['product_subcategory_id'] || !$_GET['productid']))
		{
			return mysql_query("SELECT product.id as productid,product_category.id as categoryid,product_subcategory.id as subcategoryid,productbom.id as id,productbom.productid as productid,product.code as productcode,rawmaterial.id as rawmaterialid,rawmaterial.materialcode as materialcode,productbom.quantity as quantity,productbom.reference as reference,rawmaterial.partnumber as partnumber,avg(stockinventory.unitprice) as unitprice,productbom.quantity as productbomquantity, stock.quantity stockquantity ,product_category.name,product_category.id as productcategoryid,product_subcategory.name as subcategoryname,product_subcategory.id as productsubcategoryid FROM productbom
			LEFT JOIN product ON productbom.productid = product.id
			LEFT JOIN product_subcategory ON product_subcategory.id = product.subcategory_id
			LEFT JOIN product_category ON product_category.id = product_subcategory.category_id
			LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
			LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
			LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
			LEFT JOIN stock ON stock.batchid = batch.id  Group by rawmaterial.id ORDER BY productbom.id DESC");
		}
		else if($_GET['stock'] && ($_GET['productcode'] || $_GET['product_subcategory_id'] || $_GET['productid']))
		{	
			$product_subcategory = explode("/",$_GET['product_subcategory_id']);
			$Query = "WHERE ";
			if(isset($_GET['productcode']))
				$Query .= "productcategory_id='".$_GET['productcode']."' AND ";
			if(isset($_GET['product_subcategory_id']))
				$Query .= "productsubcategory_id='".$product_subcategory[0]."' AND ";
			if(isset($_GET['productid']))
				$Query .= "productid='".$_GET['productid']."'";
			return mysql_query("SELECT product.id as productid,product_category.id as categoryid,product_subcategory.id as subcategoryid,productbom.id as id,productbom.productid as productid,product.code as productcode,rawmaterial.id as rawmaterialid,rawmaterial.materialcode as materialcode,productbom.quantity as quantity,productbom.reference as reference,rawmaterial.partnumber as partnumber,avg(stockinventory.unitprice) as unitprice,productbom.quantity as productbomquantity, stock.quantity stockquantity ,product_category.name,product_category.id as productcategoryid,product_subcategory.name as subcategoryname,product_subcategory.id as productsubcategoryid FROM productbom
			LEFT JOIN product ON productbom.productid = product.id
			LEFT JOIN product_subcategory ON product_subcategory.id = product.subcategory_id
			LEFT JOIN product_category ON product_category.id = product_subcategory.category_id
			LEFT JOIN rawmaterial ON rawmaterial.id = productbom.rawmaterialid
			LEFT JOIN batch ON batch.rawmaterialid = rawmaterial.id 
			LEFT JOIN stockinventory ON stockinventory.batchid = batch.id
			LEFT JOIN stock ON stock.batchid = batch.id ".str_replace("=''","!=''",$Query)." Group by rawmaterial.id ORDER BY productbom.id DESC");
		}
		else
		{
			$product_subcategory = explode("/",$_GET['product_subcategory_id']);
			$Query = "WHERE ";
			if(isset($_GET['productcode']))
				$Query .= "productcategory_id='".$_GET['productcode']."' AND ";
			if(isset($_GET['product_subcategory_id']))
				$Query .= "productsubcategory_id='".$product_subcategory[0]."' AND ";
			if(isset($_GET['productid']))
				$Query .= "productid='".$_GET['productid']."'";
			return  mysql_query("SELECT * FROM productbom ".str_replace("=''","!=''",$Query)."order by id desc");	
		}	
	}
	
	//Saved Kitting Reports
	function Product_Subcategory()
	{
		return mysql_query("SELECT name,id,prefix from product_subcategory where category_id='".$_GET['product_category_id']."'");
	}
	function Product1()
	{
		return mysql_query("SELECT code,id from product where subcategory_id='".$_GET['product_subcategory_id']."'");
	}
	
	//Lead Reports
	
	function SelectClientcategorycode()
	{
		return mysql_query("SELECT * from clientcategory");
	}
	function Selectreferredbycode()
	{
		return mysql_query("SELECT * from reference");
	}
	function Selectreferencegroup()
	{
		return mysql_query("SELECT * from reference_group");
	}
	function Selectindustrycode()
	{
		return mysql_query("SELECT * from industry_category");
	}
	function Lead_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM leads ORDER BY id DESC");
	}
	function Lead_Select_ByNOLimit()
	{
		return mysql_query("SELECT * FROM leads ORDER BY id DESC");
	}
	function Client_Category_Name($Id)
	{
		return mysql_query("SELECT * FROM clientcategory WHERE id='".$Id."'");
	}
	function Reference_Name($Id)
	{
		return mysql_query("SELECT * FROM reference WHERE id='".$Id."'");
	}
	function Reference_GroupName($Id)
	{
		return mysql_query("SELECT * FROM reference_group WHERE id='".$Id."'");
	}
	function Industrycategory_Name($Id)
	{
		return mysql_query("SELECT * FROM industry_category WHERE id='".$Id."'");
	}
	function Lead_Select_displayCount_All()
	{
		if($_GET['account'])
		{
			$Query = "WHERE ";
			if(isset($_GET['vendor_category_id']))
				$Query .= "leads.client_category_id='".$_GET['vendor_category_id']."' AND ";
			if(isset($_GET['reference_id']))
				$Query .= "leads.reference_id='".$_GET['reference_id']."' AND ";
			if(isset($_GET['reference_group_id']))
				$Query .= "leads.reference_group_id='".$_GET['reference_group_id']."' AND ";
			if(isset($_GET['industry_category_id']))
				$Query .= "leads.industry_category_id='".$_GET['industry_category_id']."'";
			return mysql_query("SELECT COUNT(*) as total FROM leads ".str_replace("=''","!=''",$Query)." AND leads.add_to_account='1' ");
		}
		else
		{
			$Query = "WHERE ";
			if(isset($_GET['vendor_category_id']))
				$Query .= "leads.client_category_id='".$_GET['vendor_category_id']."' AND ";
			if(isset($_GET['reference_id']))
				$Query .= "leads.reference_id='".$_GET['reference_id']."' AND ";
			if(isset($_GET['reference_group_id']))
				$Query .= "leads.reference_group_id='".$_GET['reference_group_id']."' AND ";
			if(isset($_GET['industry_category_id']))
				$Query .= "leads.industry_category_id='".$_GET['industry_category_id']."'";
			return mysql_query("SELECT COUNT(*) as total FROM leads ".str_replace("=''","!=''",$Query)." ");
		}	
	}
	function Lead_Select_BydisplayNoLimit()
	{
		if($_GET['account'])
		{
			$Query = "WHERE ";
			if(isset($_GET['vendor_category_id']))
				$Query .= "leads.client_category_id='".$_GET['vendor_category_id']."' AND ";
			if(isset($_GET['reference_id']))
				$Query .= "leads.reference_id='".$_GET['reference_id']."' AND ";
			if(isset($_GET['reference_group_id']))
				$Query .= "leads.reference_group_id='".$_GET['reference_group_id']."' AND ";
			if(isset($_GET['industry_category_id']))
				$Query .= "leads.industry_category_id='".$_GET['industry_category_id']."'";
			return mysql_query("SELECT * FROM leads JOIN clientcategory ON leads.client_category_id = clientcategory.id JOIN reference ON reference.id = leads.reference_id JOIN reference_group ON reference_group.id = leads.reference_group_id JOIN industry_category ON industry_category.id = leads.industry_category_id ".str_replace("=''","!=''",$Query)." AND leads.add_to_account='1' ORDER by leads.id desc");
		}
		else
		{
			$Query = "WHERE ";
			if(isset($_GET['vendor_category_id']))
				$Query .= "leads.client_category_id='".$_GET['vendor_category_id']."' AND ";
			if(isset($_GET['reference_id']))
				$Query .= "leads.reference_id='".$_GET['reference_id']."' AND ";
			if(isset($_GET['reference_group_id']))
				$Query .= "leads.reference_group_id='".$_GET['reference_group_id']."' AND ";
			if(isset($_GET['industry_category_id']))
				$Query .= "leads.industry_category_id='".$_GET['industry_category_id']."'";
			return mysql_query("SELECT * FROM leads JOIN clientcategory ON leads.client_category_id = clientcategory.id JOIN reference ON reference.id = leads.reference_id JOIN reference_group ON reference_group.id = leads.reference_group_id JOIN industry_category ON industry_category.id = leads.industry_category_id ".str_replace("=''","!=''",$Query)."  ORDER by leads.id desc");
		}
	}
	
	//Oppurtunity Reports
	function Opportunity_Status()
	{
		return mysql_query("SELECT * FROM oppurtunity_status WHERE enabled!='0'");
	}
	
	// Sample Management Reports
	function Sample_Selection_ByCountdisplay()
	{
		return mysql_query("SELECT count(*) as total from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id WHERE samples.date BETWEEN '".date('Y-m-d',strtotime($_GET["startdate"]))."' AND '".date('Y-m-d',strtotime($_GET["enddate"]))."'  ORDER BY samples.id DESC");
	}
	function Sample_Selection()
	{
		return mysql_query("SELECT samples.id,`oppurtunity_id`, leads.name,product.description,samples.date,samples.company,samples.contact_person,samples.designation,samples.email_id,samples.contact_no,samples.assigned_to,samples.sample_prize,samples.no_of_samples,samples.follow_up,samples.`specification` 
							from samples join leads on lead_id = leads.id join oppurtunities on oppurtunities.id = samples.oppurtunity_id  join product on product.id=samples.product_id WHERE samples.date BETWEEN '".date('Y-m-d',strtotime($_GET["startdate"]))."' AND '".date('Y-m-d',strtotime($_GET["enddate"]))."' ORDER BY samples.id DESC ");
	}
	
	//Sale Order Queries
	function SelectStatus()
	{
		return mysql_query("Select * from salesorder_status order by sales_status asc");
	}
	function Select_Comments()
	{
			return mysql_query("select count(*) as total from saleorder_comments where status_id='".$_GET['status']."' order by id desc");
	}
	function Select_CommentsNolimitdiplay()
	{
			return mysql_query("select * from saleorder_comments where status_id='".$_GET['status']."' order by id desc");
	}
	function FetchStatus($StatusId)
	{
		return mysql_query("select * from salesorder_status where id='".$StatusId."'");
	}	
	function FetchUser($UserId)
	{
		return mysql_query("select * from user where id='".$UserId."'");
	}
?>