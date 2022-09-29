<?php
	//Master : User
	function UserRoles_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user_role WHERE id!='1' ORDER BY id DESC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE id='".$_GET['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function User_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into user values(NULL,'".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['phone']."','".$_POST['name']."', '".$_POST['password']."',  '".$_POST['userrole_id']."')");
	}
	function User_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE user SET user_name='".$_POST['name']."', password='".$_POST['password']."', first_name='".$_POST['firstname']."', last_name='".$_POST['lastname']."',phone_number='".$_POST['phone']."', user_role_id='".$_POST['userrole_id']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	
	//Master : Client	
	function Client_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into client values(NULL,'".$_POST['vendor_code']."','".$_POST['client_name']."','".$_POST['phone']."','".$_POST['address']."','".date("Y-m-d H:i:s")."')");
	}
	function Client_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client WHERE id='".$_GET['id']."'");
	}
	function Client_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM client WHERE id='".$Id."'");
	}
	function Client_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client WHERE client_name='".$_POST['client_name']."' OR vendor_code='".$_POST['vendor_code']."'");
	}
	function Client_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client WHERE client_name='".$_POST['client_name']."' AND vendor_code='".$_POST['vendor_code']."' && id!='".$_POST['id']."'");
	}
	function Client_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE client SET vendor_code='".$_POST['vendor_code']."',client_name= '".$_POST['client_name']."',phone='".$_POST['phone']."',address='".$_POST['address']."' WHERE id='".$_POST['id']."'");
	}
	function Client_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM client ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Client_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM client ORDER BY id DESC");
	}
	
	//Masters :Tax
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
		return mysqli_query($_SESSION['connection'],"insert into tax values(NULL, '".$_POST['type']."', '".$_POST['percent']."', '".$_POST['description']."')");
	}
	function Tax_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE tax SET type='".$_POST['type']."', percent='".$_POST['percent']."',description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
	}
	function Tax_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM tax WHERE id ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Masters :Unit
	function Unit_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM unit");
	}
	function Unit_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit WHERE id='".$_GET['id']."'");
	}
	function Unit_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit WHERE name='".$_POST['name']."' || value='".$_POST['value']."'");
	}
	function Unit_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit WHERE (name='".$_POST['name']."' || value='".$_POST['value']."') && id!='".$_POST['id']."'");
	}
	function Unit_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM unit WHERE id='".$Id."'");
	}
	function Unit_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into unit values(NULL, '".$_POST['name']."', '".$_POST['value']."')");
	}
	function Unit_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE unit SET name='".$_POST['name']."', value='".$_POST['value']."' WHERE id='".$_POST['id']."'");
	}
	function Unit_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM unit WHERE id ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master:Company Information
	
	function Company_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM company_information  ORDER BY id DESC");
	}
	function Company_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM company_information ORDER BY id DESC");
	}
	function Company_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM company_information WHERE id='".$_GET['id']."'");
	}
	function Company_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM company_information WHERE company_name='".$_POST['company_name']."' && company_slogan='".$_POST['company_slogan']."'");
	}
	function Company_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM company_information WHERE company_name='".$_POST['company_name']."' && company_slogan='".$_POST['company_slogan']."' && id!='".$_POST['id']."'");
	}
	function Company_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM company_information WHERE id='".$Id."'");
	}
	function Company_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into company_information values(NULL,'".$_POST['company_name']."','".$_POST['company_slogan']."','".$_POST['address']."','".$_POST['contact_name']."','".$_POST['designation']."','".$_POST['phone']."', '".$_POST['email']."',  '".$_POST['service_taxno']."','".$_POST['pan_no']."','".$_POST['tin_no']."')");
	}
	function Company_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE company_information SET company_name='".$_POST['company_name']."', company_slogan='".$_POST['company_slogan']."', address='".$_POST['address']."',contact_name='".$_POST['contact_name']."',designation='".$_POST['designation']."',phone='".$_POST['phone']."', email='".$_POST['email']."', service_taxno='".$_POST['service_taxno']."', pan_no='".$_POST['pan_no']."',tin_no='".$_POST['tin_no']."' WHERE id='".$_POST['id']."'");
	}
	function Company_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM company_information  ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Masters :Work Description
	function Work_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM work");
	}
	function Work_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM work WHERE id='".$_GET['id']."'");
	}
	function Work_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM work WHERE code='".$_POST['code']."' || description='".$_POST['description']."'");
	}
	function Work_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM work WHERE (code='".$_POST['code']."' || description='".$_POST['description']."') && id!='".$_POST['id']."'");
	}
	function Work_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM work WHERE id='".$Id."'");
	}
	function Work_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into work values(NULL, '".$_POST['code']."', '".$_POST['description']."')");
	}
	function Work_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE work SET code='".$_POST['code']."', description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
	}
	function Work_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM work WHERE id ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Masters :Sub Work Description
	function Sub_Work_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM sub_work");
	}
	function Sub_Work_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM sub_work WHERE id='".$_GET['id']."'");
	}
	function Sub_Work_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM sub_work WHERE code='".$_POST['code']."' || description='".$_POST['description']."'");
	}
	function Sub_Work_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM sub_work WHERE (code='".$_POST['code']."' || description='".$_POST['description']."') && id!='".$_POST['id']."'");
	}
	function Sub_Work_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM sub_work WHERE id='".$Id."'");
	}
	function Sub_Work_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into sub_work values(NULL, '".$_POST['code']."', '".$_POST['description']."')");
	}
	function Sub_Work_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE sub_work SET code='".$_POST['code']."', description='".$_POST['description']."' WHERE id='".$_POST['id']."'");
	}
	function Sub_Work_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM sub_work WHERE id ORDER BY id DESC LIMIT $Start, $Limit");
	}
?>