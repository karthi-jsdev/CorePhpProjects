<?php
	//Reports
	function Report_Total_Rows()
	{
		if($_GET['cust_id'] || $_GET['order_id'] || $_GET['description'] || $_GET['drawing_number'] || $_GET['grade'] || $_GET['material_size'] || $_GET['machine'] || $_GET['tools'] || $_GET['specification'])
		{
			$_POST['cust_id'] = $_GET['cust_id'];
			$_POST['order_id'] = $_GET['order_id'];
			$_POST['description'] = $_GET['description'];
			$_POST['drawing_number'] = $_GET['drawing_number'];
			$_POST['grade'] = $_GET['grade'];
			$_POST['material_size'] = $_GET['material_size'];
			$_POST['machine'] = $_GET['machine'];
			$_POST['specification'] = $_GET['specification'];
			$_POST['tools'] = $_GET['tools'];
		}
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from customer 
		inner join `order` on customer.id = `order`.customer_id
		inner join job on job.order_id = `order`.id
		inner join product on job.product_id = product.id
		inner join machine on machine.id=job.machine_id
		inner join machine_specification on machine.machine_specification_id = machine_specification.id
		inner join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id
		WHERE".str_replace("=''", "!=''",
		"`order`.customer_id='".$_POST['cust_id']."'&&
		job.order_id='".$_POST['order_id']."'&&
		product.description='".$_POST['description']."'&&
		product.drawing_number='".$_POST['drawing_number']."'&&
		product.grade='".$_POST['grade']."'&&
		product.material_size='".$_POST['material_size']."'&&
		machine.machine_specification_id='".$_POST['specification']."'&&
		machine.machine_turningtools_id='".$_POST['tools']."'&&
		job.machine_id='".$_POST['machine']."'"));
	}
	
	function Report_Data_ByLimit($Start,$Limit)
	{
		if($_GET['cust_id'] || $_GET['order_id'] || $_GET['description'] || $_GET['drawing_number'] || $_GET['grade'] || $_GET['material_size'] || $_GET['machine'] || $_GET['tools'] || $_GET['specification'])
		{
			$_POST['cust_id'] = $_GET['cust_id'];
			$_POST['order_id'] = $_GET['order_id'];
			$_POST['description'] = $_GET['description'];
			$_POST['drawing_number'] = $_GET['drawing_number'];
			$_POST['grade'] = $_GET['grade'];
			$_POST['material_size'] = $_GET['material_size'];
			$_POST['specification'] = $_GET['specification'];
			$_POST['tools'] = $_GET['tools'];
			$_POST['machine'] = $_GET['machine'];
		}
		return mysqli_query($_SESSION['connection'],"SELECT job.tentative_date,job.tentative_enddate,customer.name as name,`order`.number as number,product.`description` as description,product.`drawing_number`as draw_number,
		product.`grade`as grade,product.`material_size`as material_size,machine_specification.specification as specification,machine_turningtools.turningtool as tool,
		machine.machine_number as machineno from customer 
		inner join `order` on customer.id = `order`.customer_id
		inner join job on job.order_id = `order`.id
		inner join product on job.product_id = product.id
		inner join machine on machine.id=job.machine_id
		inner join machine_specification on machine.machine_specification_id = machine_specification.id
		inner join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id 
		WHERE".str_replace("=''", "!=''",
		"`order`.customer_id='".$_POST['cust_id']."'&&
		job.order_id='".$_POST['order_id']."'&&
		product.description='".$_POST['description']."'&&
		product.drawing_number='".$_POST['drawing_number']."'&&
		product.grade='".$_POST['grade']."'&&
		product.material_size='".$_POST['material_size']."'&&
		machine.machine_specification_id='".$_POST['specification']."'&&
		machine.machine_turningtools_id='".$_POST['tools']."'&&
		job.machine_id='".$_POST['machine']."'LIMIT $Start,$Limit"));
	}
	function Report_Data_Download()
	{
		if($_GET['cust_id'] || $_GET['order_id'] || $_GET['description'] || $_GET['drawing_number'] || $_GET['grade'] || $_GET['material_size'] || $_GET['machine'] || $_GET['tools'] || $_GET['specification'])
		{
			$_POST['cust_id'] = $_GET['cust_id'];
			$_POST['order_id'] = $_GET['order_id'];
			$_POST['description'] = $_GET['description'];
			$_POST['drawing_number'] = $_GET['drawing_number'];
			$_POST['grade'] = $_GET['grade'];
			$_POST['material_size'] = $_GET['material_size'];
			$_POST['specification'] = $_GET['specification'];
			$_POST['tools'] = $_GET['tools'];
			$_POST['machine'] = $_GET['machine'];
		}
		return "SELECT customer.name as name,`order`.number as number,
		product.`description` as description,product.`drawing_number`as draw_number,
		product.`grade`as grade,product.`material_size`as material_size,machine.machine_number as machineno,
		machine_specification.specification as specification,
		machine_turningtools.turningtool as tool,
		DATE_FORMAT(job.tentative_date,'%d-%m-%Y'),DATE_FORMAT(job.tentative_enddate,'%d-%m-%Y') from customer
		inner join `order` on customer.id = `order`.customer_id
		inner join job on job.order_id = `order`.id
		inner join product on job.product_id = product.id
		inner join machine on machine.id=job.machine_id
		inner join machine_specification on machine.machine_specification_id = machine_specification.id
		inner join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id 
		WHERE".str_replace("=''", "!=''",
		"`order`.customer_id='".$_POST['cust_id']."'&&
		job.order_id='".$_POST['order_id']."'&&
		product.description='".$_POST['description']."'&&
		product.drawing_number='".$_POST['drawing_number']."'&&
		product.grade='".$_POST['grade']."'&&
		product.material_size='".$_POST['material_size']."'&&
		machine.machine_specification_id='".$_POST['specification']."'&&
		machine.machine_turningtools_id='".$_POST['tools']."'&&
		job.machine_id='".$_POST['machine']."'");
	}
	function Report_Data_Download_Excel()
	{
		if($_GET['cust_id'] || $_GET['order_id'] || $_GET['description'] || $_GET['drawing_number'] || $_GET['grade'] || $_GET['material_size'] || $_GET['machine'] || $_GET['tools'] || $_GET['specification'])
		{
			$_POST['cust_id'] = $_GET['cust_id'];
			$_POST['order_id'] = $_GET['order_id'];
			$_POST['description'] = $_GET['description'];
			$_POST['drawing_number'] = $_GET['drawing_number'];
			$_POST['grade'] = $_GET['grade'];
			$_POST['material_size'] = $_GET['material_size'];
			$_POST['specification'] = $_GET['specification'];
			$_POST['tools'] = $_GET['tools'];
			$_POST['machine'] = $_GET['machine'];
		}
		return mysqli_query($_SESSION['connection'],"SELECT job.tentative_date,job.tentative_enddate,customer.name as name,`order`.number as number,product.`description` as description,product.`drawing_number`as draw_number,
		product.`grade`as grade,product.`material_size`as material_size,machine_specification.specification as specification,machine_turningtools.turningtool as tool,
		machine.machine_number as machineno from customer 
		inner join `order` on customer.id = `order`.customer_id
		inner join job on job.order_id = `order`.id
		inner join product on job.product_id = product.id
		inner join machine on machine.id=job.machine_id
		inner join machine_specification on machine.machine_specification_id = machine_specification.id
		inner join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id 
		WHERE".str_replace("=''", "!=''",
		"`order`.customer_id='".$_POST['cust_id']."'&&
		job.order_id='".$_POST['order_id']."'&&
		product.description='".$_POST['description']."'&&
		product.drawing_number='".$_POST['drawing_number']."'&&
		product.grade='".$_POST['grade']."'&&
		product.material_size='".$_POST['material_size']."'&&
		machine.machine_specification_id='".$_POST['specification']."'&&
		machine.machine_turningtools_id='".$_POST['tools']."'&&
		job.machine_id='".$_POST['machine']."'"));
	}
	function Customer()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM customer");
	}
	function Order()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `order`");;
	}
	function Machine()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM machine");
	}
	function Product()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM `product`");
	}
	function MachineTools()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM machine_turningtools");
	}
	function MachineSpecification()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM machine_specification");
	}
	function Customer_Report()
	{
		return mysqli_query($_SESSION['connection'],"SELECT customer.name AS name, customer.id AS customer_id, `order`.id AS order_id, `order`.number AS number, 
		product.id AS product_id, product.`description` AS description, product.`drawing_number` AS draw_number, product.`grade` AS grade,product.`material_size`as material_size,
		machine.id AS machine_id, machine.machine_number AS machineno,machine_specification.id AS machinespec_id, 
		machine_specification.specification AS specification, machine_turningtools.id AS machineturn_id,machine_turningtools.turningtool AS tool
		FROM customer
		inner JOIN `order` ON customer.id = `order`.customer_id
		inner JOIN job ON job.order_id = `order`.id
		inner JOIN product ON job.product_id = product.id
		inner JOIN machine ON machine.id = job.machine_id
		inner JOIN machine_specification ON machine.machine_specification_id = machine_specification.id
		inner JOIN machine_turningtools ON machine.machine_turningtools_id = machine_turningtools.id 
		WHERE ".str_replace("=''", "!=''",
		"`order`.customer_id='".$_GET['cust_id']."'&&
		job.order_id='".$_GET['order_id']."'&&
		product.description='".$_GET['description']."'&&
		product.drawing_number='".$_GET['drawing_number']."'&&
		product.grade='".$_GET['grade']."'&&
		product.material_size='".$_GET['material_size']."'&&
		machine.machine_specification_id='".$_GET['specification']."'&&
		machine.machine_turningtools_id='".$_GET['tools']."'&&
		job.machine_id='".$_GET['machine']."'"));
	}
	function Section_Report()
	{
		return mysqli_query($_SESSION['connection'],"SELECT section.name as sectionname, customer.name AS name, customer.id AS customer_id, `order`.id AS order_id, `order`.number AS number, 
		product.id AS product_id, product.`description` AS description, product.`drawing_number` AS draw_number
		FROM customer
		inner JOIN `order` ON customer.id = `order`.customer_id
		inner JOIN job ON job.order_id = `order`.id
		inner JOIN product ON job.product_id = product.id
		inner JOIN machine ON machine.id = job.machine_id
		inner JOIN machine_assignment ON machine_assignment.machine_id = machine.id
		inner JOIN location ON machine_assignment.location_id = location.id
		inner JOIN section ON location.section_id = section.id
		WHERE ".str_replace("=''", "!=''",
		"`order`.customer_id='".$_POST['cust_id']."'&&
		job.order_id='".$_POST['order_id']."'&&
		product.description='".$_POST['description']."'&&
		product.drawing_number='".$_POST['drawing_number']."'&&
		section.id='".$_POST['sec_id']."'"));
	}
	
	#Machine Availability
	function Machine_Availability_By_Count()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from machine 
		left join job on(job.machine_id=machine.id)
		join machine_specification on machine.machine_specification_id=machine_specification.id
		join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id
		join machine_make on machine.machine_make_id = machine_make.id
		join machine_assignment on machine_assignment.machine_id = machine.id
		where job.machine_id is null OR ((job.tentative_enddate < curdate()) OR (job.tentative_enddate < '".$_POST['tentative_enddate']."'))");
	}
	function Machine_Availability($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT distinct machine_specification.specification,machine.machine_number,machine_turningtools.turningtool,machine_assignment.location_id,machine_make.makeid from machine 
		left join job on(job.machine_id=machine.id)
		join machine_specification on machine.machine_specification_id=machine_specification.id
		join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id
		join machine_make on machine.machine_make_id = machine_make.id
		join machine_assignment on machine_assignment.machine_id = machine.id
		where job.machine_id is null OR ((job.tentative_enddate < curdate()) OR (job.tentative_enddate < '".$_POST['tentative_enddate']."' ))LIMIT $Start,$Limit");
	}
	/*function Machine_Near_Future_By_Count()
	{
		return mysqli_query($_SESSION['connection'],"select  from machine where machine.id in(SELECT job.machine_id from job where job.tentative_enddate > '".$_POST['tentative_enddate']."' and job.tentative_enddate>curdate())");
		return mysqli_query($_SESSION['connection'],"select count(*) as total from machine where machine.id in(SELECT job.machine_id from job where job.tentative_enddate >'".$_POST['tentative_enddate']."')");
	}*/
	function Machine_Near_Future()
	{
		return mysqli_query($_SESSION['connection'],"select DISTINCT machine.id,machine.machine_number,machine_specification.specification,machine_turningtools.turningtool,machine_assignment.location_id,machine_make.makeid,DATE_FORMAT(tentative_enddate,'%d-%m-%Y')as tentative_enddate from machine 
		join machine_specification on machine.machine_specification_id = machine_specification.id
		join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id
		join machine_make on machine.machine_make_id = machine_make.id
		join machine_assignment on machine_assignment.machine_id = machine.id
		join job on job.machine_id=machine.id where ((job.machine_id is null) OR (job.tentative_enddate >= CURDATE() and job.tentative_enddate >= '".$_POST['tentative_enddate']."'))ORDER BY job.tentative_enddate ASC");
	}
		
	#Excel Output
	function Report_Customer()
	{
		return mysqli_query($_SESSION['connection'],"select customer.name from customer where customer.id='".$_GET['cust_id']."'");
	}
	function Report_Order()
	{
		return mysqli_query($_SESSION['connection'],"select `order`.number from `order` where `order`.id='".$_GET['order_id']."'");
	}
	function Report_Description()
	{
		return mysqli_query($_SESSION['connection'],"select `product`.description from `product` where `product`.description='".$_GET['description']."'");
	}
	function Report_Drawing_number()
	{
		return mysqli_query($_SESSION['connection'],"select `product`.drawing_number from `product` where `product`.drawing_number='".$_GET['drawing_number']."'");
	}
	function Report_Grade()
	{
		return mysqli_query($_SESSION['connection'],"select `product`.grade from `product` where `product`.grade='".$_GET['grade']."'");
	}
	function Report_Rawmaterialsize()
	{
		return mysqli_query($_SESSION['connection'],"select `product`.material_size from `product` where `product`.material_size='".$_GET['material_size']."'");
	}
	function Report_Machine()
	{
		return mysqli_query($_SESSION['connection'],"SELECT machine_number FROM machine WHERE machine.id='".$_GET['machine']."'");
	}	
	function Report_Specification()
	{
		return mysqli_query($_SESSION['connection'],"SELECT specification FROM machine_specification WHERE id='".$_GET['specification']."'");
	}
	function Report_Tools()
	{
		return mysqli_query($_SESSION['connection'],"SELECT turningtool FROM machine_turningtools WHERE id='".$_GET['tools']."'");
	}
	//Report Drop down
	function Section_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"select section.name,section.id from section where id in(select `order`.customer_id from `order`)");
		
		/*
		SELECT DISTINCT(customer.id), customer.name
			FROM `order` JOIN job ON order.id = job.order_id
			JOIN customer ON order.customer_id = customer.id
			JOIN product ON product.id = job.product_id
			JOIN machine ON machine.id = job.machine_id
			JOIN machine_assignment ON machine_assignment.machine_id=machine.id
			JOIN location ON location.id=machine_assignment.location_id
			LEFT JOIN section ON section.id=location.section_id
			WHERE location.section_id='".$_GET['id']."'*/
	}
	function Customer_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"select customer.name,customer.id from customer where id in(select `order`.customer_id from `order`)");
	}
	function Order_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"select order.number,order.id from `order` where `order`.id in(select order_id from job)");
	}
	function Proddesc_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT distinct `product`.description from `product` where `product`.id in(select product_id from `job`)");
	}
	function Proddraw_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT distinct `product`.drawing_number from `product` where `product`.id in(select product_id from `job`)");
	}
	function Prodgrade_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT distinct `product`.grade from `product` where `product`.id in(select product_id from `job`)");
	}
	function Prodsize_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT distinct `product`.material_size from `product` where `product`.id in(select product_id from `job`)");
	}
	function Machine_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"select machine.id,machine.machine_number from machine where machine.id in(select machine_id from job)");
	}
	function Machinespec_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT machine_specification.specification,machine_specification.id from machine_specification where machine_specification.id in(select machine.machine_specification_id from machine where machine.id in(select job.machine_id from job))");
	}
	function Machineturn_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"SELECT machine_turningtools.turningtool,machine_turningtools.id from machine_turningtools where machine_turningtools.id in(select machine.machine_turningtools_id from machine where machine.id in(select job.machine_id from job))");
	}
?>