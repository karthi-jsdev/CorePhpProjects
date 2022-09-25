<?php
	//Master : assets
	function Assets_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets WHERE id='".$Id."'");
	}
	function Assets_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM assets WHERE id='".$Id."'");
	}
	function Assets_Insert($divisionid, $departmentid,$locationid,$itemid,$itemname,$itemdescription,$connectiontype,$purchasedat,$warrantydate,$amcperiod,$condemned,$standby,$softwareids,$ipaddress)
	{
		if($locationid)
			return mysqli_query($_SESSION['connection'],"insert into assets(divisionid,departmentid, locationid,itemid,itemname,itemdescription,connectiontype,purchasedat,warrantydate,amcperiod,condemned,standby,softwareids,ipaddress) values('".$divisionid."', '".$departmentid."','".$locationid."','".$itemid."','".$itemname."','".$itemdescription."','".$connectiontype."','".date('Y-m-d',strtotime($purchasedat))."','".date('Y-m-d',strtotime($warrantydate))."','".$amcperiod."','".$condemned."','".$standby."','".$softwareids."','".$ipaddress."')");
		else
			return mysqli_query($_SESSION['connection'],"insert into assets(divisionid,departmentid,itemid,itemname,itemdescription,connectiontype,purchasedat,warrantydate,amcperiod,condemned,standby,softwareids,ipaddress) values('".$divisionid."', '".$departmentid."','".$itemid."','".$itemname."','".$itemdescription."','".$connectiontype."','".date('Y-m-d',strtotime($purchasedat))."','".date('Y-m-d',strtotime($warrantydate))."','".$amcperiod."','".$condemned."','".$standby."','".$softwareids."','".$ipaddress."')");
	}
	function Assets_Update($Id,$divisionid,$departmentid,$locationid,$itemid,$itemname,$itemdescription,$connectiontype,$purchasedat,$warrantydate,$amcperiod,$condemned,$standby,$softwareids,$ipaddress)
	{
		if($locationid)
			return mysqli_query($_SESSION['connection'],"UPDATE assets SET divisionid='".$divisionid."',departmentid='".$departmentid."',locationid='".$locationid."', itemid='".$itemid."', itemname='".$itemname."', itemdescription='".$itemdescription."', connectiontype='".$connectiontype."',purchasedat='".date('Y-m-d',strtotime($purchasedat))."',warrantydate='".date('Y-m-d',strtotime($warrantydate))."', amcperiod='".$amcperiod."', condemned='".$condemned."', standby='".$standby."', softwareids='".$softwareids."', ipaddress='".$ipaddress."' WHERE id='".$Id."'");
		else
			return mysqli_query($_SESSION['connection'],"UPDATE assets SET divisionid='".$divisionid."',departmentid='".$departmentid."', itemid='".$itemid."', itemname='".$itemname."', itemdescription='".$itemdescription."', connectiontype='".$connectiontype."',purchasedat='".date('Y-m-d',strtotime($purchasedat))."',warrantydate='".date('Y-m-d',strtotime($warrantydate))."', amcperiod='".$amcperiod."', condemned='".$condemned."', standby='".$standby."', softwareids='".$softwareids."', ipaddress='".$ipaddress."' WHERE id='".$Id."'");
	}
	function Assets_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets ORDER BY id DESC");
	}
	function Assets_Select_AllBySearch($Search)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets WHERE itemname like '".$Search."%'  or itemname like '%".$Search."' or itemname like '%".$Search."%'ORDER BY id DESC");
	}
	function Assets_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Assets_Select_ByLimitSearch($Search,$Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets WHERE itemname like '".$Search."%'  or itemname like '%".$Search."' or itemname like '%".$Search."%' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Assets_Select_Division()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division ORDER BY name asc");
	}
	function Assets_Get_DepartmentById($DivisionId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where divisionid = '".$DivisionId."' ORDER BY name asc");
	}
	function Assets_Get_LocationById($LocationId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where departmentid = '".$LocationId."' ORDER BY name asc");
	}
	function Assets_Select_item_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item ORDER BY name asc");
	}
	function Asset_Division_BYId($DivisionId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division Where id='".$DivisionId."' ORDER BY name asc");
	}
	function Assets_DepartmentById($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where id = '".$DepartmentId."' ORDER BY name asc");
	}
	function Assets_LocationById($LocationId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where id = '".$LocationId."' ORDER BY name asc");
	}
	function Assets_itemById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM item where id = '".$Id."' ORDER BY id asc");
	}
	function Asset_Select_All_Complaint($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint where itemid = '".$Id."' ORDER BY id DESC");
	}
	function Assets_Select_All_Name($name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets where itemname = '".$name."' ORDER BY id DESC");
	}
	// Asset Status
	function Assets_Status_Insert($assetid, $assetdescription,$statusid)
	{
		return mysqli_query($_SESSION['connection'],"insert into assetstatus(assetid,assetdescription,statusid,datetime) values('".$assetid."', '".$assetdescription."','".$statusid."','".date('Y-m-d H:i:s')."')");
	}	
	function Assets_Status_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from assetstatus where assetid='".$Id."' order by id desc");
	}
	function Assets_Status_Select_ByItemName($Name,$Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"select * from assets where itemname like '".$Name."%' or itemname like '% ".$Name."'  or itemname like '% ".$Name." %' order by id desc Limit $Start, $Limit");
	}
	function Assets_Status_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"select * from assets where itemname like '".$Name."%' or itemname  like '% ".$Name."'  or itemname like '% ".$Name." %'  order by id desc");
	}
	function Complaint_Get_Status()
	{
		return mysqli_query($_SESSION['connection'],"select * from status WHERE id<>8 ");
	}
	function Complaint_Get_Status_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from status where id='".$Id."'");
	}
	//Software in Asset
	function Softwares_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares ORDER BY name asc");
	}
	function Softwares_Select_ById($Conditions)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares WHERE ".$Conditions." ORDER BY name asc");
	}
	function Assets_Location()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location ORDER BY name asc");
	}
	function  Assets_Department()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department ORDER BY name asc");
	}	
?>