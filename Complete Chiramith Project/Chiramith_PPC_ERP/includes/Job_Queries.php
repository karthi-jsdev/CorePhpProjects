	<?php 
	function Job_Select_All()
	{
		return mysql_query("SELECT * FROM job ORDER BY id DESC");
	}
	function Job_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM job  ORDER BY id DESC");
	}
	function Job_Select_ById()
	{
		return mysql_query("SELECT * FROM job WHERE id='".$_GET['id']."'");
	}
	function Job_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM job WHERE name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function Job_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM job WHERE id='".$Id."'");
	}
	function Job_Insert()
	{
		return mysql_query("insert into job values('','".date('Y-m-d')."', '".$_POST['order_id']."', '".$_POST['product_id']."', '".$_POST['totalorderquantity']."', '".$_POST['plannedquantity']."', '".$_POST['machine_id']."' , '".$_POST['productionhours']."','".$_POST['settingdays']."','".date('Y-m-d',strtotime($_POST['tentative_date']))."','".date('Y-m-d', strtotime($_POST['tentative_date']."+30 days"))."')");
	}
	function Job_Update()
	{
		return mysql_query("UPDATE job SET order_id='".$_POST['order_id']."', product_id='".$_POST['product_id']."', totalorderquantity='".$_POST['totalorderquantity']."', plannedquantity='".$_POST['plannedquantity']."', machine_id='".$_POST['machine_id']."',productionhours ='".$_POST['productionhours']."',settingdays ='".$_POST['settingdays']."',tentative_date ='".date('Y-m-d',strtotime($_POST['tentative_date']))."',tentative_enddate ='".date('Y-m-d', strtotime($_POST['tentative_date']."+30 days"))."' WHERE id='".$_POST['id']."'");
	}
	function Orderno_Select_All()
	{
		return mysql_query("SELECT * FROM `order`  ORDER BY id DESC");
	}
	function Products_Select_All()
	{
		return mysql_query("SELECT * FROM product  ORDER BY id DESC");
	}
	function Customers_Select_All()
	{
		return mysql_query("SELECT * FROM customer  ORDER BY id DESC");
	}
	function Machines_Select_All()
	{
		return mysql_query("SELECT * FROM machine  ORDER BY id DESC");
	}	
	function Job_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM job  ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Select_Order_ById($OrderId)
	{
		return mysql_query("SELECT * FROM `order` WHERE id='".$OrderId."'");
	}
	function Select_DrawingNo_ById($DrawingNoId)
	{
		return mysql_query("SELECT * FROM product WHERE id='".$DrawingNoId."'");
	}
	function Select_CustomerName_ById($CustomerNameId)
	{
		return mysql_query("SELECT * FROM customer WHERE id='".$CustomerNameId."'");
	}
	function Select_MachineName_ById($MachineNameId)
	{
		return mysql_query("SELECT * FROM machine WHERE id='".$MachineNameId."'");
	}		
	?>