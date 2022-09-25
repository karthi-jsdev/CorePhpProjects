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
	
	// Masters Caste
	function Caste_Insert()
	{
		return mysql_query("insert into cast values('', '".$_POST['classname']."')");
	}
	function Caste_Update()
	{
		return mysql_query("UPDATE cast SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Caste_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM cast WHERE name='".$_POST['classname']."'");
	}
	function Caste_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM cast WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Caste_Select_ById()
	{
		return mysql_query("SELECT * FROM cast WHERE id='".$_GET['id']."'");
	}
	function Caste_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM cast WHERE id='".$Id."'");
	}
	function Caste_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM cast ORDER BY id DESC");
	}
	function Caste_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM cast ORDER BY id DESC LIMIT $Start, $Limit");
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
	
	// Masters Relation
	function Relation_Insert()
	{
		return mysql_query("insert into relation values('', '".$_POST['classname']."')");
	}
	function Relation_Update()
	{
		return mysql_query("UPDATE relation SET name='".$_POST['classname']."' WHERE id='".$_POST['id']."'");
	}
	function Relation_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM relation WHERE name='".$_POST['classname']."'");
	}
	function Relation_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM relation WHERE name='".$_POST['classname']."' && id!='".$_POST['id']."'");
	}
	function Relation_Select_ById()
	{
		return mysql_query("SELECT * FROM relation WHERE id='".$_GET['id']."'");
	}
	function Relation_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM relation WHERE id='".$Id."'");
	}
	function Relation_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM relation ORDER BY id DESC");
	}
	function Relation_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM relation ORDER BY id DESC LIMIT $Start, $Limit");
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
	
	// Masters Terms
	function Term_Insert()
	{
		return mysql_query("insert into term values('', '".$_POST['name']."')");
	}
	function Term_Update()
	{
		return mysql_query("UPDATE term SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Term_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM term WHERE name='".$_POST['name']."'");
	}
	function Term_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM term WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Term_Select_ById()
	{
		return mysql_query("SELECT * FROM term WHERE id='".$_GET['id']."'");
	}
	function Term_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM term WHERE id='".$Id."'");
	}
	function Term_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM term ORDER BY id DESC");
	}
	function Term_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM term ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Department
	function Deparment_Insert()
	{
		return mysql_query("insert into department values('', '".$_POST['name']."')");
	}
	function Deparment_Update()
	{
		return mysql_query("UPDATE department SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Deparment_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM department WHERE name='".$_POST['name']."'");
	}
	function Deparment_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM department WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Deparment_Select_ById()
	{
		return mysql_query("SELECT * FROM department WHERE id='".$_GET['id']."'");
	}
	function Deparment_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM department WHERE id='".$Id."'");
	}
	function Deparment_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM department ORDER BY id DESC");
	}
	function Deparment_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM department ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Designation
	function Designation_Insert()
	{
		return mysql_query("insert into designation values('', '".$_POST['name']."')");
	}
	function Designation_Update()
	{
		return mysql_query("UPDATE designation SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Designation_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM designation WHERE name='".$_POST['name']."'");
	}
	function Designation_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM designation WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Designation_Select_ById()
	{
		return mysql_query("SELECT * FROM designation WHERE id='".$_GET['id']."'");
	}
	function Designation_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM designation WHERE id='".$Id."'");
	}
	function Designation_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM designation ORDER BY id DESC");
	}
	function Designation_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM designation ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
		//Qualification
	function Qualification_Insert()
	{
		return mysql_query("insert into qualification values('', '".$_POST['name']."')");
	}
	function Qualification_Update()
	{
		return mysql_query("UPDATE qualification SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Qualification_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM qualification WHERE name='".$_POST['name']."'");
	}
	function Qualification_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM qualification WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Qualification_Select_ById()
	{
		return mysql_query("SELECT * FROM qualification WHERE id='".$_GET['id']."'");
	}
	function Qualification_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM qualification WHERE id='".$Id."'");
	}
	function Qualification_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM qualification ORDER BY id DESC");
	}
	function Qualification_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM qualification ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
		//Occupation
	function Occupation_Insert()
	{
		return mysql_query("insert into occupation values('', '".$_POST['name']."')");
	}
	function Occupation_Update()
	{
		return mysql_query("UPDATE occupation SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Occupation_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM occupation WHERE name='".$_POST['name']."'");
	}
	function Occupation_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM occupation WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Occupation_Select_ById()
	{
		return mysql_query("SELECT * FROM occupation WHERE id='".$_GET['id']."'");
	}
	function Occupation_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM occupation WHERE id='".$Id."'");
	}
	function Occupation_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM occupation ORDER BY id DESC");
	}
	function Occupation_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM occupation ORDER BY id DESC LIMIT $Start, $Limit");
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
	
	// Masters Category
	function Category_Insert()
	{
		return mysql_query("insert into category values('', '".$_POST['categoryname']."')");
	}
	function Category_Update()
	{
		return mysql_query("UPDATE category SET name='".$_POST['categoryname']."' WHERE id='".$_POST['id']."'");
	}
	function Category_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM category WHERE name='".$_POST['categoryname']."'");
	}
	function Category_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM category WHERE name='".$_POST['categoryname']."' && id!='".$_POST['id']."'");
	}
	function Category_Select_ById()
	{
		return mysql_query("SELECT * FROM category WHERE id='".$_GET['id']."'");
	}
	function Category_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM category WHERE id='".$Id."'");
	}
	function Category_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM category ORDER BY id DESC");
	}
	function Category_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM category ORDER BY id DESC LIMIT $Start, $Limit");
	}
	// Masters Subjects
	function Subject_Insert()
	{
		return mysql_query("insert into subject values('', '".$_POST['subjectname']."')");
	}
	function Subject_Update()
	{
		return mysql_query("UPDATE subject SET name='".$_POST['subjectname']."' WHERE id='".$_POST['id']."'");
	}
	function Subject_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM subject WHERE name='".$_POST['subjectname']."'");
	}
	function Subject_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM subject WHERE name='".$_POST['subjectname']."' && id!='".$_POST['id']."'");
	}
	function Subject_Select_ById()
	{
		return mysql_query("SELECT * FROM subject WHERE id='".$_GET['id']."'");
	}
	function Subject_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM subject WHERE id='".$Id."'");
	}
	function Subject_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM subject ORDER BY id DESC");
	}
	function Subject_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM subject ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	// Masters Salary Particulars
	function Salary_Insert()
	{
		if(!$_POST['isdeduction'])
			$_POST['isdeduction']=0;
		return mysql_query("insert into salary_particulars values('', '".$_POST['particular']."','".$_POST['isdeduction']."')");
	}
	function Salary_Update()
	{
		if(!$_POST['isdeduction'])
			$_POST['isdeduction']=0;
		return mysql_query("UPDATE salary_particulars SET particular='".$_POST['particular']."',isdeduction='".$_POST['isdeduction']."' WHERE id='".$_POST['id']."'");
	}
	function Salary_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM salary_particulars WHERE particular='".$_POST['particular']."'");
	}
	function Salary_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM salary_particulars WHERE particular='".$_POST['particular']."' && id!='".$_POST['id']."'");
	}
	function Salary_Select_ById()
	{
		return mysql_query("SELECT * FROM salary_particulars WHERE id='".$_GET['id']."'");
	}
	function Salary_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM salary_particulars WHERE id='".$Id."'");
	}
	function Salary_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM salary_particulars ORDER BY id DESC");
	}
	function Salary_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM salary_particulars ORDER BY id DESC LIMIT $Start, $Limit");
	}
	// Masters Fees Category
	function Fees_Catagory_Insert()
	{
		return mysql_query("insert into fees_catagory values('', '".$_POST['name']."')");
	}
	function Fees_Catagory_Update()
	{
		return mysql_query("UPDATE fees_catagory SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
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
	// Masters Fees Particulars
	function Select_Category()
	{
		return mysql_query("SELECT * FROM fees_catagory");
	}
	function Fees_Particular_Insert()
	{
		return mysql_query("insert into fees_particulars values('', '".$_POST['name']."', '".$_POST['categoryid']."')");
	}
	function Fees_Particular_Update()
	{
		return mysql_query("UPDATE fees_particulars SET name='".$_POST['name']."',categoryid='".$_POST['categoryid']."' WHERE id='".$_POST['id']."'");
	}
	function Fees_Particular_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM fees_particulars WHERE name='".$_POST['name']."'");
	}
	function Fees_Particular_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM fees_particulars WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Fees_Particular_Select_ById()
	{
		return mysql_query("SELECT * FROM fees_particulars WHERE id='".$_GET['id']."'");
	}
	function Fees_Particular_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM fees_particulars WHERE id='".$Id."'");
	}
	function Fees_Particular_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM fees_particulars ORDER BY id DESC");
	}
	function Fees_Particular_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM fees_particulars ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function FetchCategoryById($Id)
	{
		return mysql_query("Select * From fees_catagory where id='".$Id."'");
	}
	//Fees Assignment
	function Select_ParticularsByCategoryId($Id)
	{
		return mysql_query("SELECT * FROM fees_particulars WHERE categoryid='".$Id."'");
	}
	function Fees_Assignment_Insert()
	{
		$Query = "";
		$SelectTerm = mysql_query("select * from term");
		$Size = mysql_num_rows($SelectTerm);
		$i=1;
		while($FetchTerm = mysql_fetch_array($SelectTerm))
		{
			$Size--;
			$Query .= $_POST['terms'.$i.''];
			if($Size)
				$Query .= ",";
			$i++;
		}
		return mysql_query("Insert into fees_assignment values('','".$_POST['assignment_categoryid']."','".$_POST['assignment_particulars']."','".$_POST['assignment_class']."','".$_POST['total']."','".$_POST['mode']."','".$Query."')");
	}
	function Fees_Assignment_Update()
	{
		$Query = "";
		$SelectTerm = mysql_query("select * from term");
		$Size = mysql_num_rows($SelectTerm);
		$i=1;
		while($FetchTerm = mysql_fetch_array($SelectTerm))
		{
			$Size--;
			$Query .= $_POST['terms'.$i.''];
			if($Size)
				$Query .= ",";
			$i++;
		}
		return mysql_query("Update fees_assignment SET total='".$_POST['total']."',categoryid='".$_POST['assignment_categoryid']."',particularid='".$_POST['assignment_particulars']."',classid='".$_POST['assignment_class']."',mode='".$_POST['mode']."',term='".$Query."' WHERE id='".$_POST['id']."'");
	}
	function Fees_Assignment_Select_ById()
	{
		return mysql_query("select * From fees_assignment where id='".$_GET['id']."'");
	}
	function Fees_Assignment_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM fees_assignment ORDER BY id DESC");
	}
	function Fees_Assignment_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM fees_assignment ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function FetchParticularById($Id)
	{
		return mysql_query("SELECT * FROM fees_particulars WHERE id='".$Id."'");
	}
	function Select_Term()
	{
		return mysql_query("select * from term");
	}
	function Fees_Assignment_Delete_ById($Id)
	{
		return mysql_query("Delete from fees_assignment where id='".$Id."'");
	}
	 //Discount Queries
	 function Discount_Insert()
	 {
		return mysql_query("INSERT into discount values('','".$_POST['name']."','".$_POST['discount']."','".$_POST['fees_categoryid']."','".$_POST['student_categoryid']."','".$_POST['mode']."')");
	 }
	 function Discount_Update()
	 {
		return mysql_query("UPDATE discount Set name='".$_POST['name']."',discount='".$_POST['discount']."',categoryid='".$_POST['fees_categoryid']."',studentcategoryid='".$_POST['student_categoryid']."',mode='".$_POST['mode']."' Where id='".$_POST['id']."'");
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
		return mysql_query("UPDATE fine Set name='".$_POST['name']."',days='".$_POST['days']."',amount='".$_POST['amount']."' Where id='".$_POST['id']."'");
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
	
	//Masters BusRoute
	function Bus_Insert()
	 {
		return mysql_query("INSERT into busroute values('','".$_POST['name']."','".$_POST['timings']."')");
	 }
	 function Bus_Update()
	 {
		return mysql_query("UPDATE busroute Set name='".$_POST['name']."',timings='".$_POST['timings']."' Where id='".$_POST['id']."'");
	 }
	 function Bus_Select_ById()
	 {
		return mysql_query("Select * From busroute where id='".$_GET['id']."'");
	 }
	 function Bus_Delete_ById($Id)
	 {
		return mysql_query("Delete From busroute where id='".$Id."'");
	 }
	 function Bus_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM busroute ORDER BY id DESC");
	}
	function Bus_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM busroute ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Bus_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM busroute WHERE name='".$_POST['name']."' && timings='".$_POST['timings']."'");
	}
	function Bus_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM busroute WHERE name='".$_POST['name']."' && timings='".$_POST['timings']."' && id!='".$_POST['id']."'");
	}
	
	//Grade
	function Grade_Insert()
	{
		return mysql_query("insert into staff_grade values('', '".$_POST['name']."')");
	}
	function Grade_Update()
	{
		return mysql_query("UPDATE staff_grade SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Grade_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM staff_grade WHERE name='".$_POST['name']."'");
	}
	function Grade_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM staff_grade WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Grade_Select_ById()
	{
		return mysql_query("SELECT * FROM staff_grade WHERE id='".$_GET['id']."'");
	}
	function Grade_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM staff_grade WHERE id='".$Id."'");
	}
	function Grade_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM staff_grade ORDER BY id DESC");
	}
	function Grade_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM staff_grade ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Salary Assignment
	function Select_Department()
	{
		return mysql_query("SELECT * FROM department order by name asc");
	}
	function FetchDepartmentById($Id)
	{
		return mysql_query("SELECT * FROM department where id='".$Id."' order by name asc");
	}
	function FetchGradeById($Id)
	{
		return mysql_query("SELECT * FROM staff_grade where id='".$Id."' order by name asc");
	}
	function Select_Grade()
	{
		return mysql_query("SELECT * FROM staff_grade order by name asc");
	}
	function Salary_Assignment_Insert()
	{
		$Query = "";$Count = 0;
		if($_POST['partculars'])
		{
			$Count = count($_POST['partculars']);
			foreach($_POST['partculars'] as $pa)
			{
				$Count--;
				$Query .= $pa;
				if($Count)
					$Query .= ",";
			}
		}
		return mysql_query("Insert into staff_salary_assignment values('','".$_POST['department']."','".$_POST['grade']."',$Query)");
	}
	function Salary_Assignment_Update()
	{
		$Query = "";$Count = 0;$i=1;
		if($_POST['partculars'])
		{
			$Count = count($_POST['partculars']);
			foreach($_POST['partculars'] as $pa)
			{
				if($i==1)
					$Query .= "basic_pay=";
				else if($i==2)
					$Query .= "da=";
				else if($i==3)
					$Query .= "hra=";
				else if($i==4)
					$Query .= "cca=";
				else if($i==5)
					$Query .= "ma=";
				else if($i==6)
					$Query .= "lop=";
				$Count--;
				if($pa)
					$Query .= $pa;
				else
					$Query .= "0";
				if($Count)
					$Query .= ",";
				$i++;
			}
		}
		//echo "Update staff_salary_assignment SET department_id='".$_POST['department']."',grade_id='".$_POST['grade']."',$Query WHERE id='".$_POST['id']."'";
		return mysql_query("Update staff_salary_assignment SET department_id='".$_POST['department']."',grade_id='".$_POST['grade']."',$Query WHERE id='".$_POST['id']."'");
	}
	function Salary_Assignment_Select_ById()
	{
		return mysql_query("select * From staff_salary_assignment where id='".$_GET['id']."'");
	}
	function Salary_Assignment_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM staff_salary_assignment ORDER BY id DESC");
	}
	function Salary_Assignment_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM staff_salary_assignment ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Salary_Assignment_Delete_ById($id)
	{
		return mysql_query("delete  From staff_salary_assignment where id='".$id."'");
	}
	function SelectParticulars()
	{
		return mysql_query("select * from salary_particulars");
	}
	function Salary_Assignment_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM staff_salary_assignment WHERE department_id='".$_POST['department']."' && grade_id='".$_POST['grade']."'");
	}
	function Salary_Assignment_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM staff_salary_assignment WHERE department_id='".$_POST['department']."' && grade_id='".$_POST['grade']."' && id!='".$_POST['id']."'");
	}
	// Masters Miscellaneous Category
	function Misc_Catagory_Insert()
	{
		return mysql_query("insert into miscellaneous values('', '".$_POST['name']."')");
	}
	function Misc_Catagory_Update()
	{
		return mysql_query("UPDATE miscellaneous SET name='".$_POST['name']."' WHERE id='".$_POST['id']."'");
	}
	function Misc_Catagory_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM miscellaneous WHERE name='".$_POST['name']."'");
	}
	function Misc_Catagory_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM miscellaneous WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Misc_Catagory_Select_ById()
	{
		return mysql_query("SELECT * FROM miscellaneous WHERE id='".$_GET['id']."'");
	}
	function Misc_Catagory_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM miscellaneous WHERE id='".$Id."'");
	}
	function Misc_Catagory_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM miscellaneous ORDER BY id DESC");
	}
	function Misc_Catagory_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM miscellaneous ORDER BY id DESC LIMIT $Start, $Limit");
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
	function Feescategoryassign_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM fees_category_assign WHERE categorydes='".$_POST['categorydes']."' && feescategoryid = '".$_POST['feescategoryid']."'");
	}	
	function Feescategoryassign_Insert($Classnames,$Monthnames)
	{
		return mysql_query("insert into fees_category_assign values('','".$_POST['categorydes']."','".$_POST['feescategoryid']."','".$Classnames."','".$_POST['amount']."','".$Monthnames."')");
	}
	function Feescategoryassign_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM fees_category_assign WHERE name='".$_POST['categorydes']."' && feescategoryid = '".$_POST['feescategoryid']."'&& id!='".$_POST['id']."'");
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
?>