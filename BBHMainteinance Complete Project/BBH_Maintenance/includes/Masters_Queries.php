<?php
	//Master : Division
	function Division_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division WHERE id='".$Id."'");
	}
	function Division_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM division WHERE id='".$Id."'");
	}
	function Division_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division WHERE name='".$Name."'");
	}
	function Division_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into division(id, name) values('', '".$Name."')");
	}
	function Division_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE division SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Division_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division ORDER BY id DESC");
	}
	function Division_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Department
	function Department_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE id='".$Id."'");
	}
	function Department_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM department WHERE id='".$Id."'");
	}
	function Department_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE name='".$Name."'");
	}
	function Department_Select_ByNameId($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department WHERE name='".$Name."' and id != ".$Id);
	}
	function Department_Insert()
	{
		foreach($_SESSION['GroupIds'] as $GroupId)
			$Groupmembers .= ','."'.$_POST[$GroupId].'";
			return mysqli_query($_SESSION['connection'],"insert into department values('', '".$_POST['divisionid']."', '".$_POST['name']."','".$_POST['extension']."','".$_POST['biomedical']."'".$Groupmembers.")");
	}
	function Department_Update()
	{
		foreach($_SESSION['GroupIds'] as $GroupId)
			$Groupmembers .= ',`'.$GroupId ."`=". "'.$_POST[$GroupId].'";
			return mysqli_query($_SESSION['connection'],"UPDATE department SET divisionid='".$_POST['divisionid']."', name='".$_POST['name']."' ,extension='".$_POST['extension']."' ,biomedical_department='".$_POST['biomedical']."' ".$Groupmembers." WHERE id='".$_POST['id']."'");
	}
	function Department_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department ORDER BY id DESC");
	}
	function Department_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT department.*,division.name as divisionname FROM department  join division ON department.divisionid = division.id ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Location
	function Location_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE id='".$Id."'");
	}
	function Location_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM location WHERE id='".$Id."'");
	}
	function Location_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE name='".$Name."'");
	}
	function Locationt_Select_ByNameId($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location WHERE name='".$Name."' and id != ".$Id);
	}
	function Location_Insert($DepartmentId, $Name,$Group)
	{
		return mysqli_query($_SESSION['connection'],"insert into location(id, departmentid, name,groupid) values('', '".$DepartmentId."', '".$Name."','".$Group."')");
	}
	function Location_Update($DepartmentId, $Name,$Group, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE location SET departmentid='".$DepartmentId."', name='".$Name."',groupid='".$Group."' WHERE id='".$Id."'");
	}
	function Location_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location ORDER BY id DESC");
	}
	function Location_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Zone
	function Zone_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone WHERE id='".$Id."'");
	}
	function Zone_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM zone WHERE id='".$Id."'");
	}
	function Zone_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone WHERE name='".$Name."'");
	}
	function Zone_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into zone(id, name) values('', '".$Name."')");
	}
	function Zone_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE zone SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Zone_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone ORDER BY id DESC");
	}
	function Zone_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM zone ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Asset Item
	function System_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item WHERE id='".$Id."'");
	}
	function System_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM item WHERE id='".$Id."'");
	}
	function System_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item WHERE name='".$Name."'");
	}
	function System_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into item(id, name) values('', '".$Name."')");
	}
	function System_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE item SET name='".$Name."' WHERE id='".$Id."'");
	}
	function System_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item ORDER BY id DESC");
	}
	function System_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Biomedical Item
	function Medical_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem WHERE id='".$Id."'");
	}
	function Medical_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM biomedicalitem WHERE id='".$Id."'");
	}
	function Medical_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem WHERE name='".$Name."'");
	}
	function Medical_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into biomedicalitem(id, name) values('', '".$Name."')");
	}
	function Medical_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE biomedicalitem SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Medical_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem ORDER BY id DESC");
	}
	function Medical_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Reason
	function Reason_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into holdcategory(id, name) values('', '".$Name."')");
	}
	function Reason_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE holdcategory SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Reason_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM holdcategory ORDER BY id DESC");
	}
	function Reason_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM holdcategory ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Reason_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM holdcategory WHERE id='".$Id."'");
	}
	function Reason_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM holdcategory WHERE id='".$Id."'");
	}
	
	//Master : User
	function UserRoles_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM userrole WHERE id!='5' ORDER BY id DESC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM userrole WHERE id='".$Id."'");
	}
	function User_Select_ByRole($Role,$Groupid)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid='".$Role."' and groupid='".$Groupid."'");
	}
	function User_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE id='".$Id."'");
	}
	function User_Select_ByNamePWD($Username, $PWD)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE username='".$Username."' && password='".$PWD."'");
	}
	function User_Select_ByNamePWDId($Username, $PWD, $Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE username='".$Username."' && password='".$PWD."' && id!='".$Id."'");
	}
	function User_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE username='".$Name."'");
	}
	function User_Insert($firstname, $lastname, $phonenumber, $username, $password, $userroleid, $departmentid, $groupid,$deptadmin)
	{
		if($groupid)
			return mysqli_query($_SESSION['connection'],"insert into user(id, firstname, lastname, phonenumber, username, password, userroleid, departmentid, groupid,deptadmin) values('', '".$firstname."', '".$lastname."', '".$phonenumber."', '".$username."', '".$password."', '".$userroleid."', '".$departmentid."', '".$groupid."','".$deptadmin."')");
		else
			return mysqli_query($_SESSION['connection'],"insert into user(id, firstname, lastname, phonenumber, username, password, userroleid, departmentid,deptadmin) values('', '".$firstname."', '".$lastname."', '".$phonenumber."', '".$username."', '".$password."', '".$userroleid."', '".$departmentid."','".$deptadmin."')");
	}
	function User_Update()
	{
		/*if($groupid && $userroleid !='1' && !$deptadmin)
		{
			echo "UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' ,groupid='".$groupid."' , deptadmin='0' WHERE id='".$Id."'";
			return mysqli_query($_SESSION['connection'],"UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' ,groupid='".$groupid."' , deptadmin='0' WHERE id='".$Id."'");
		}
		else if($deptadmin)
		{
			echo "UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' , deptadmin='".$deptadmin."' WHERE id='".$Id."'";
			return mysqli_query($_SESSION['connection'],"UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' , deptadmin='".$deptadmin."' WHERE id='".$Id."'");
		}
		else if($userroleid =='1' && !$deptadmin)
		{
			echo "UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' ,groupid='".$groupid."' , deptadmin='0' WHERE id='".$Id."'";
			return mysqli_query($_SESSION['connection'],"UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', phonenumber='".$phonenumber."', username='".$username."', password='".$password."', userroleid='".$userroleid."', departmentid='".$departmentid."' ,groupid='".$groupid."' , deptadmin='0' WHERE id='".$Id."'");
		}*/
		if(!$_POST['deptadmin'])
			$_POST['deptadmin'] = 0;
		return mysqli_query($_SESSION['connection'],"UPDATE user SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', phonenumber='".$_POST['phonenumber']."', username='".$_POST['username']."', password='".$_POST['password']."', userroleid='".$_POST['userroleid']."', departmentid='".$_POST['departmentid']."', groupid='".$_POST['groupid']."', deptadmin='".$_POST['deptadmin']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid='3' and groupid='".$_POST['groupid']."' ORDER BY id DESC");
	}
	function User_Select_Alls()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5' ORDER BY firstname ASC");
	}
	function User_Select_AllsBySearch($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5' and (firstname like '".$Search."%'  or firstname like '%".$Search."'  or firstname like '%".$Search."%')  ORDER BY firstname ASC ");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		if($_SESSION['roleid']==5)
			return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5'  ORDER BY firstname ASC LIMIT $Start, $Limit");
		else
			return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5' and groupid='".$_SESSION['groupid']."' ORDER BY firstname ASC LIMIT $Start, $Limit");
	}
	function User_Select_ByLimitSearch($Start, $Limit,$Search)
	{
		if($_SESSION['roleid']==5)
		{
			return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5' and (firstname like '".$Search."%'  or firstname like '%".$Search."'  or firstname like '%".$Search."%')  ORDER BY firstname ASC LIMIT $Start, $Limit");
		}
		else
			return mysqli_query($_SESSION['connection'],"SELECT * FROM user WHERE userroleid!='5' and firstname like '".$Search."%'  or firstname like '%".$Search."'  or firstname like '%".$Search."%' and groupid='".$_SESSION['groupid']."' ORDER BY firstname ASC LIMIT $Start, $Limit");
	}
	
	//Master : Group
	function User_Select_ByIdNameandPWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE id=".$Id);
	}	
	function Group_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE id=".$Id);
	}
	function Group_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` ORDER BY id ASC");
	}
	function Group_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM `group` WHERE id='".$Id."'");
	}
	function Group_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` WHERE name='".$Name."'");
	}
	function Group_Insert($Name, $DefaultAdmin, $Admins)
	{
		mysqli_query($_SESSION['connection'],"insert into `group`(id, name, defaultadmin, admins) values('', '".$Name."', '".$DefaultAdmin."', '".$Admins."')");
		return mysqli_query($_SESSION['connection'],"Alter table `department` add `".mysql_insert_id()."` bigint(20)");
	}
	function Group_Update($Name, $DefaultAdmin, $Admins, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE `group` SET name='".$Name."', defaultadmin='".$DefaultAdmin."', admins='".$Admins."' WHERE id='".$Id."'");
	}
	function Group_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `group` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function User_Select_ByGroupId($GroupId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where groupid=".$GroupId);
	}
	function User_Select_ByGroup()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where groupid='".$_SESSION['groupid']."'");
	}
	function User_Select_ByGroupByValue($Group)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where userroleid='3' and groupid='".$Group."'");
	}
	function User_Select_ByGroupByAdminandtechnicianValue($Group)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where (userroleid='3' or userroleid='1') and groupid='".$Group."'");
	}
	//Master : Subgroup
	function Subgroup_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup WHERE id='".$Id."'");
	}
	function Subgroup_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM subgroup WHERE id='".$Id."'");
	}
	function Subgroup_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup WHERE name='".$Name."'");
	}
	function Subgroup_Insert($GroupId, $ComplaintType,$Name, $Users)
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO subgroup(id, `groupid`, name,complainttype, users) VALUES('', '".$GroupId."','".$Name."', '".$ComplaintType."' , '".$Users."')");
	}
	function Subgroup_Update($GroupId,$ComplaintType, $Name, $Users, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE subgroup SET groupid='".$GroupId."', name='".$Name."', complainttype='".$ComplaintType."', users='".$Users."' WHERE id='".$Id."'");
	}
	function Subgroup_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup ORDER BY id DESC");
	}
	function Subgroup_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function SubGroup_Select_MIS()
	{
		foreach($_SESSION['groupids'] as $Groups)
		{
			$SelectGroup = mysqli_fetch_array(mysqli_query($_SESSION['connection'],'Select * From `group` where id="'.$Groups.'"'));
			if($SelectGroup['name']=='MIS')
			{
				return mysqli_query($_SESSION['connection'],"SELECT * FROM subgroup Where groupid='".$SelectGroup['id']."'");
			}
		}
	}
	//Master : Complaint Type
	function Complaint_Type_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complainttype WHERE id='".$Id."'");
	}
	function Complaint_Type_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM complainttype WHERE id='".$Id."'");
	}
	function Complaint_Type_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complainttype WHERE name='".$Name."'");
	}
	function Complaint_Type_Select_ByNameId($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complainttype WHERE name='".$Name."' && id!='".$Id."'");
	}
	function Complaint_Type_Insert($Name, $GroupId)
	{
		return mysqli_query($_SESSION['connection'],"insert into complainttype(id, name, groupid) values('', '".$Name."', '".$GroupId."')");
	}
	function Complaint_Type_Update($Name, $GroupId, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE complainttype SET name='".$Name."', groupid='".$GroupId."' WHERE id='".$Id."'");
	}
	function Complaint_Type_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complainttype ORDER BY id DESC");
	}
	function Complaint_Type_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complainttype ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Source
	function Source_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source WHERE id='".$Id."'");
	}
	function Source_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM source WHERE id='".$Id."'");
	}
	function Source_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source WHERE name='".$Name."'");
	}
	function Source_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into source(id, name) values('', '".$Name."')");
	}
	function Source_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE source SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Source_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source ORDER BY id DESC");
	}
	function Source_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM source ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Software
	function Software_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares WHERE id='".$Id."'");
	}
	function Software_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM softwares WHERE id='".$Id."'");
	}
	function Software_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares WHERE name='".$Name."'");
	}
	function Software_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into softwares(id, name) values('', '".$Name."')");
	}
	function Software_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE softwares SET name='".$Name."' WHERE id='".$Id."'");
	}
	function Software_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares ORDER BY id DESC");
	}
	function Software_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Biomedical Make
	function Make_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make WHERE id='".$Id."'");
	}
	function Make_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM biomedical_make WHERE id='".$Id."'");
	}
	function Make_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make WHERE make='".$Name."'");
	}
	function Make_Insert($Name)
	{
		return mysqli_query($_SESSION['connection'],"insert into biomedical_make(id, make) values('', '".$Name."')");
	}
	function Make_Update($Name, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE biomedical_make SET make='".$Name."' WHERE id='".$Id."'");
	}
	function Make_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make ORDER BY id DESC");
	}
	function Make_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Biomedical Model
	function Model_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into biomedical_model values('','".$_POST['make_id']."','".$_POST['model']."')");
	}
	function Model_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model WHERE model='".$_POST['model']."'");
	}
	function Model_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE biomedical_model SET model='".$_POST['model']."',make_id='".$_POST['make_id']."' WHERE id='".$_POST['id']."'");
	}
	function Model_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model WHERE model='".$_POST['model']."' && id!='".$_POST['id']."'");
	}
	function Model_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model WHERE id='".$_GET['id']."'");
	}
	function Model_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM biomedical_model WHERE id='".$Id."'");
	}
	function Model_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM biomedical_model ORDER BY id DESC");
	}
	function Model_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Make_Select_All_Make()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make order by make asc");
	}
	function Make_Select_ById_Make($MakeId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make where id='".$MakeId."'");
	}
	
	//Master : Biomedical Equipment
	function Equipment_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment WHERE id='".$Id."'");
	}
	function Equipment_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM biomedical_equipment WHERE id='".$Id."'");
	}
	function Equipment_Select_ByName($equipment)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment WHERE equipment='".$equipment."'");
	}
	function Equipmentt_Select_ByNameId($equipment, $Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment WHERE equipment='".$equipment."' and id != ".$Id);
	}
	function Equipment_Insert($make_id, $model_id,$equipment)
	{
		return mysqli_query($_SESSION['connection'],"insert into biomedical_equipment(id, make_id, model_id,equipment) values('', '".$make_id."', '".$model_id."','".$equipment."')");
	}
	function Equipment_Update($make_id, $model_id,$equipment, $Id)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE biomedical_equipment SET make_id='".$make_id."', model_id='".$model_id."',equipment='".$equipment."' WHERE id='".$Id."'");
	}
	function Equipment_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment ORDER BY id DESC");
	}
	function Equipment_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Model_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model order by id desc");
	}
	function Make_Select_ById_equipment($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make where id ='".$Id."' order by id desc");
	}
	function Model_Select_ById_equipment($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model where id ='".$Id."' order by id desc");
	}
	
		
	//Master : Breakdowncategory
	function breakdowncategory_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM breakdowncategory WHERE id='".$Id."'");
	}
	function breakdowncategory_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM breakdowncategory WHERE id='".$Id."'");
	}
	function breakdowncategory_Select_ByName()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM breakdowncategory WHERE breakdowncategory='".$_POST['breakdowncategory']."'");
	}
	function breakdowncategory_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into breakdowncategory(id, breakdowncategory) values('', '".$_POST['breakdowncategory']."')");
	}
	function breakdowncategory_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE breakdowncategory SET breakdowncategory='".$_POST['breakdowncategory']."' WHERE id='".$_POST['id']."'");
	}
	function breakdowncategory_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM breakdowncategory ORDER BY id DESC");
	}
	function breakdowncategory_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM breakdowncategory ORDER BY id DESC LIMIT $Start, $Limit");
	}
?>