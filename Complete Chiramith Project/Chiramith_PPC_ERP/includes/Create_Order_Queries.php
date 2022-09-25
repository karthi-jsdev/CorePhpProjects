<?php 
	function Create_Order_Insert()
	{
		return mysql_query("insert into `order`(id,number,customer_id,quantity,order_date) values('','".$_POST['number']."', '".$_POST['customer_id']."','".$_POST['quantity']."','".date('Y-m-d H:i:s')."')");
	}
	function Create_Order_Select_ById()
	{
		return mysql_query("SELECT * FROM `order` WHERE id='".$_GET['id']."'");
	}
	function Create_Order_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM `order` WHERE id='".$Id."'");
	}
	function Create_Order_Select_ByName()
	{
		return mysql_query("SELECT * FROM `order` WHERE number='".$_POST['number']."'");
	}
	function Create_Order_Select_ByNameId ()
	{
		return mysql_query("SELECT * FROM `order` WHERE number='".$_POST['number']."' && id!='".$_POST['id']."'");
	}
	function Create_Order_Update()
	{
		return mysql_query("UPDATE `order` SET number='".$_POST['number']."', customer_id='".$_POST['customer_id']."',quantity='".$_POST['quantity']."' WHERE id='".$_POST['id']."'");
	}
	function Create_Order_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM `order` ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Create_Order_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM `order` ORDER BY id DESC");
	}
	function Customerss_Select_All()
	{
		return mysql_query("SELECT * FROM customer ORDER BY id DESC");
	}
	function Customers_Select_ById($Id)
	{
		return mysql_query("SELECT * FROM customer WHERE id='".$Id."'");
	}
	
	//Job Order Queries
	function Insert_Joborder()
	{
		if($Joborder = mysql_fetch_array(mysql_query("SELECT id FROM `order` where number ='".$_POST['number']."'")))
			mysql_query("INSERT into job (id,createdate,order_id,product_id,totalorderquantity,plannedquantity,machine_id,productionhours,settingdays,tentative_date,tentative_enddate) values('','".date('Y-m-d')."','".$Joborder['id']."','".$_POST['product_id']."','".$_POST['totalorderquantity']."','".$_POST['plannedquantity']."','".$_POST['machine_id']."','".$_POST['productionhours']."','".$_POST['settingdays']."','".date('Y-m-d', strtotime($_POST['tentative_date']))."','".date('Y-m-d', strtotime($_POST['tentative_enddate']))."')");
		else
		{
			mysql_query("INSERT into `order` (id,number,customer_id,order_date) values ('','".$_POST['number']."','".$_POST['customer_id']."','".date('Y-m-d H:i:s')."')");
			$Joborderlast = mysql_fetch_array(mysql_query("SELECT id FROM `order` where number='".$_POST['number']."' and customer_id='".$_POST['customer_id']."' order by id desc limit 0,1 "));
			mysql_query("INSERT into job (id,createdate,order_id,product_id,totalorderquantity,plannedquantity,machine_id,productionhours,settingdays,tentative_date,tentative_enddate) values('','".date('Y-m-d')."','".$Joborderlast['id']."','".$_POST['product_id']."','".$_POST['totalorderquantity']."','".$_POST['plannedquantity']."','".$_POST['machine_id']."','".$_POST['productionhours']."','".$_POST['settingdays']."','".date('Y-m-d', strtotime($_POST['tentative_date']))."','".date('Y-m-d', strtotime($_POST['tentative_enddate']))."')");
		}
	}
	function Count_All_Joborder_ById()
	{
		return mysql_query("SELECT COUNT(`order`.id) as total FROM `order` JOIN job ON  `order`.id = job.order_id WHERE order.number='".$_GET['number']."'");
	}
	function Select_Joborder_ByLimit($Start,$Limit)
	{
		return mysql_query("SELECT section.name as section_name, `order`.number, `order`.customer_id, job.order_id, job.product_id, job.totalorderquantity, job.plannedquantity, job.machine_id, job.id, job.productionhours, job.settingdays, job.tentative_date,job.tentative_enddate, customer.name,product.drawing_number,job.reason,machine.machine_number
		FROM `order` JOIN job ON order.id = job.order_id
		JOIN customer ON order.customer_id = customer.id
		JOIN product ON product.id = job.product_id
		JOIN machine ON machine.id = job.machine_id
		JOIN machine_assignment ON machine_assignment.machine_id=machine.id
		JOIN location ON location.id=machine_assignment.location_id
		LEFT JOIN section ON section.id=location.section_id
		WHERE `order`.number='".$_GET['number']."' ORDER BY order.id DESC LIMIT $Start,$Limit");
	}
	function Count_All_Order_ById()
	{
		return mysql_query("SELECT COUNT(distinct(`order`.id)) as total FROM `order` LEFT JOIN job ON `order`.id = job.order_id");
	}
	function Count_All_Order_ByNameandNumber()
	{
		return mysql_query("SELECT COUNT(*) as total FROM(SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (customer.name like '%".$_GET['name']."' || customer.name like '".$_GET['name']."%' || customer.name like '%".$_GET['name']."%') && (`order`.number like '%".$_GET['number']."' || `order`.number like '".$_GET['number']."%' || `order`.number like '%".$_GET['number']."%') GROUP BY `order`.id) as Temp");
	}
	function Count_All_Order_ByName()
	{
		return mysql_query("SELECT COUNT(*) as total FROM(SELECT COUNT(`order`.number) as total FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (customer.name like '%".$_GET['name']."' || customer.name like '".$_GET['name']."%' || customer.name like '%".$_GET['name']."%') GROUP BY `order`.id) as Temp");
	}
	function Count_All_Order_ByNumber()
	{
		return mysql_query("SELECT COUNT(*) as total FROM(SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (`order`.number like '%".$_GET['number']."' || `order`.number like '".$_GET['number']."%' || `order`.number like '%".$_GET['number']."%')  GROUP BY `order`.id) as Temp");
	}
	function Select_All_Order_ByLimit($Start,$Limit)
	{
		if($_GET['name'] && $_GET['number'])
			return mysql_query("SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (customer.name like '%".$_GET['name']."' || customer.name like '".$_GET['name']."%' || customer.name like '%".$_GET['name']."%') && (`order`.number like '%".$_GET['number']."' || `order`.number like '".$_GET['number']."%' || `order`.number like '%".$_GET['number']."%') GROUP BY `order`.id");
		else if($_GET['name'])
			return mysql_query("SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (customer.name like '%".$_GET['name']."' || customer.name like '".$_GET['name']."%' || customer.name like '%".$_GET['name']."%') GROUP BY `order`.id");
		else if($_GET['number'])
			return mysql_query("SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (`order`.number like '%".$_GET['number']."' || `order`.number like '".$_GET['number']."%' || `order`.number like '%".$_GET['number']."%')  GROUP BY `order`.id");
		else
			return mysql_query("SELECT `order`.id,`order`.number,`order`.customer_id,`job`.product_id,`job`.totalorderquantity,`job`.plannedquantity,`job`.machine_id,`job`.productionhours,`job`.settingdays,`job`.tentative_date,`job`.tentative_enddate,customer.name FROM `order` LEFT JOIN job ON `order`.id = job.order_id JOIN customer ON customer.id =`order`.customer_id WHERE (customer.name like '%".$_GET['name']."' || customer.name like '".$_GET['name']."%' || customer.name like '%".$_GET['name']."%') || (`order`.number like '%".$_GET['number']."' || `order`.number like '".$_GET['number']."%' || `order`.number like '%".$_GET['number']."%') GROUP BY `order`.id");
	}
	function Select_Customers($Id)
	{
		return mysql_query("SELECT * FROM customer where id='".$Id."'");
	}
	
	function Select_Products($Id)
	{
		return mysql_query("SELECT * FROM product where id='".$Id."'");
	}
	function JobEdit_Selected($Id,$jobid)
	{
		return mysql_query("SELECT `order`.number,`order`.customer_id,job.product_id,job.totalorderquantity,job.plannedquantity,job.machine_id,job.machine_id,job.productionhours,job.settingdays,job.tentative_date,job.tentative_enddate FROM `order` JOIN job ON `order`.id = job.`order_id` where number='".$Id."' and job.id='".$jobid."'");
	}
	function JobDelete_Selected($Id)
	{
		return mysql_query("DELETE FROM job where id='".$Id."'");
	}
	function Job_All_Update_ById($Id)
	{
		if($_POST['actions']=='sub' && $_POST['counter'])
			return mysql_query("UPDATE job SET totalorderquantity='".$_POST['totalorderquantity']."',plannedquantity ='".$_POST['plannedquantity']."',productionhours='".$_POST['productionhours']."',settingdays='".$_POST['settingdays']."',tentative_date='".date('Y-m-d', strtotime($_POST['tentative_date']))."',tentative_enddate='".date('Y-m-d', strtotime($_POST['tentative_enddate']."-".$_POST['counter']." days"))."',reason ='".$_POST['reason']."' where id='".$Id."'");
		else if($_POST['actions']=='add' && $_POST['counter'])
			return mysql_query("UPDATE job SET totalorderquantity='".$_POST['totalorderquantity']."',plannedquantity ='".$_POST['plannedquantity']."',productionhours='".$_POST['productionhours']."',settingdays='".$_POST['settingdays']."',tentative_date='".date('Y-m-d', strtotime($_POST['tentative_date']))."',tentative_enddate='".date('Y-m-d', strtotime($_POST['tentative_enddate']."+".$_POST['counter']." days"))."',reason ='".$_POST['reason']."' where id='".$Id."'");
		else
			return mysql_query("UPDATE job SET totalorderquantity='".$_POST['totalorderquantity']."',plannedquantity ='".$_POST['plannedquantity']."',productionhours='".$_POST['productionhours']."',settingdays='".$_POST['settingdays']."',tentative_date='".date('Y-m-d', strtotime($_POST['tentative_date']))."' where id='".$Id."' ");
	}
	function Customers_Select_Orderno($Number)
	{
		return mysql_query("SELECT customer.name,customer.id  FROM `order` JOIN customer ON `order`.customer_id = customer.id where number='".$Number."'");
	}
	function Machine_Select_Orderno()
	{
		//return mysql_query("SELECT machine.id, machine.machine_number FROM machine where machine.id not in(select `job`.machine_id from job  WHERE (job.tentative_date >='".date('Y-m-d', strtotime($_GET['startdate']))."' and job.tentative_enddate <='".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_date between '".date('Y-m-d', strtotime($_GET['startdate']))."' and '".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_enddate between '".date('Y-m-d', strtotime($_GET['startdate']))."' and '".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_date <='".date('Y-m-d', strtotime($_GET['startdate']))."' and job.tentative_enddate >='".date('Y-m-d', strtotime($_GET['enddate']))."')) ORDER BY machine.machine_number");
		return mysql_query("SELECT machine.id, machine.machine_number, section.name as section_name
		FROM machine
		JOIN machine_assignment ON machine_assignment.machine_id=machine.id
		JOIN location ON location.id=machine_assignment.location_id
		LEFT JOIN section ON section.id=location.section_id
		where machine.id not in(select `job`.machine_id from job  WHERE (job.tentative_date >='".date('Y-m-d', strtotime($_GET['startdate']))."' and job.tentative_enddate <='".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_date between '".date('Y-m-d', strtotime($_GET['startdate']))."' and '".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_enddate between '".date('Y-m-d', strtotime($_GET['startdate']))."' and '".date('Y-m-d', strtotime($_GET['enddate']))."') || (job.tentative_date <='".date('Y-m-d', strtotime($_GET['startdate']))."' and job.tentative_enddate >='".date('Y-m-d', strtotime($_GET['enddate']))."'))
		GROUP BY (machine.machine_number) ORDER BY machine.machine_number");
	}
	function TOtalJobInOrder($Number)
	{
		return mysql_query("SELECT COUNT(`order`.id) as total,MIN(tentative_date) as mindate,MAX(tentative_enddate) as maxdate FROM `order` JOIN job ON  order.id = job.order_id WHERE order.number='".$Number."'");
	}
?>