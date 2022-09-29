<?php
	//Master : User
	function UserRoles_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user_role WHERE id!='1' ORDER BY id ASC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userrole_id!='1' ORDER BY id DESC");
	}
	function User_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM user WHERE userrole_id!='1' ORDER BY id DESC");
	}
	function User_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE id='".$_GET['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function User_Delete_ById($Id)
	{
		$user = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM user where id='".$Id."'"));
		mysqli_query($_SESSION['connection'],"DELETE FROM issuanceuser WHERE issuanceuser.issuanceuser='".$user['name']."'");
		mysqli_query($_SESSION['connection'],"DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Insert()
	{
		$status = implode('.',$_POST['status']);
		mysqli_query($_SESSION['connection'],"insert into user values('', '".$_POST['name']."', '".$_POST['password']."', '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['phone']."','".$status."', '".$_POST['userrole_id']."')");
		mysqli_query($_SESSION['connection'],"insert into issuanceuser values('', '".$_POST['name']."')");
	}
	function User_Update()
	{	
		$status = implode('.',$_POST['status']);
		$user = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM user where id='".$_POST['id']."'"));
		mysqli_query($_SESSION['connection'],"UPDATE issuanceuser SET issuanceuser='".$_POST['name']."' WHERE issuanceuser.issuanceuser='".$user['name']."'");
		mysqli_query($_SESSION['connection'],"UPDATE user SET name='".$_POST['name']."', password='".$_POST['password']."', firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', phone='".$_POST['phone']."',status = '".$status."', userrole_id='".$_POST['userrole_id']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userrole_id!='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Masters Approver
	function Approver_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into approver values('','".$_POST['module']."','".$_POST['approver']."','".$_POST['user']."')");
	}
	function Approver_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"select count(*) as total from approver");
	}
	function Approver_Select_ByLimit($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"select * from approver order by id desc Limit $Start,$Limit");
	}
	function Approver_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"select * from approver where id='".$_GET['id']."'");
	}
	function Approver_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE approver SET module='".$_POST['module']."',approver='".$_POST['approver']."',user='".$_POST['user']."' where id='".$_POST['id']."'");
	}
	function Approver_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"Delete from approver where id='".$Id."'");
	}
	//Vendor
	function Vendor_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM vendor WHERE id='".$Id."'");
	}
	function Vendor_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor where id='".$_GET['id']."'");
	}
	function Select_Vendor()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor ORDER BY id DESC");
	}
	function Select_VendorCategory()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory");
	}
	function Select_VendorCategoryById($CategoryId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory where id='".$CategoryId."'");
	}
	function Vendor_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Vendor_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM vendor ORDER BY id DESC");
	}
	function Vendor_Insert()
	{
		if($_POST['categoryid'])
			$_POST['categoryid'] = implode($_POST['categoryid'], ".");
		return mysqli_query($_SESSION['connection'],"INSERT INTO vendor values('','".$_POST['vendorid']."','".$_POST['name']."','".$_POST['address']."','".$_POST['phonenumber']."','".$_POST['email']."','".$_POST['contactperson']."','".$_POST['categoryid']."','".$_POST['creditlimit']."','".$_POST['creditperiodid']."','".$_POST['leadtime']."')");
	}
	function Vendor_Update()
	{
		if($_POST['categoryid'])
			$_POST['categoryid'] = implode($_POST['categoryid'], ".");
		return mysqli_query($_SESSION['connection'],"UPDATE vendor SET name='".$_POST['name']."',address='".$_POST['address']."',phonenumber='".$_POST['phonenumber']."',email='".$_POST['email']."',contactperson='".$_POST['contactperson']."',categoryid='".$_POST['categoryid']."',creditlimit='".$_POST['creditlimit']."',creditperiodid='".$_POST['creditperiodid']."',leadtime='".$_POST['leadtime']."'  WHERE id='".$_POST['id']."'");
	}
	function SelectCreditPeriod()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod");
	}
	function FetchCreditPeriodById($Periodid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod where id='".$Periodid."'");
	}
	
	//RM-Category
	function Category_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where name='".$_POST['name']."'");
	}
	function Category_Select_ByPrefix()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where prefix='".$_POST['prefix']."'");
	}
	function Category_Select_ByNameUpdate()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Category_Select_ByPrefixUpdate()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where prefix='".$_POST['prefix']."'  && id!='".$_POST['id']."'");
	}
	function Category_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM category ORDER BY id DESC");
	}
	function Category_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Category_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where id='".$_GET['id']."'");
	}
	function Category_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE category SET name='".$_POST['name']."',prefix='".$_POST['prefix']."'  WHERE id='".$_POST['id']."'");
	}
	function Category_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO category values('','".$_POST['name']."','".$_POST['prefix']."')");
	}	
	function RMCate_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM category WHERE id='".$Id."'");
	}
	
	//Driver Category
	function ProductCategory_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM product_subcategory ORDER BY id DESC");
	}
	function ProductCategory_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory ORDER BY id ASC LIMIT $Start, $Limit");
	}
	function ProductCategory_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory where id='".$_GET['id']."'");
	}
	function ProductCategory_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory where name='".$_POST['name']."'");
	}
	function ProductCategory_Select_ByPrefix()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory where prefix='".$_POST['prefix']."'");
	}
	function ProductCategory_Select_ByNameUpdate()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory where name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function ProductCategory_Select_ByPrefixUpdate()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_subcategory where prefix='".$_POST['prefix']."'  && id!='".$_POST['id']."'");
	}
	function ProductCategory_Delete_ById()
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM product_subcategory WHERE id='".$_GET['id']."'");
	}
	function ProductCategory_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE product_subcategory SET category_id='".$_POST['category_id']."', name='".$_POST['name']."',prefix='".$_POST['prefix']."'  WHERE id='".$_POST['id']."'");
	}
	function ProductCategory_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO product_subcategory values('','".$_POST['category_id']."','".$_POST['name']."','".$_POST['prefix']."')");
	}
	function Products_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category");
	}
	function ProductSubCategory($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  product_category WHERE id='".$Id."'");
	}
	//Vendor Category
	function VendorCategory_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM vendorcategory ORDER BY id DESC");
	}
	function VendorCategory_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory ORDER BY id ASC LIMIT $Start, $Limit");
	}
	function VendorCategory_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory where id='".$_GET['id']."'");
	}
	function VendorCategory_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory where name='".$_POST['name']."'");
	}
	function VendorCategory_Select_ByNameUpdate()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendorcategory where name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function VendorCategory_Delete_ById()
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM vendorcategory WHERE id='".$_GET['id']."'");
	}
	function VendorCategory_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE vendorcategory SET name='".$_POST['name']."'  WHERE id='".$_POST['id']."'");
	}
	function VendorCategory_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO vendorcategory values('','".$_POST['name']."')");
	}
	
	//Master : Raw Material	
	function Select_RawMaterialCode($Code)
	{
		return mysqli_query($_SESSION['connection'],"select * from rawmaterial where materialcode like '".$Code."%' order by id desc");
	}
	function Rawmaterial_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial ORDER BY id DESC");
	}
	function Rawmaterial_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM rawmaterial ORDER BY id DESC");
	}
	function Rawmaterial_Select_Count_AllSearch($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total  FROM rawmaterial where materialcode like '".$Search."%' or materialcode like '% ".$Search."'  or materialcode like '% ".$Search." %' ORDER BY id DESC");
	}
	function Rawmaterial_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE id='".$_GET['id']."'");
	}
	function Rawmaterial_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE materialcode='".$_POST['materialcode']."'");
	}
	function Rawmaterial_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE materialcode='".$_POST['materialcode']."'  && id!='".$_POST['id']."'");
	}
	function Rawmaterial_Delete_ById($Id)
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM rawmaterial WHERE id='".$Id."'");
	}
	function Rawmaterial_Insert($Code)
	{
		return mysqli_query($_SESSION['connection'],"insert into rawmaterial values('', '".$Code."', '".$_POST['categorynumber']."', '".$_POST['categoryid']."', '".$_POST['partnumber']."', '".$_POST['description']."', '".$_POST['tax']."','".$_POST['minquantity']."','".$_POST['bom_category']."')");
	}
	function Rawmaterial_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE rawmaterial SET  categorynumber='".$_POST['categorynumber']."', categoryid='".$_POST['categoryid']."', partnumber='".$_POST['partnumber']."', description='".$_POST['description']."', tax='".$_POST['tax']."',minquantity ='".$_POST['minquantity']."',bom_category='".$_POST['bom_category']."'   WHERE rawmaterial.id='".$_POST['id']."'");
	}
	function Rawmaterial_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.categoryid,categorynumber,rawmaterial.tax,rawmaterial.id,materialcode,categorynumber,bom_category.bom_category,minquantity,partnumber,description FROM rawmaterial join bom_category on bom_category.id=rawmaterial.bom_category ORDER BY rawmaterial.id DESC LIMIT $Start, $Limit");
	}
	function Rawmaterial_Select_ByLimitSearch($Start, $Limit,$Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT rawmaterial.categoryid,categorynumber,rawmaterial.tax,rawmaterial.id,materialcode,categorynumber,bom_category.bom_category,minquantity,partnumber,description FROM rawmaterial join bom_category on bom_category.id=rawmaterial.bom_category where materialcode like '".$Search."%' or materialcode like '% ".$Search."'  or materialcode like '% ".$Search." %' ORDER BY rawmaterial.id DESC LIMIT $Start, $Limit");
	}
	function Select_Tax()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax");
	}
	function Rawmaterial_Section()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category ORDER BY id ASC");
	}
	function Categoryname($categoryid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM category where id= '".$categoryid."'");
	}
	function Tax_SelectById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$Id."'");
	}
	function SelectBomCategory()
	{
		return mysqli_query($_SESSION['connection'],"Select * From bom_category");
	}
	
	// Master : Assigned Raw Material	
	function Vendormaterial_Section()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor ORDER BY id DESC");
	}
	function Materials_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  rawmaterial ORDER BY id ASC");
	}		
	function Rawmaterials_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment WHERE id='".$Id."'");
	}
	
	function Rawmaterials_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM rawmaterialassignment WHERE id='".$Id."'");
	}	
	function Rawmaterials_Insert()
	{		
		return mysqli_query($_SESSION['connection'],"insert into rawmaterialassignment (vendorid,rawmaterialid) values('".$_POST['vendorid']."','".$_POST['rawmaterialid']."')");
	}
	function Rawmaterials_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE rawmaterialassignment SET vendorid='".$_POST['vendorid']."',rawmaterialid='".$_POST['rawmaterialid']."' WHERE id='".$_POST['id']."'");
	}	
	function Rawmaterials_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment ORDER BY id DESC");
	}		
	function Rawmaterials_Select_AllBySearch($Search)
	{
		$Query = "";
		if($Search)
		{
			$SelectVendorName = mysqli_query($_SESSION['connection'],"Select * From vendor where name like  '".$Search."%' or name like '%".$Search."'  or name like '%".$Search."%' ");
			$j = mysqli_num_rows($SelectVendorName);
			while($FetchVendors = mysqli_fetch_array($SelectVendorName))
			{
				$j -= 1;
				$Query .= "vendorid like '".$FetchVendors['id']."' ";
				if($j)
					$Query .= " OR ";
			}
			$SelectMeterial = mysqli_query($_SESSION['connection'],"SELECT * FROM  rawmaterial   where materialcode like '".$Search."%' or materialcode like '%".$Search."'  or materialcode like '%".$Search."%'");
			$i = mysqli_num_rows($SelectMeterial);
			while($FetchMeterial = mysqli_fetch_array($SelectMeterial))
			{
				$i -= 1;
				$Query .= "rawmaterialid like '".$FetchMeterial['id']."%'  or rawmaterialid like '%".$FetchMeterial['id']."'  or rawmaterialid like '%".$FetchMeterial['id']."%'";
				if($i)
					$Query .= " OR ";
			}
			return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment  where ".$Query."	ORDER BY id DESC");
		}
	}	
	function Rawmaterials_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment ORDER BY id DESC LIMIT $Start, $Limit");
	}	
	function Rawmaterials_Select_ByLimitSearch($Start, $Limit,$Search)
	{
		$Query = "";
		if($Search)
		{
			$SelectVendorName = mysqli_query($_SESSION['connection'],"Select * From vendor where name like  '".$Search."%' or name like '%".$Search."'  or name like '%".$Search."%' ");
			$j = mysqli_num_rows($SelectVendorName);
			while($FetchVendors = mysqli_fetch_array($SelectVendorName))
			{
				$j -= 1;
				$Query .= "vendorid like '".$FetchVendors['id']."' ";
				if($j)
					$Query .= " OR ";
			}
			$SelectMeterial = mysqli_query($_SESSION['connection'],"SELECT * FROM  rawmaterial   where materialcode like '".$Search."%' or materialcode like '%".$Search."'  or materialcode like '%".$Search."%'");
			$i = mysqli_num_rows($SelectMeterial);
			while($FetchMeterial = mysqli_fetch_array($SelectMeterial))
			{
				$i -= 1;
				$Query .= "rawmaterialid like '".$FetchMeterial['id']."%'  or rawmaterialid like '%".$FetchMeterial['id']."'  or rawmaterialid like '%".$FetchMeterial['id']."%'";
				if($i)
					$Query .= " OR ";
			}
			return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment  where ".$Query."	ORDER BY id DESC LIMIT $Start, $Limit");
		}
	
	}
	
	function Rawmaterialvendor_BYId($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM vendor WHERE id='".$Id."' ORDER BY id DESC");
	}
	function Rawmaterial_BYId($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  rawmaterial WHERE id='".$Id."' ORDER BY id DESC ");
	}
	function Rawmaterialsassignment_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM  rawmaterial WHERE id='".$Id."' ORDER BY id DESC ");
	}
	function Rawmaterial_Select_Byvendor()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment WHERE vendorid='".$_POST['vendorid']."'");
	}
	function Rawmaterial_Select_Byvendor_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterialassignment WHERE vendorid='".$_POST['vendorid']."' && id!='".$_POST['id']."'");
	}
	//Raw materialsearch
	function SelectMaterial($search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM rawmaterial WHERE materialcode like '".$search."%' or ticketno like '%".$search."'  or ticketno like '%".$search."%'");
	}
	
	//Masters Tax
	/*function User_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userrole_id!='1' ORDER BY id DESC");
	}*/
	function Tax_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM tax");
	}
	function Tax_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id='".$_GET['id']."'");
	}
	function Tax_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE type='".$_POST['type']."' || percent='".$_POST['percent']."'");
	}
	function Tax_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE (type='".$_POST['type']."' || percent='".$_POST['percent']."') && id!='".$_POST['id']."'");
	}
	function Tax_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM tax WHERE id='".$Id."'");
	}
	function Tax_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into tax values('', '".$_POST['type']."', '".$_POST['percent']."', '".$_POST['description']."')");
	}
	function Tax_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE tax SET type='".$_POST['type']."', percent='".$_POST['percent']."',description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
	}
	function Tax_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Credit Period
	function Credit_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM creditperiod");
	}
	function Credit_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod WHERE id='".$_GET['id']."'");
	}
	function Credit_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod WHERE period='".$_POST['period']."'");
	}
	function Credit_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod WHERE period='".$_POST['period']."' && id!='".$_POST['id']."'");
	}
	function Credit_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM creditperiod WHERE id='".$Id."'");
	}
	function Credit_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into creditperiod values('', '".$_POST['period']."')");
	}
	function Credit_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE creditperiod SET period='".$_POST['period']."' WHERE id='".$_POST['id']."'");
	}
	function Credit_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM creditperiod WHERE id ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Masters Oppurtunity Status
	function Oppurtunity_Status_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM oppurtunity_status");
	}
	function Oppurtunity_Status_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE id='".$_GET['id']."'");
	}
	function Oppurtunity_Status_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE status='".$_POST['status']."' OR  sortorder='".$_POST['sortorder']."'");
	}
	function Oppurtunity_Status_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE status='".$_POST['status']."' && id!='".$_POST['id']."'");
	}
	function Oppurtunity_Status_Select_Bysortorder()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE sortorder='".$_POST['sortorder']."' && id!='".$_POST['id']."'");
	}
	function Oppurtunity_Status_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM oppurtunity_status WHERE id='".$Id."'");
	}
	
	function Oppurtunity_Status_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into oppurtunity_status values('', '".$_POST['status']."','".$_POST['enabled']."','".$_POST['sortorder']."')");
	}
	function Oppurtunity_Status_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE oppurtunity_status SET status='".$_POST['status']."', enabled = '".$_POST['enabled']."', sortorder = '".$_POST['sortorder']."' WHERE id='".$_POST['id']."'");
	}
	
	function Oppurtunity_Status_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM oppurtunity_status WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Industry
	function Industry_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM industry_category");
	}
	function Industry_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE id='".$_GET['id']."'");
	}
	function Industry_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE name='".$_POST['name']."'");
	}
	function Industry_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Industry_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM industry_category WHERE id='".$Id."'");
	}
	function Industry_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into industry_category values('', '".$_POST['name']."')");
	}
	function Industry_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE industry_category SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Industry_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM industry_category WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Product Category
	function ProductCategories_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM product_category");
	}
	function ProductCategories_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category WHERE id='".$_GET['id']."'");
	}
	function ProductCategories_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category WHERE  name='".$_POST['name']."'");
	}
	function ProductCategories_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function ProductCategories_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM product_category WHERE id='".$Id."'");
	}
	function ProductCategories_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into product_category values('', '".$_POST['name']."')");
	}
	function ProductCategories_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE product_category SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function ProductCategories_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product_category WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	//Masters Inhouse Category
	function Inhousecategory_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM inhouse_categories");
	}
	function Inhousecategory_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_categories WHERE id='".$_GET['id']."'");
	}
	function Inhousecategory_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_categories WHERE 	productcategory='".$_POST['	productcategory']."'");
	}
	function Inhousecategory_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_categories WHERE 	productcategory='".$_POST['productcategory']."' && id!='".$_POST['id']."'");
	}
	function Inhousecategory_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM inhouse_categories WHERE id='".$Id."'");
	}
	function Inhousecategory_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into inhouse_categories values('', '".$_POST['productcategory']."')");
	}
	function Inhousecategory_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE inhouse_categories SET name='".$_POST['productcategory']."' WHERE id='".$_POST['id']."'");
	}
	function Inhousecategory_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_categories WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters SalesOrder Status
	function Salesorder_Status_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM salesorder_status");
	}
	function Salesorder_Status_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM salesorder_status WHERE id='".$_GET['id']."'");
	}
	function Salesorder_Status_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM salesorder_status WHERE sales_status='".$_POST['sales_status']."' OR sort_order='".$_POST['sort_order']."'");
	}
	function Salesorder_Status_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM salesorder_status WHERE sales_status='".$_POST['sales_status']."' && id!='".$_POST['id']."'");
	}
	function Salesorder_Status_Select_BySortorder()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM salesorder_status WHERE sort_order='".$_POST['sort_order']."' && id!='".$_POST['id']."'");
	}
	function Salesorder_Status_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM salesorder_status WHERE id='".$Id."'");
	}
	function Salesorder_Status_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into salesorder_status values('', '".$_POST['sales_status']."','".$_POST['enabled']."','".$_POST['sort_order']."')");
	}
	function Salesorder_Status_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE salesorder_status SET sales_status='".$_POST['sales_status']."', enabled = '".$_POST['enabled']."', sort_order = '".$_POST['sort_order']."' WHERE id='".$_POST['id']."'");
	}
	function Salesorder_Status_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM salesorder_status WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Reference
	function Reference_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM reference");
	}
	function Reference_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE id='".$_GET['id']."'");
	}
	function Reference_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE reference='".$_POST['reference']."'");
	}
	function Reference_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE reference='".$_POST['reference']."' && id!='".$_POST['id']."'");
	}
	function Reference_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM reference WHERE id='".$Id."'");
	}
	function Reference_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into reference values('', '".$_POST['reference']."','".$_POST['mobile']."', '".$_POST['address']."')");
	}
	function Reference_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE reference SET reference='".$_POST['reference']."',mobile='".$_POST['mobile']."',address='".$_POST['address']."' WHERE id='".$_POST['id']."'");
	}
	function Reference_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Couriers
	function Couriers_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM couriers");
	}
	function Couriers_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM couriers WHERE id='".$_GET['id']."'");
	}
	function Couriers_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM couriers WHERE couriers='".$_POST['couriers']."'");
	}
	function Couriers_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM couriers WHERE couriers='".$_POST['couriers']."' && id!='".$_POST['id']."'");
	}
	function Couriers_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM couriers WHERE id='".$Id."'");
	}
	function Couriers_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into couriers values('', '".$_POST['couriers']."')");
	}
	function Couriers_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE couriers SET couriers='".$_POST['couriers']."' WHERE id='".$_POST['id']."'");
	}
	function Couriers_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM couriers WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Client_Category
	function Client_Category_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM clientcategory");
	}
	function Client_Category_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM clientcategory WHERE id='".$_GET['id']."'");
	}
	function Client_Category_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM clientcategory WHERE clientcategory='".$_POST['clientcategory']."'");
	}
	function Client_Category_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM clientcategory WHERE clientcategory='".$_POST['clientcategory']."' && id!='".$_POST['id']."'");
	}
	function Client_Category_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM clientcategory WHERE id='".$Id."'");
	}
	function Client_Category_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into clientcategory values('', '".$_POST['clientcategory']."')");
	}
	function Client_Category_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE clientcategory SET clientcategory='".$_POST['clientcategory']."' WHERE id='".$_POST['id']."'");
	}
	function Client_Category_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM clientcategory WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters Location
	function Location_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM location");
	}
	function Location_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE id='".$_GET['id']."'");
	}
	function Location_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE name='".$_POST['name']."'");
	}
	function Location_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Location_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM location WHERE id='".$Id."'");
	}
	function Location_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into location values('', '".$_POST['name']."')");
	}
	function Location_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE location SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Location_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//Masters ReferenceGroup
	function ReferenceGroup_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM reference_group");
	}
	function ReferenceGroup_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE id='".$_GET['id']."'");
	}
	function ReferenceGroup_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE name='".$_POST['name']."'");
	}
	function ReferenceGroup_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function ReferenceGroup_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM reference_group WHERE id='".$Id."'");
	}
	function ReferenceGroup_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into reference_group values('', '".$_POST['name']."')");
	}
	function ReferenceGroup_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE reference_group SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function ReferenceGroup_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM reference_group WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	
	//News
	function News_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM news");
	}
	function News_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM news WHERE id='".$_GET['id']."'");
	}
	function News_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM news WHERE reference='".$_POST['reference']."'");
	}
	function News_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM news WHERE reference='".$_POST['reference']."' && id!='".$_POST['id']."'");
	}
	function News_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM news WHERE id='".$Id."'");
	}
	function News_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into news values('', '".implode($_POST['news'],'`')."','".$_POST['enable']."')");
	}
	function News_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE news SET news='".implode($_POST['news'],'`')."',enable='".$_POST['enable']."' WHERE id='".$_POST['id']."'");
	}
	function News_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM news WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	//Latest News
	function LatestNews_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM latestnews");
	}
	function LatestNews_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM latestnews WHERE id='".$_GET['id']."'");
	}
	function LatestNews_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM latestnews WHERE reference='".$_POST['reference']."'");
	}
	function LatestNews_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM latestnews WHERE reference='".$_POST['reference']."' && id!='".$_POST['id']."'");
	}
	function LatestNews_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM latestnews WHERE id='".$Id."'");
	}
	function LatestNews_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into latestnews values('', '".$_POST['news']."','".$_POST['enable']."')");
	}
	function LatestNews_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE latestnews SET news='".$_POST['news']."',enable='".$_POST['enable']."' WHERE id='".$_POST['id']."'");
	}
	function LatestNews_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM latestnews WHERE id ORDER BY id ASC LIMIT $Start, $Limit");
	}
	function Addissuanceuser()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO issuanceuser (issuanceuser) VALUES ('".$_POST['issuanceuser']."')");
	}
	function Selectissuanceuserid()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM issuanceuser WHERE id='".$_GET['id']."'");
	}
	function Updateissuanceuser()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE issuanceuser SET issuanceuser='".$_POST['issuanceuser']."' WHERE id='".$_POST['id']."'");
	}
	function Selectissuanceuser()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM issuanceuser ORDER BY id ASC");
	}
	function Deleteissuanceuser()
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM issuanceuser WHERE id='".$_GET['id']."'");
	}
	function Addexcise()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO excisetax (excisetax,percent,description) VALUES ('".$_POST['excisetax']."','".$_POST['percent']."','".$_POST['description']."')");
	}
	function Selectexciseid()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM excisetax WHERE id='".$_GET['id']."'");
	}
	function Updateexcise()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE excisetax SET excisetax='".$_POST['excisetax']."',percent='".$_POST['percent']."',description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
	}
	function Selectexcise()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM excisetax ORDER BY id ASC");
	}
	function Deleteexcise()
	{
		mysqli_query($_SESSION['connection'],"DELETE FROM excisetax WHERE id='".$_GET['id']."'");
	}
?>