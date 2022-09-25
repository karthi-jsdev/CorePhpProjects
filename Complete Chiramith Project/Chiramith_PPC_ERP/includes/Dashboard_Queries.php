<?php
	#Dashboard
	#Product
	function Product_List_ByLimit5($Start,$Limit)
	{
		return mysql_query("SELECT DATE_FORMAT(job.tentative_enddate,'%d-%m-%Y') AS tentative_enddate,machine.machine_number as machine_number,product.id AS id, product.drawing_number AS drawing_number, product.description AS description, 
		product.material_type AS material_type, product.material_size AS material_size, product.grade AS grade, product.numberofpieces AS numberofpieces,job.plannedquantity as plannedquantity,
		product.outputperhour AS outputperhour, DATE_FORMAT(job.tentative_date,'%d-%m-%Y') AS tentative_date
		FROM product JOIN job ON job.product_id = product.id join machine ON job.machine_id = machine.id WHERE job.tentative_enddate >= NOW() ORDER BY job.tentative_date ASC Limit $Start,$Limit");
	}
	function Product_Machine_AvailabilityList_ByLimit5($Start,$Limit)
	{
		return mysql_query("SELECT job.plannedquantity,machine.machine_number as machine_number,product.id AS id, product.drawing_number AS drawing_number, product.description AS description, 
							product.material_type AS material_type, product.material_size AS material_size, product.grade AS grade, product.numberofpieces AS numberofpieces, 
							product.outputperhour AS outputperhour, DATE_FORMAT(job.tentative_enddate,'%d-%m-%Y') AS tentative_enddate
							FROM product JOIN job ON job.product_id = product.id and tentative_enddate >= NOW()  
							join machine ON job.machine_id = machine.id  ORDER BY job.tentative_enddate ASC Limit $Start,$Limit");
	}
	function Product_Machine_AvailabilityList()
	{
		return mysql_query("SELECT job.plannedquantity,machine.machine_number as machine_number,product.id AS id, product.drawing_number AS drawing_number, product.description AS description, 
							product.material_type AS material_type, product.material_size AS material_size, product.grade AS grade, product.numberofpieces AS numberofpieces, 
							product.outputperhour AS outputperhour, DATE_FORMAT(job.tentative_enddate,'%d-%m-%Y') AS tentative_enddate
							FROM product JOIN job ON job.product_id = product.id and tentative_enddate >= NOW()  
							join machine ON job.machine_id = machine.id  ORDER BY job.tentative_enddate ASC");
	}
	function Product_List()
	{
		return mysql_query("SELECT DATE_FORMAT(job.tentative_enddate,'%d-%m-%Y') AS tentative_enddate,machine.machine_number as machine_number,product.id AS id, product.drawing_number AS drawing_number, product.description AS description, 
		product.material_type AS material_type, product.material_size AS material_size, product.grade AS grade, product.numberofpieces AS numberofpieces,job.plannedquantity as plannedquantity,
		product.outputperhour AS outputperhour, DATE_FORMAT(job.tentative_date,'%d-%m-%Y') AS tentative_date
		FROM product JOIN job ON job.product_id = product.id join machine ON job.machine_id = machine.id WHERE job.tentative_enddate >= NOW() ORDER BY job.tentative_date ASC");
	}
	function Select_Machine($Id)
	{
		return mysql_query("SELECT * from job where product_id='".$Id."' ORDER BY id DESC");
	}
	function Fetch_Machine($Id)
	{
		return mysql_query("SELECT * from machine where id='".$Id."' ORDER BY id DESC");
	}
	#Machine status
	function Running_Machine_count()
	{
		return mysql_query("SELECT count(machine.id) as Item from machine WHERE machine.id in(SELECT job.machine_id from job where job.machine_id in(select job.machine_id from job where CURDATE()<tentative_enddate))");
	}
	function Notworking_Machine_count()
	{
		return mysql_query("SELECT count(machine.id) as Item from machine WHERE machine.id not in(SELECT job.machine_id from job where machine.id in(select job.machine_id from job where tentative_enddate > CURDATE()))");
	}
	function Machine_Nearing_Count()
	{
		return mysql_query("SELECT count(machine_id) as Item from job where CURDATE() BETWEEN DATE_SUB(job.tentative_enddate,INTERVAL 10 DAY)and job.tentative_enddate");
	}
	
	function Job_Complete_Status()
	{
		return mysql_query("SELECT customer.name AS customer, job.product_id as product, job.machine_id as machineid, job.tentative_date as tentativedate FROM customer JOIN `order` ON order.customer_id = customer.id JOIN job ON job.order_id = order.id JOIN product ON product.id = job.product_id where job.tentative_enddate = CURDATE()");
	}
	function Select_Sections($id)
	{
		return mysql_query("Select * From section where id='".$id."'");
	}
	function Select_MachineId()
	{
		return mysql_query("Select DISTINCT(location.section_id), count(DISTINCT(machine.id)) as MachineId ,count(DISTINCT(job.machine_id)) as JobMachineId  From machine JOIN machine_assignment ON machine.id=machine_assignment.machine_id JOIN location ON location.id= machine_assignment.location_id LEFT JOIN job ON job.machine_id=machine.id   GROUP BY location.section_id order by location.id asc");
	}
	function Select_Customer()
	{
		return mysql_query('SELECT customer.id,customer.name, count( job.machine_id ) as MachineId , count((product.id)) as ProductId FROM customer  JOIN `order` ON customer.id = `order`.customer_id  JOIN job ON job.order_id = `order`.id  JOIN product ON product.id = job.product_id  WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() GROUP BY customer.id  ORDER BY customer.id ASC');
	//return mysql_query("SELECT customer.name, count( job.machine_id ) as totalcount FROM customer  JOIN `order` ON customer.id = `order`.customer_id  JOIN job ON job.order_id = `order`.id  WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() GROUP BY customer.id ORDER BY customer.id ASC");
	}
	function Select_CustomerByLimit($Start,$Limit)
	{
		return mysql_query("SELECT customer.id, count((job.machine_id)) as MachineId , count((product.id)) as ProductId FROM customer  JOIN `order` ON customer.id = `order`.customer_id  JOIN job ON job.order_id = `order`.id  JOIN product ON product.id = job.product_id  WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() GROUP BY customer.id  ORDER BY customer.id ASC Limit $Start,$Limit");
		//return mysql_query("SELECT customer.id, count(DISTINCT(job.machine_id)) as MachineId , count(DISTINCT(product.id)) as ProductId FROM customer LEFT JOIN `order` ON customer.id = `order`.customer_id LEFT JOIN job ON job.order_id = `order`.id LEFT JOIN product ON product.id = job.product_id where job.tentative_enddate >= NOW() GROUP BY customer.id ORDER BY customer.id ASC Limit $Start,$Limit");
	}
	function Select_CustomersName($Id)
	{
		return mysql_query('Select * From customer where id="'.$Id.'"');
	}
	function SelectTotalMachineAvailable($id)
	{
		return mysql_query("SELECT * from job where machine_id='".$id."'");
	}
	function SelectLocation($LocationId)
	{
		return mysql_query("Select * From location where id='".$LocationId."'");
	}
	#Running Wise Machine Allocation
	function Total_Machine()
	{
		return mysql_query("SELECT * from machine");
	}
	function Machine_Working()
	{
		return mysql_query("SELECT DISTINCT(machine.id) FROM machine JOIN job ON machine.id = job.machine_id WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE()");
	}
	#Customer Wise Machine Allocation
	function Customer_Machineallocation()
	{
		return mysql_query("SELECT customer.name, count( job.machine_id ) as totalcount FROM customer  JOIN `order` ON customer.id = `order`.customer_id  JOIN job ON job.order_id = `order`.id  WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() GROUP BY customer.id ORDER BY customer.id ASC");
	}
	#Raw Material Wise Machine Allocation
	function Raw_Material_Machineallocation()
	{
		return mysql_query("SELECT product.material_type , count(job.machine_id ) as totalcount FROM `product` JOIN job ON product.id = job.product_id WHERE  job.tentative_date<=CURDATE()  AND job.tentative_enddate>=CURDATE() GROUP BY product.material_type ORDER BY product.id ASC");
	}
	#Section Wise Machine Allocation
	function Section_Name($Id)
	{
		return mysql_query("SELECT * From section where id ='".$Id."'");
	}
	function SectionWiseMachineAllocation()
	{
		return mysql_query("Select DISTINCT(location.section_id), count(DISTINCT(machine.id)) as MachineId, count(DISTINCT(job.machine_id)) as JobMachineId
		From machine JOIN machine_assignment ON machine.id=machine_assignment.machine_id
		JOIN location ON location.id= machine_assignment.location_id
		LEFT JOIN job ON (job.machine_id=machine.id && job.tentative_enddate>=CURDATE() && job.tentative_date<=CURDATE())
		GROUP BY location.section_id order by location.id asc");
	}
	#Machine Specification
	function MachineSpecification()
	{
		return mysql_query("SELECT DISTINCT(machine_specification.specification),count(machine.machine_specification_id) as specificationid FROM  `machine_specification` JOIN  machine ON machine_specification.id = machine.machine_specification_id JOIN job ON machine_id = machine.id WHERE  job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() group by machine_specification.id");
		//return mysql_query("SELECT count(*) as specificationid,machine_specification.specification FROM `machine_specification` Group By machine_specification.specification");
	}
	#Machine RawmaterialType
	function MachineType()
	{
		return mysql_query("SELECT product.grade , count( job.machine_id ) as totalcount FROM `product` JOIN job ON product.id = job.product_id WHERE job.tentative_date<=CURDATE()  AND  job.tentative_enddate>=CURDATE() GROUP BY product.grade ORDER BY product.id ASC");
	}
	#Raw material chart
	function Raw_Material_Product()
	{
		return mysql_query("SELECT count(*) as totalcount, product.material_type from product Group By product.material_type");
	}
?>  