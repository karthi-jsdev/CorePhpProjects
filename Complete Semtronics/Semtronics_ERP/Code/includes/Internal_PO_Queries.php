<?php
//Internal PO Queries
function Inhouse_Category()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_categories");
}
function Inhouse_Status()
{
	return mysqli_query($_SESSION['connection'],"SELECT * FROM inhouse_status");
}
function Stores_Selection()
{
	return mysqli_query($_SESSION['connection'],"select * from user where userrole_id='4' || userrole_id='8'");
}
function PO_Insertion()
{
	$_POST['inhouse_statusid']='1';
	return mysqli_query($_SESSION['connection'],"INSERT INTO internal_po(inhouse_categoryid,requirement_specification,quantity,cost,user,inhouse_statusid)
	values('".$_POST['inhouse_categoryid']."','".$_POST['requirement_specification']."','".$_POST['quantity']."','".$_POST['cost']."','".$_SESSION['id']."','".$_POST['inhouse_statusid']."')");
}
function Inhouse_Selection($Start,$Limit)
{
	if($_GET['status_id'])
		return mysqli_query($_SESSION['connection'],"select user.name as username,internal_po.id,inhouse_categories.name,inhouse_status.status,inhouse_categoryid,requirement_specification,quantity,cost,user,inhouse_statusid from internal_po 
						join inhouse_categories on inhouse_categories.id=internal_po.inhouse_categoryid
						join inhouse_status on inhouse_status.id=internal_po.inhouse_statusid
						join user on user.id=internal_po.user where inhouse_statusid='".$_GET['status_id']."' ORDER BY internal_po.id DESC LIMIT $Start,$Limit");
	else
		return mysqli_query($_SESSION['connection'],"select user.name as username,approval,internal_po.id,inhouse_categories.name,inhouse_status.status,inhouse_categoryid,requirement_specification,quantity,cost,user,inhouse_statusid from internal_po 
						join inhouse_categories on inhouse_categories.id=internal_po.inhouse_categoryid
						join inhouse_status on inhouse_status.id=internal_po.inhouse_statusid 
						join user on user.id=internal_po.user ORDER BY internal_po.id DESC LIMIT $Start,$Limit");
}
function Inhouse_Selection_ByCount()
{
	if($_GET['status_id'])
		return mysqli_query($_SESSION['connection'],"select count(*) as total from internal_po 
						join inhouse_categories on inhouse_categories.id=internal_po.inhouse_categoryid
						join inhouse_status on inhouse_status.id=internal_po.inhouse_statusid
						join user on user.id=internal_po.user where inhouse_statusid='".$_GET['status_id']."' ORDER BY internal_po.id DESC");
	else
		return mysqli_query($_SESSION['connection'],"select count(*) as total from internal_po 
						join inhouse_categories on inhouse_categories.id=internal_po.inhouse_categoryid
						join inhouse_status on inhouse_status.id=internal_po.inhouse_statusid 
						join user on user.id=internal_po.user ORDER BY internal_po.id DESC");
}
function Inhouse_CategoryEdit()
{
	return mysqli_query($_SESSION['connection'],"select status,inhouse_status.id,internal_po.id from inhouse_status join internal_po on inhouse_statusid = inhouse_status.id where internal_po.id='".$_GET['id']."'");
}
function Inhouse_Edit()
{
	return mysqli_query($_SESSION['connection'],"select internal_po.id,inhouse_categories.name,inhouse_status.status,inhouse_categoryid,requirement_specification,quantity,cost,user,inhouse_statusid from internal_po 
						join inhouse_categories on inhouse_categories.id=internal_po.inhouse_categoryid
						join inhouse_status on inhouse_status.id=internal_po.inhouse_statusid where internal_po.id='".$_GET['id']."' ORDER BY internal_po.id DESC");
}
function Inhouse_Update()
{
	if($_GET['action']=='edit')
	{
		return mysqli_query($_SESSION['connection'],"Update internal_po SET inhouse_statusid='".$_POST['inhouse_statusid']."' where id='".$_POST['id']."'");
	}
	else
	{
		return mysqli_query($_SESSION['connection'],"Update internal_po SET inhouse_categoryid='".$_POST['inhouse_categoryid']."',quantity='".$_POST['quantity']."',cost='".$_POST['cost']."',requirement_specification='".$_POST['requirement_specification']."' where id='".$_POST['id']."'");
}}
function Inhouse_Delete()
{
	mysqli_query($_SESSION['connection'],"DELETE from internal_po join inhouse_status on inhouse_statusid=inhouse_status.id where internal_po.id='".$_GET['id']."'");
	mysqli_query($_SESSION['connection'],"DELETE from internal_po where internal_po.id='".$_GET['id']."'");
}
function All_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as alldata from internal_po");
}
function NotApproved_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as napp from internal_po where inhouse_statusid='1'");
}
function Approved_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as app from internal_po where inhouse_statusid='2'");
}
function Issued_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as issued from internal_po where inhouse_statusid='3'");
}
function NotIssued_Count()
{
	return mysqli_query($_SESSION['connection'],"SELECT count(*) as notissued from internal_po where inhouse_statusid='4'");
}
function Management_Approval()
{
	if($_POST['approve'])
		return mysqli_query($_SESSION['connection'],"INSERT INTO internal_po (approval) values ('".$userid['id']."')");
}
function App_Disable()
{
	return mysqli_query($_SESSION['connection'],"select * from internal_po join approver on approver.user=approval");
}
?>