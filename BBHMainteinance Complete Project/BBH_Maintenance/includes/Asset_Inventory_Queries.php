<?php
	function Source_Make_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make order by id desc");
	}
	function Department_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department where biomedical_department='1'");
	}
	function Assets_Inventory_Insert($make_id,$model_id,$equipment_idname,$serialnumber,$equipmentid,$installdate,$warrantyperiod,$warranty_comments,$unitcost,$department_id,$acceptdate,$equipmentsupplier,$contactpersonno,$critical_equipment)
	{
		return mysqli_query($_SESSION['connection'],"insert into assets_inventory(id,make_id,model_id,equipment_idname,serialnumber,equipmentid,installdate,warrantyperiod,warranty_comments,unitcost,department_id,acceptdate,equipmentsupplier,contactpersonno,critical_equipment) values('','".$make_id."','".$model_id."','".$equipment_idname."','".$serialnumber."','".$equipmentid."','".date('Y-m-d',strtotime($installdate))."','".date('Y-m-d',strtotime($warrantyperiod))."','".$warranty_comments."','".$unitcost."','".$department_id."','".date('Y-m-d',strtotime($acceptdate))."','".$equipmentsupplier."','".$contactpersonno."','".$critical_equipment."')");
	}
	function Assets_Inventory_Update($Id,$make_id,$model_id,$equipment_idname,$serialnumber,$equipmentid,$installdate,$warrantyperiod,$warranty_comments,$unitcost,$department_id,$acceptdate,$equipmentsupplier,$contactpersonno,$critical_equipment)
	{
		return mysqli_query($_SESSION['connection'],"UPDATE assets_inventory SET make_id='".$make_id."',model_id='".$model_id."',equipment_idname='".$equipment_idname."', serialnumber='".$serialnumber."', equipmentid='".$equipmentid."', installdate='".date('Y-m-d',strtotime($installdate))."', warrantyperiod='".date('Y-m-d',strtotime($warrantyperiod))."',warranty_comments='".$warranty_comments."',unitcost='".$unitcost."',department_id='".$department_id."', acceptdate='".date('Y-m-d',strtotime($acceptdate))."', equipmentsupplier='".$equipmentsupplier."', contactpersonno='".$contactpersonno."', critical_equipment ='".$critical_equipment."'  WHERE id='".$Id."'");
	}
	function Assets_Inventory_Select_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE id='".$Id."'");
	}
	function Assets_Inventory_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM assets_inventory WHERE id='".$Id."'");
	}
	function Assets_Inventory_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory ORDER BY id DESC");
	}
	function Assets_Inventory_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function AssetInventory_Make_BYId($MakeId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_make Where id='".$MakeId."' ORDER BY make asc");
	}
	function AssetInventory_ModelById($ModelId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_model Where id='".$ModelId."' ORDER BY model asc");
	}
	function AssetInventory_EquipmentById($EquipmentId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment Where id='".$EquipmentId."' ORDER BY equipment asc");
	}
	function AssetsInventory_DepartmentrById($DepartmentId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM department Where id='".$DepartmentId."' ORDER BY name asc");
	}
	
	//Asset Inventory Status
	
	function Complaint_Get_Inspect()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM user where groupid='3'");
	}
	function AssetsInventory_Status_Insert()
	{
		return mysqli_query($_SESSION['connection'],"INSERT INTO assets_inventory_status(id,assetinventory_id,date,inspectby,fault,costinvolved,remark) Values('','".$_GET['equipmentid']."','".date('Y-m-d H:i:s',strtotime($_POST['date']))."','".$_POST['inspectby']."','".$_POST['fault']."','".$_POST['costinvolved']."','".$_POST['remark']."')");
	}
	function AssetsInventory_Status_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from assets_inventory_status where assetinventory_id='".$_GET['equipmentid']."' order by id desc");
	}
	function AssetsInventoryEquipment()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM biomedical_equipment WHERE id='".$_GET['equipmentid']."' ");
	}
	function Inspect_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"select * from user where id='".$Id."'");
	}
	function AssetsInventory_Status_Select_ByName()
	{
		if($_POST['equipment_id'] && !$_POST['department_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE equipmentid   like '".$_POST['equipment_id']."%'  order by id desc");
		else if($_POST['department_id'] && !$_POST['equipment_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE department_id  = '".$_POST['department_id']."%'  order by id desc");
		else if($_POST['department_id'] && $_POST['equipment_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE equipmentid   like '".$_POST['equipment_id']."%'  AND department_id  = '".$_POST['department_id']."'  order by id desc");
	}
	function AssetsInventory_Status_Select_ByNameBYLIMIT($Start ,$Limit)
	{
		if($_POST['equipment_id'] && !$_POST['department_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE equipmentid   like '".$_POST['equipment_id']."%'  order by id desc  Limit $Start, $Limit");
		else if($_POST['department_id'] && !$_POST['equipment_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE department_id  = '".$_POST['department_id']."%'  order by id desc  Limit $Start, $Limit");
		else if($_POST['department_id'] && $_POST['equipment_id'])
			return mysqli_query($_SESSION['connection'],"SELECT * FROM assets_inventory WHERE equipmentid   like '".$_POST['equipment_id']."%'  AND  department_id  = '".$_POST['department_id']."'  order by id desc  Limit $Start, $Limit");
	}
	
	// Biomedical  Complaint
	function AssetBiomedical_Select_All_Complaint($Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM complaint WHERE itemid='".$Id."' AND groupid='3' ");
	}
	/*function Assets_Insert($divisionid, $departmentid,$locationid,$itemid,$itemname,$itemdescription,$connectiontype,$purchasedat,$warrantydate,$amcperiod,$condemned,$standby,$softwareids,$ipaddress)
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
	function Assets_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM assets ORDER BY id DESC LIMIT $Start, $Limit");
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
	}*/
?>