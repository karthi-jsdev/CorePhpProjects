<?php
	//Master : User
	function UserRoles_Select_All()
	{
		return mysql_query("SELECT * FROM user_role WHERE id!='1' ORDER BY id DESC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysql_query("SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Select_All()
	{
		return mysql_query("SELECT * FROM user WHERE userrole_id!='1' ORDER BY id DESC");
	}
	function User_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM user WHERE userrole_id!='1' ORDER BY id DESC");
	}
	function User_Select_ById()
	{
		return mysql_query("SELECT * FROM user WHERE id='".$_GET['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM user WHERE name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function User_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Insert()
	{
		return mysql_query("insert into user values('', '".$_POST['name']."', '".$_POST['password']."', '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['phone']."', '".$_POST['userrole_id']."')");
	}
	function User_Update()
	{
		return mysql_query("UPDATE user SET name='".$_POST['name']."', password='".$_POST['password']."', firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', phone='".$_POST['phone']."', userrole_id='".$_POST['userrole_id']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM user WHERE userrole_id!='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Class
	function Class_Insert()
	{
		return mysql_query("insert into class values('', '".$_POST['classname']."')");
	}
	function Class_Update()
	{
		return mysql_query("UPDATE class SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Class_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM class WHERE name='".$_POST['classname']."'");
	}
	function Class_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM class WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Class_Select_ById()
	{
		return mysql_query("SELECT * FROM class WHERE id='".$_GET['id']."'");
	}
	function Class_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM class WHERE id='".$Id."'");
	}
	function Class_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM class ORDER BY id DESC");
	}
	function Class_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM class ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Blood Group
	function Blood_Insert()
	{
		return mysql_query("insert into blood_group values('', '".$_POST['classname']."')");
	}
	function Blood_Update()
	{
		return mysql_query("UPDATE blood_group SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Blood_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM blood_group WHERE name='".$_POST['classname']."'");
	}
	function Blood_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM blood_group WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Blood_Select_ById()
	{
		return mysql_query("SELECT * FROM blood_group WHERE id='".$_GET['id']."'");
	}
	function Blood_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM blood_group WHERE id='".$Id."'");
	}
	function Blood_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM blood_group ORDER BY id DESC");
	}
	function Blood_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM blood_group ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Nationality
	function Nationality_Insert()
	{
		return mysql_query("insert into nationality values('', '".$_POST['classname']."')");
	}
	function Nationality_Update()
	{
		return mysql_query("UPDATE nationality SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Nationality_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM nationality WHERE name='".$_POST['classname']."'");
	}
	function Nationality_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM nationality WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Nationality_Select_ById()
	{
		return mysql_query("SELECT * FROM nationality WHERE id='".$_GET['id']."'");
	}
	function Nationality_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM nationality WHERE id='".$Id."'");
	}
	function Nationality_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM nationality ORDER BY id DESC");
	}
	function Nationality_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM nationality ORDER BY id DESC LIMIT $Start, $Limit");
	}
	// Masters Community
	function Community_Insert()
	{
		return mysql_query("insert into community values('', '".$_POST['classname']."')");
	}
	function Community_Update()
	{
		return mysql_query("UPDATE community SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Community_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM community WHERE name='".$_POST['classname']."'");
	}
	function Community_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM community WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Community_Select_ById()
	{
		return mysql_query("SELECT * FROM community WHERE id='".$_GET['id']."'");
	}
	function Community_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM community WHERE id='".$Id."'");
	}
	function Community_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM community ORDER BY id DESC");
	}
	function Community_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM community ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Payment Mode
	function Payment_Insert()
	{
		return mysql_query("insert into payment_mode values('', '".$_POST['classname']."')");
	}
	function Payment_Update()
	{
		return mysql_query("UPDATE payment_mode SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Payment_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM payment_mode WHERE name='".$_POST['classname']."'");
	}
	function Payment_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM payment_mode WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Payment_Select_ById()
	{
		return mysql_query("SELECT * FROM payment_mode WHERE id='".$_GET['id']."'");
	}
	function Payment_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM payment_mode WHERE id='".$Id."'");
	}
	function Payment_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM payment_mode ORDER BY id DESC");
	}
	function Payment_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM payment_mode ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Payment Type
	function PaymentType_Insert()
	{
		return mysql_query("insert into payment_type values('', '".$_POST['paymenttype']."')");
	}
	function PaymentType_Update()
	{
		return mysql_query("UPDATE payment_type SET name='".$_POST['paymenttype']."' WHERE id='".$_POST['id']."'");
	}
	function PaymentType_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM payment_type WHERE name='".$_POST['paymenttype']."'");
	}
	function PaymentType_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM payment_type WHERE name='".$_POST['paymenttype']."' && id!='".$_POST['id']."'");
	}
	function PaymentType_Select_ById()
	{
		return mysql_query("SELECT * FROM payment_type WHERE id='".$_GET['id']."'");
	}
	function PaymentType_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM payment_type WHERE id='".$Id."'");
	}
	function PaymentType_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM payment_type ORDER BY id DESC");
	}
	function PaymentType_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM payment_type ORDER BY id DESC LIMIT $Start, $Limit");
	}
	// Masters Religion
	function Religion_Insert()
	{
		return mysql_query("insert into religion values('', '".$_POST['classname']."')");
	}
	function Religion_Update()
	{
		return mysql_query("UPDATE religion SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Religion_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM religion WHERE name='".$_POST['classname']."'");
	}
	function Religion_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM religion WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Religion_Select_ById()
	{
		return mysql_query("SELECT * FROM religion WHERE id='".$_GET['id']."'");
	}
	function Religion_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM religion WHERE id='".$Id."'");
	}
	function Religion_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM religion ORDER BY id DESC");
	}
	function Religion_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM religion ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
		
	// Masters Section
	function Section_Insert()
	{
		return mysql_query("insert into section values('', '".$_POST['sectionname']."','".$_POST['classname']."')");
	}
	function Section_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM section WHERE name='".$_POST['sectionname']."' && classid='".$_POST['classname']."'");
	}
	function Section_Update()
	{
		return mysql_query("UPDATE section SET name='".$_POST['sectionname']."',classid='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Section_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM section WHERE name='".$_POST['sectionname']."' && classid='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Section_Select_ById()
	{
		return mysql_query("SELECT * FROM section WHERE id='".$_GET['id']."'");
	}
	function Section_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM section WHERE id='".$Id."'");
	}
	function Section_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM section ORDER BY id DESC");
	}
	function Section_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM section ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Class_Select_All()
	{
		return mysql_query("SELECT * FROM class order by name asc");
	}
	function Section_Select_All()
	{
		return mysql_query("SELECT * FROM section order by name asc");
	}
	function Classes_Select_ById($ClassId)
	{
		return mysql_query("SELECT * FROM class where id='".$ClassId."'");
	}
	function Sections_Select_ById($Id)
	{
		return mysql_query("SELECT * FROM section where id='".$Id."'");
	}
	
	
	//Masters Role
	function Roles_Insert()
	{
		if($_POST['modules'])
			$_POST['modules'] = implode($_POST['modules'], ",");
		return mysql_query("insert into user_role values('', '".$_POST['role']."','".$_POST['modules']."')");
	}
	function Roles_Update()
	{
		if($_POST['modules'])
			$_POST['modules'] = implode($_POST['modules'], ",");
		return mysql_query("UPDATE user_role SET role='".$_POST['role']."',modules='".$_POST['modules']."' WHERE id='".$_POST['id']."'");
	}
	function Roles_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM user_role WHERE role='".$_POST['role']."'");
	}
	function Roles_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM user_role WHERE role='".$_POST['role']."' && id!='".$_POST['id']."'");
	}
	function Roles_Select_ById()
	{
		return mysql_query("SELECT * FROM user_role WHERE id='".$_GET['id']."'");
	}
	function Roles_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM user_role WHERE id='".$Id."'");
	}
	function Roles_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM user_role ORDER BY id DESC");
	}
	function Roles_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM user_role ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	
	
	// Masters Fees Category
	function Fees_Catagory_Insert()
	{
		return mysql_query("insert into fees_catagory values('','".$_POST['name']."')");
	}
	function Fees_Catagory_Update()
	{
		return mysql_query("UPDATE fees_catagory  set name='".$_POST['name']."'  WHERE id='".$_POST['id']."'");
	}
	function Fees_Catagory_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM fees_catagory WHERE name='".$_POST['name']."'");
	}
	function Fees_Catagory_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM fees_catagory WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Fees_Catagory_Select_ById()
	{
		return mysql_query("SELECT * FROM fees_catagory WHERE id='".$_GET['id']."'");
	}
	function Fees_Catagory_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM fees_catagory WHERE id='".$Id."'");
	}
	function Fees_Catagory_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM fees_catagory ORDER BY id DESC");
	}
	function Fees_Catagory_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM fees_catagory ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	 //Discount Queries
	 function Discount_Insert()
	 {
		return mysql_query("INSERT into discount values('','".$_POST['name']."','".$_POST['discount']."','".$_POST['mode']."')");
	 }
	 function Discount_Update()
	 {
		return mysql_query("UPDATE discount Set name='".$_POST['name']."',discount='".$_POST['discount']."',mode='".$_POST['mode']."' Where id='".$_POST['id']."'");
	 }
	 function Select_StudentCategory()
	 {
		return mysql_query("Select * From category");
	 }
	 function Discount_Select_ById()
	 {
		return mysql_query("Select * From discount where id='".$_GET['id']."'");
	 }
	 function Discount_Delete_ById($Id)
	 {
		return mysql_query("Delete From discount where id='".$Id."'");
	 }
	 function Discount_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM discount ORDER BY id DESC");
	}
	function Discount_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM discount ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Discount_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM discount WHERE name='".$_POST['name']."'");
	}
	function Discount_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM discount WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	
	//Masters Fees generate
	 function Fine_Insert()
	 {
		return mysql_query("INSERT into fine values('','".$_POST['name']."','".$_POST['days']."','".$_POST['amount']."')");
	 }
	 function Fine_Update()
	 {
		return mysql_query("UPDATE fine Set name='".$_POST['name']."',days='".$_POST['days']."',amount='".$_POST['amount']."'  Where id='".$_POST['id']."'");
	 }
	 function Fine_Select_ById()
	 {
		return mysql_query("Select * From fine where id='".$_GET['id']."'");
	 }
	 function Fine_Delete_ById($Id)
	 {
		return mysql_query("Delete From fine where id='".$Id."'");
	 }
	 function Fine_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM fine ORDER BY id DESC");
	}
	function Fine_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM fine ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Fine_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM fine WHERE name='".$_POST['name']."'");
	}
	function Fine_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM fine WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	// Masters SubReligion_
	function SubCaste_Insert()
	{
		return mysql_query("insert into subcast values('', '".$_POST['classname']."','".$_POST['caste']."')");
	}
	function SubCaste_Update()
	{
		return mysql_query("UPDATE subcast SET name='".$_POST['classname']."',castid='".$_POST['caste']."' WHERE id='".$_POST['id']."'");
	}
	function SubCaste_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM subcast WHERE name='".$_POST['classname']."' && castid='".$_POST['caste']."'");
	}
	function SubCaste_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM subcast WHERE name='".$_POST['classname']."' && castid='".$_POST['caste']."' && id!='".$_POST['id']."'");
	}
	function SubCaste_Select_ById()
	{
		return mysql_query("SELECT * FROM subcast WHERE id='".$_GET['id']."'");
	}
	function SubCaste_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM subcast WHERE id='".$Id."'");
	}
	function SubCaste_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM subcast ORDER BY id DESC");
	}
	function SubCaste_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM subcast ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Month
	function Month_Insert()
	{
		return mysql_query("insert into month values('','".$_POST['name']."')");
	}
	function Month_Update()
	{
		return mysql_query("UPDATE month  set name='".$_POST['name']."'  WHERE id='".$_POST['id']."'");
	}
	function Month_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM month WHERE name='".$_POST['name']."'");
	}
	function Month_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM month WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Month_Select_ById()
	{
		return mysql_query("SELECT * FROM month WHERE id='".$_GET['id']."'");
	}
	function Month_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM month WHERE id='".$Id."'");
	}
	function Month_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM month ORDER BY id DESC");
	}
	function Month_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM month ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Fees Category Assign
	function Feescategory_Select_All()
	{
		return mysql_query("SELECT * FROM fees_catagory ORDER BY id DESC");
	}
	function Feescategoryassign_Select_ById()
	{
		return mysql_query("SELECT * FROM fees_category_assign WHERE id='".$_GET['id']."'");
	}
	function Feescategoryassign_Delete_ById()
	{
		return mysql_query("DELETE FROM fees_category_assign WHERE id='".$_GET['id']."'");
	}
	function Feescategoryassign_Select_ByNamePWD($Classnames)
	{
		return mysql_query("SELECT * FROM fees_category_assign WHERE  feescategoryid = '".$_POST['feescategoryid']."' && classids ='".$Classnames."'");
	}	
	function Feescategoryassign_Insert($Classnames,$Monthnames)
	{
		return mysql_query("insert into fees_category_assign values('','".$_POST['categorydes']."','".$_POST['feescategoryid']."','".$Classnames."','".$_POST['amount']."','".$Monthnames."')");
	}
	function Feescategoryassign_Select_ByNamePWDId($Classnames)
	{
		return mysql_query("SELECT * FROM fees_category_assign WHERE  feescategoryid = '".$_POST['feescategoryid']."' && classids ='".$Classnames."' && id!='".$_POST['id']."'");
	}
	function Feescategoryassign_Update($Classnames,$Monthnames)
	{
		return mysql_query("update fees_category_assign set categorydes='".$_POST['categorydes']."',feescategoryid = '".$_POST['feescategoryid']."',classids = '".$Classnames."',amount = '".$_POST['amount']."',monthids = '".$Monthnames."' WHERE id='".$_POST['id']."'");
	}
	function Feescategory_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM fees_category_assign order by id desc");
	}
	function Feescategory_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM fees_category_assign ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function All_Class_Name($class)
	{
		return mysql_query("SELECT * FROM class WHERE id='".$class."'");
	}
	function All_Month_Name($Month)
	{
		return mysql_query("SELECT * FROM month WHERE id='".$Month."'");
	}
?>