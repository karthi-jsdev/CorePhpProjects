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
	
	//Master : Machine Type
	
	function MachineType_Insert($MachineNos)
	{
		return mysql_query("insert into machine_type values('','".$MachineNos."', '".$_POST['machinetype']."')");
	}
	function MachineType_Select_ById()
	{
		return mysql_query("SELECT * FROM machine_type WHERE id='".$_GET['id']."'");
	}
	function MachineType_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM machine_type WHERE id='".$Id."'");
	}
	function MachineType_Select_ByName()
	{
		return mysql_query("SELECT * FROM machine_type WHERE type='".$_POST['machinetype']."'");
	}
	function MachineType_Update()
	{
		return mysql_query("UPDATE machine_type SET type='".$_POST['machinetype']."' WHERE id='".$_POST['id']."'");
	}
	function MachineType_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM machine_type ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function MachineType_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM machine_type ORDER BY id DESC");
	}
	function Machine_Get_LastId_Type()
	{
		return mysql_query("SELECT * FROM machine_type ORDER BY id DESC LIMIT 0,1");
	}
	
	
	//Master : Make	
	function MachineMake_Insert($MakeNos)
	{
		return mysql_query("insert into machine_make values('','".$MakeNos."','".$_POST['machinemake']."')");
	}
	function MachineMake_Select_ById()
	{
		return mysql_query("SELECT * FROM machine_make WHERE id='".$_GET['id']."'");
	}
	function MachineMake_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM machine_make WHERE id='".$Id."'");
	}
	function MachineMake_Select_ByName()
	{
		return mysql_query("SELECT * FROM machine_make WHERE name='".$_POST['machinemake']."'");
	}
	function MachineMake_Update()
	{
		return mysql_query("UPDATE machine_make SET name='".$_POST['machinemake']."' WHERE id='".$_POST['id']."'");
	}
	function MachineMake_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM machine_make ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function MachineMake_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM machine_make ORDER BY id DESC");
	}
	function Machine_Get_LastId_Make()
	{
		return mysql_query("SELECT * FROM machine_make ORDER BY id DESC LIMIT 0,1");
	}
	
	//Master : Specification
	
	function Specification_Insert($SpecificationNos)
	{
		return mysql_query("insert into machine_specification values('','".$SpecificationNos."','".$_POST['specification']."')");
	}
	function Specification_Select_ById()
	{
		return mysql_query("SELECT * FROM machine_specification WHERE id='".$_GET['id']."'");
	}
	function Specification_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM machine_specification WHERE id='".$Id."'");
	}
	function Specification_Select_ByName()
	{
		return mysql_query("SELECT * FROM machine_specification WHERE specification='".$_POST['specification']."'");
	}
	function Specification_Update()
	{
		return mysql_query("UPDATE machine_specification SET specification='".$_POST['specification']."' WHERE id='".$_POST['id']."'");
	}
	function Specification_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM machine_specification ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Specification_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM machine_specification ORDER BY id DESC");
	}
	function Machine_Get_LastId_Specification()
	{
		return mysql_query("SELECT * FROM machine_specification ORDER BY id DESC LIMIT 0,1");
	}
	
	//Master : Turning Tools
	
	function TurningTools_Insert($TurningToolsNos)
	{
		return mysql_query("insert into machine_turningtools values('','".$_POST['turningtools']."','".$TurningToolsNos."')");
	}
	function TurningTools_Select_ById()
	{
		return mysql_query("SELECT * FROM machine_turningtools WHERE id='".$_GET['id']."'");
	}
	function TurningTools_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM machine_turningtools WHERE id='".$Id."'");
	}
	function TurningTools_Select_ByName()
	{
		return mysql_query("SELECT * FROM machine_turningtools WHERE turningtool='".$_POST['turningtools']."'");
	}
	function TurningTools_Update()
	{
		return mysql_query("UPDATE machine_turningtools SET turningtool ='".$_POST['turningtools']."' WHERE id='".$_POST['id']."'");
	}
	function TurningTools_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM machine_turningtools ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function TurningTools_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM machine_turningtools ORDER BY id DESC");
	}
	function Machine_Get_LastId_Turningtool()
	{
		return mysql_query("SELECT * FROM machine_turningtools ORDER BY id DESC LIMIT 0,1");
	}
	//Master :Machine
	function Master_Machine_Type()
	{
		return mysql_query("Select * From machine_type");
	}
	function Master_Machine_Make()
	{
		return mysql_query("Select * From machine_make");
	}
	function Master_Machine_Specification_Size()
	{
		return mysql_query("Select * From machine_specification");
	}
	function Master_Machine_Turning_Tools()
	{
		return mysql_query("Select * From  machine_turningtools");
	}
	function Machine_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM machine ORDER BY id DESC");
	}
	function Machine_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("Select * From machine Order By id desc LIMIT $Start, $Limit");
	}
	function Select_MachineType($TypeId)
	{
		return mysql_query("Select * From machine_type where id='".$TypeId."'");
	}
	function Select_MachineMake($MakeId)
	{
		return mysql_query("Select * From machine_make where id='".$MakeId."'");
	}
	function Select_Specification_Size($SpecificationId)
	{
		return mysql_query("Select * From machine_specification where id='".$SpecificationId."'");
	}
	function Select_Turning_Tools($ToolId)
	{
		return mysql_query("Select * From  machine_turningtools where id='".$ToolId."'");
	}
	function Select_MachineNo()
	{
		return mysql_query("Select * From machine where machine_number='".$_POST['machine_number']."'");
	}
	function Machine_Insert()
	{
		return mysql_query("Insert into machine values('','".$_POST['machine_number']."','".$_POST['machine_type_id']."','".$_POST['machine_make_id']."','".$_POST['machine_specification_id']."','".$_POST['machine_turningtools_id']."')");
	}
	function Machine_Update()
	{
		return mysql_query("update machine set machine_number='".$_POST['machine_number']."',machine_type_id='".$_POST['machine_type_id']."',machine_make_id='".$_POST['machine_make_id']."',machine_specification_id='".$_POST['machine_specification_id']."',machine_turningtools_id='".$_POST['machine_turningtools_id']."' WHERE id='".$_POST['id']."'");
	}
	function Select_MachineNoById()
	{
		return mysql_query("Select * From machine where machine_number='".$_POST['machine_number']."' && id!='".$_POST['id']."'");
	}
	function Machine_Delete_ById($MachineId)
	{
		return mysql_query("DELETE FROM machine WHERE id='".$MachineId."'");
	}
	function Machine_Select_ById()
	{
		return mysql_query("Select * From machine Where id='".$_GET['id']."'");
	}
	
	//Master :Location 
	function Master_Section()
	{
		return mysql_query("Select * From section");
	}
	function Select_SectionName($SectionId)
	{
		return mysql_query("Select * From section where id='".$SectionId."'");
	}
	function Master_SubSection()
	{
		return mysql_query("Select * From subsection");
	}
	function Master_SubSectionBySectionId($SectionId)
	{
		return mysql_query("Select * From subsection where sectionid='".$SectionId."'");
	}
	function Select_SubSectionName($SubSectionId)
	{
		return mysql_query("Select * From subsection where id='".$SubSectionId."'");
	}
	function Master_LocationReference($SubSectionId)
	{
		return mysql_query("Select * From location_reference where subsectionid='".$SubSectionId."'");
	}
	function Master_AvailableLocationReference()
	{
		if($_GET['action'] == "assign")
			return mysql_query("SELECT location_reference_id, name FROM location WHERE subsection_id = '".$_GET['SubSectionId']."' and id NOT IN (SELECT location_id FROM machine_assignment)");
		else
			return mysql_query("SELECT location_reference_id, name FROM location WHERE subsection_id = '".$_GET['SubSectionId']."' and id IN (SELECT location_id FROM machine_assignment)");
	}
	function Select_LoctionReference($LoctionReferenceId)
	{
		return mysql_query("Select * From location_reference where id='".$LoctionReferenceId."'");
	}
	function Location_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM location ORDER BY id DESC");
	}
	function Location_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT * FROM location ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Location_Select_ById()
	{
		return mysql_query("SELECT * FROM location where id='".$_GET['id']."'");
	}
	function Location_Delete_ById($LocationId)
	{
		return mysql_query("DELETE FROM location WHERE id='".$LocationId."'");
	}
	function Select_Location()
	{
		return mysql_query("Select * From location where name='".$_POST['name']."'");
	}
	function Select_LocationNameById()
	{
		return mysql_query("Select * From location where name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	function Location_Insert()
	{
		return mysql_query("insert into location values('','".$_POST['name']."','".$_POST['section_id']."','".$_POST['subsection_id']."','".$_POST['location_reference_id']."')");
	}
	function Location_Update()
	{
		return mysql_query("update location Set name='".$_POST['name']."', section_id='".$_POST['section_id']."',subsection_id='".$_POST['subsection_id']."',location_reference_id='".$_POST['location_reference_id']."' WHERE id='".$_POST['id']."'");
	}
	function Masters_SelectLocationById($LocationReferenceId)
	{
		return mysql_query("Select * From location where location_reference_id='".$LocationReferenceId."'");
	}
	//Master Customer
	function Customer_Insert()
	{
		return mysql_query("INSERT INTO customer (customerid,name,address,contactname,phone,fax,email) VALUES ('".$_POST['customerid']."','".$_POST['name']."','".$_POST['address']."','".$_POST['contactname']."','".$_POST['phone']."','".$_POST['fax']."','".$_POST['email']."')");
	}
	function Customer_Select()
	{
		return mysql_query("SELECT * FROM customer ORDER BY id DESC");
	}
	function Customer_Select_ByCount()
	{
		return mysql_query("SELECT COUNT(*) as total FROM customer ORDER BY id Desc");
	}
	function Customer_Select_CustomerId()
	{
		return mysql_query("SELECT id FROM customer ORDER BY id DESC");
	}
	function Customer_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT * FROM customer ORDER BY id Desc LIMIT $Start,$Limit");
	}
	function Customer_Select_Id()
	{
		return mysql_query("SELECT * FROM customer WHERE id='".$_GET['id']."'");
	}
	function Customer_Update()
	{
		return mysql_query("UPDATE customer SET name='".$_POST['name']."',address='".$_POST['address']."',contactname='".$_POST['contactname']."',phone='".$_POST['phone']."',fax='".$_POST['fax']."',email='".$_POST['email']."' WHERE id='".$_POST['id']."'");
	}
	function Customer_Delete()
	{
		return mysql_query("DELETE FROM customer WHERE id='".$_GET['id']."'");
	}
	
	//Master Product
	function Product_Insert()
	{
		if(!$_POST['file'])
			return mysql_query("INSERT INTO product (drawing_number,description,material_type,material_size,grade,numberofpieces,outputperhour) VALUES ('".$_POST['drawing_number']."','".$_POST['description']."','".$_POST['material_type']."','".$_POST['material_size']."','".$_POST['grade']."','".$_POST['numberofpieces']."','".$_POST['outputperhour']."')");
		else
			return mysql_query("INSERT INTO product (drawing_number,description,material_type,material_size,grade,numberofpieces,outputperhour,image) VALUES ('".$_POST['drawing_number']."','".$_POST['description']."','".$_POST['material_type']."','".$_POST['material_size']."','".$_POST['grade']."','".$_POST['numberofpieces']."','".$_POST['outputperhour']."','".$_POST['file']."')");
	}
	function Product_Select()
	{
		return mysql_query("SELECT * FROM product ORDER BY id DESC");
	}
	function Product_Select_Count()
	{
		return mysql_query("SELECT COUNT(*) as total FROM product ORDER BY id DESC");
	}
	function Product_Select_Count_Search($Search)
	{
		return mysql_query("SELECT COUNT(*) as total FROM product WHERE drawing_number like '%".$Search."' AND  drawing_number like '".$Search."%' ORDER BY id DESC");
		//return mysql_query("SELECT COUNT(*) as total FROM product WHERE description like '%".$Search."' or description like '".$Search."%' or description like '%".$Search."%' ORDER BY id DESC");
	}
	function Product_Select_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT * FROM product ORDER BY id DESC LIMIT $Start,$Limit");
	}
	function Product_Select_ByLimit_Search($Start,$Limit,$Search)
	{
		return mysql_query("SELECT * FROM product WHERE drawing_number like '%".$Search."' AND  drawing_number like '".$Search."%'  ORDER BY id DESC LIMIT $Start,$Limit");
		//return mysql_query("SELECT * FROM product WHERE description like '%".$Search."' or description like '".$Search."%' or description like '%".$Search."%'  ORDER BY id DESC LIMIT $Start,$Limit");
	}
	function Product_Delete_ById()
	{
		return mysql_query("DELETE FROM product WHERE id='".$_GET['id']."'");
	}
	function Product_Select_ById()
	{
		return mysql_query("SELECT * FROM product WHERE id='".$_GET['id']."'");
	}
	function Product_Select_ByNo()
	{
		return mysql_query("SELECT * FROM product WHERE drawing_number='".$_POST['drawing_number']."'");
	}
	function Product_Update_ById()
	{
		if($_POST['file']==null)
			return mysql_query("UPDATE product SET drawing_number='".$_POST['drawing_number']."',description='".$_POST['description']."',material_type='".$_POST['material_type']."',material_size='".$_POST['material_size']."',grade='".$_POST['grade']."',numberofpieces='".$_POST['numberofpieces']."',outputperhour='".$_POST['outputperhour']."' WHERE id='".$_POST['id']."'");
		else
			return mysql_query("UPDATE product SET drawing_number='".$_POST['drawing_number']."',description='".$_POST['description']."',material_type='".$_POST['material_type']."',material_size='".$_POST['material_size']."',grade='".$_POST['grade']."',numberofpieces='".$_POST['numberofpieces']."',outputperhour='".$_POST['outputperhour']."',image='".$_POST['file']."' WHERE id='".$_POST['id']."'");
	}
?>