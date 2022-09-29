	<?php 
	function Job_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM job ORDER BY id DESC");
	}
	function Job_Select_Count_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM job  ORDER BY id DESC");
	}
	function Job_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM job WHERE id='".$_GET['id']."'");
	}
	function Job_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM job WHERE name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function Job_Delete_ById($Id)
	{
		return mysqli_query($_SESSION['connection'],"DELETE FROM job WHERE id='".$Id."'");
	}
	function Job_Insert()
	{
		return mysqli_query($_SESSION['connection'],"insert into job values('','".date('Y-m-d')."', '".$_POST['order_id']."', '".$_POST['product_id']."', '".$_POST['totalorderquantity']."', '".$_POST['plannedquantity']."', '".$_POST['machine_id']."' , '".$_POST['productionhours']."','".$_POST['settingdays']."','".date('Y-m-d',strtotime($_POST['tentative_date']))."','".date('Y-m-d', strtotime($_POST['tentative_date']."+30 days"))."')");
	}
	function Job_Update()
	{
		return mysqli_query($_SESSION['connection'],"UPDATE job SET order_id='".$_POST['order_id']."', product_id='".$_POST['product_id']."', totalorderquantity='".$_POST['totalorderquantity']."', plannedquantity='".$_POST['plannedquantity']."', machine_id='".$_POST['machine_id']."',productionhours ='".$_POST['productionhours']."',settingdays ='".$_POST['settingdays']."',tentative_date ='".date('Y-m-d',strtotime($_POST['tentative_date']))."',tentative_enddate ='".date('Y-m-d', strtotime($_POST['tentative_date']."+30 days"))."' WHERE id='".$_POST['id']."'");
	}
	function Orderno_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `order`  ORDER BY id DESC");
	}
	function Products_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product  ORDER BY id DESC");
	}
	function Customers_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM customer  ORDER BY id DESC");
	}
	function Machines_Select_All()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM machine  ORDER BY id DESC");
	}	
	function Job_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM job  ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Select_Order_ById($OrderId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `order` WHERE id='".$OrderId."'");
	}
	function Select_DrawingNo_ById($DrawingNoId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM product WHERE id='".$DrawingNoId."'");
	}
	function Select_CustomerName_ById($CustomerNameId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM customer WHERE id='".$CustomerNameId."'");
	}
	function Select_MachineName_ById($MachineNameId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM machine WHERE id='".$MachineNameId."'");
	}		
	?>