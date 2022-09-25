<?php
	//Master : Biomedicalassets
	function Biomedical_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalassets WHERE id='".$Id."'");
	}
	function Biomedical_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM biomedicalassets WHERE id='".$Id."'");
	}
	function Biomedical_Insert($divisionid, $departmentid,$locationid,$itemid,$itemname,$itemdescription,$purchasedat,$warrantydate,$amcperiod,$condemned,$standby)
	{
		if($locationid)
			return mysqli_query($_SESSION['connection'],"insert into biomedicalassets(divisionid,departmentid, locationid,itemid,itemname,itemdescription,purchasedat,warrantydate,amcperiod,condemned,standby) values('".$divisionid."', '".$departmentid."','".$locationid."','".$itemid."','".$itemname."','".$itemdescription."','".date('Y-m-d',strtotime($purchasedat))."','".date('Y-m-d',strtotime($warrantydate))."','".$amcperiod."','".$condemned."','".$standby."')");
		else
			return mysqli_query($_SESSION['connection'],"insert into biomedicalassets(divisionid,departmentid,itemid,itemname,itemdescription,purchasedat,warrantydate,amcperiod,condemned,standby) values('".$divisionid."', '".$departmentid."','".$itemid."','".$itemname."','".$itemdescription."','".date('Y-m-d',strtotime($purchasedat))."','".date('Y-m-d',strtotime($warrantydate))."','".$amcperiod."','".$condemned."','".$standby."')");
	}
	function Biomedical_Update($Id,$divisionid,$departmentid,$locationid,$itemid,$itemname,$itemdescription,$purchasedat,$warrantydate,$amcperiod,$condemned,$standby)
	{
		if($locationid)
			return mysqli_query($_SESSION['connection'],"UPDATE biomedicalassets SET divisionid='".$divisionid."',departmentid='".$departmentid."',locationid='".$locationid."', itemid='".$itemid."', itemname='".$itemname."', itemdescription='".$itemdescription."',purchasedat='".date('Y-m-d',strtotime($purchasedat))."',warrantydate='".date('Y-m-d',strtotime($warrantydate))."', amcperiod='".$amcperiod."', condemned='".$condemned."', standby='".$standby."' WHERE id='".$Id."'");
		else
			return mysqli_query($_SESSION['connection'],"UPDATE biomedicalassets SET divisionid='".$divisionid."',departmentid='".$departmentid."', itemid='".$itemid."', itemname='".$itemname."', itemdescription='".$itemdescription."',purchasedat='".date('Y-m-d',strtotime($purchasedat))."',warrantydate='".date('Y-m-d',strtotime($warrantydate))."', amcperiod='".$amcperiod."', condemned='".$condemned."', standby='".$standby."' WHERE id='".$Id."'");
	}
	function Biomedical_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalassets ORDER BY id DESC");
	}
	function Biomedical_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalassets ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Biomedical_Select_Division()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division ORDER BY name asc");
	}
	function Biomedical_Get_DepartmentById($DivisionId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where divisionid = '".$DivisionId."' ORDER BY name asc");
	}
	function Biomedical_Get_LocationById($LocationId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where departmentid = '".$LocationId."' ORDER BY name asc");
	}
	function Biomedical_Select_item_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem ORDER BY name asc");
	}
	function Biomedical_Division_BYId($DivisionId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM division Where id='".$DivisionId."' ORDER BY name asc");
	}
	function Biomedical_DepartmentById($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where id = '".$DepartmentId."' ORDER BY name asc");
	}
	function Biomedical_LocationById($LocationId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location where id = '".$LocationId."' ORDER BY name asc");
	}
	function Biomedical_itemById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalitem where id = '".$Id."' ORDER BY id asc");
	}
	function Biomedical_Select_All_Complaint($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint where itemid = '".$Id."' ORDER BY id DESC");
	}
	function Biomedical_Select_All_Name($name)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalassets where itemname = '".$name."' ORDER BY id DESC");
	}
	// Biomedical Asset Status
	function Biomedical_Assets_Status_Insert($assetid, $assetdescription,$statusid)
	{
		return mysqli_query($_SESSION['connection'],"insert into biomedicalassetstatus(biomedicalassetid,biomedicalassetdescription,statusid,datetime) values('".$assetid."', '".$assetdescription."','".$statusid."','".date('Y-m-d H:i:s')."')");
	}	
	function Biomedical_Assets_Status_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from biomedicalassetstatus where biomedicalassetid='".$Id."' order by id desc");
	}
	function Biomedical_Assets_Status_Select_ByItemName($Name,$Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"select * from biomedicalassets where itemname like '".$Name."%' or itemname like '% ".$Name."'  or itemname like '% ".$Name." %' order by id desc Limit $Start, $Limit");
	}
		function Biomedical_Assets_Status_Select_ByName($Name)
	{
		return mysqli_query($_SESSION['connection'],"select * from biomedicalassets where itemname like '".$Name."%' or itemname  like '% ".$Name."'  or itemname like '% ".$Name." %'  order by id desc");
	}
	function Biomedical_Complaint_Get_Status()
	{
		return mysqli_query($_SESSION['connection'],"select * from status WHERE id<>8 ");
	}
	function Biomedical_Complaint_Get_Status_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from status where id='".$Id."'");
	}
	function Biomedical_Complaint_Get_biomedicalStatus_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from  biomedicalassetstatus where id='".$Id."'");
	}
	function Biomedical_Assets_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedicalassets ORDER BY id DESC LIMIT $Start, $Limit");
	}
	//Software in Asset
	/*function Softwares_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares ORDER BY name asc");
	}
	function Softwares_Select_ById($Conditions)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM softwares WHERE ".$Conditions." ORDER BY name asc");
	}*/
	function Biomedical_Location()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM location ORDER BY name asc");
	}
	function  Biomedical_Department()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department ORDER BY name asc");
	}	
?>