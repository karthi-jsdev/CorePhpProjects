<?php
	function Select_Sections()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM section WHERE id IN(SELECT DISTINCT(section_id) FROM location) ORDER BY id ASC");
	}
	function Select_SubSections()
	{//SELECT * FROM subsection JOIN section ON section.id=subsection.sectionid WHERE section.id IN(SELECT DISTINCT(subsection.id) FROM location) ORDER BY subsection.id ASC
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subsection");
	}
	function SubSection_Select_Distinct()
	{
		return mysqli_query($_SESSION['connection'],"SELECT DISTINCT(subsection_id) FROM location ORDER BY location_reference_id DESC");
	}
	function SubSection_Select_Required($SectionId)
	{
		return mysqli_query($_SESSION['connection'],"SELECT DISTINCT(subsection_id) FROM location WHERE section_id='".$SectionId."' ORDER BY subsection_id ASC");
	}
	function Location_Reference_Select_Id($SubSectionIds)
	{
		if(count($SubSectionIds))
		{
			$ReferenceId = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT location_reference_id%30 as location_reference_id FROM location WHERE (subsection_id='".implode("' || subsection_id='", $SubSectionIds)."') ORDER BY location_reference_id DESC LIMIT 0,1"));
			return mysqli_query($_SESSION['connection'],"SELECT reference FROM location_reference WHERE id='".$ReferenceId['location_reference_id']."'");
		}
		else
			return 0;
	}
	function Machines_Status_Select_ByJobAllocated()
	{
		if($_GET['customer_id'] || $_GET['order_id'] || $_GET['description'] || $_GET['product_id'])
		{
			$Query = "SELECT * FROM
			(
				SELECT * FROM
				(
					SELECT location.section_id, location.subsection_id, location.location_reference_id, location.name, machine_assignment.machine_id, machine.machine_number, machine_specification.specification, machine_type.type
					FROM location
					LEFT JOIN machine_assignment ON  machine_assignment.location_id = location.id
					LEFT JOIN machine ON machine.id = machine_assignment.machine_id
					LEFT JOIN machine_specification ON machine_specification.id = machine.machine_specification_id
					LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id
				) AS newtable2
			) t1
			LEFT JOIN
			(
				SELECT * FROM
				(
					SELECT * FROM
					(
						SELECT `order`.id as order_id, job.id, job.product_id, job.machine_id,job.tentative_date, job.tentative_enddate,
						IF(job.tentative_date > CURDATE() , '1', '') AS futurejob,
						IF(job.tentative_date <= CURDATE() && CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY ) AND job.tentative_enddate, 1, 0 ) AS 10tentative_date,
						customer.name AS customer, product.drawing_number as productdrawing ,product.id as productid , product.description as productdescription, order.customer_id ,order.number as ordernumber
						FROM job
						JOIN `order` ON `order`.id = job.order_id
						JOIN customer ON customer.id = `order`.customer_id
						JOIN product ON product.id = job.product_id
						WHERE job.tentative_enddate >= CURDATE() 
						ORDER BY job.tentative_date ASC
					) AS jobtable
					GROUP BY machine_id 
				)AS filtertable
				WHERE ".str_replace("=''", "!=''", "filtertable.customer_id='".$_GET['customer_id']."' && filtertable.order_id='".$_GET['order_id']."' && filtertable.productid='".$_GET['product_id']."' && filtertable.productdescription='".$_GET['description']."' ")."
			) t2
			ON t1.machine_id=t2.machine_id where  t2.machine_id IS NOT NULL ";
		}
		else
		{
			$Query = "SELECT * FROM
			(
				SELECT * FROM
				(
					SELECT location.section_id, location.subsection_id, location.location_reference_id, location.name, machine_assignment.machine_id, machine.machine_number, machine_specification.specification, machine_type.type
					FROM location
					LEFT JOIN machine_assignment ON  machine_assignment.location_id = location.id
					LEFT JOIN machine ON machine.id = machine_assignment.machine_id
					LEFT JOIN machine_specification ON machine_specification.id = machine.machine_specification_id
					LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id
				) AS newtable2
			) t1
			LEFT JOIN
			(
				SELECT * FROM
				(
					SELECT * FROM
					(
						SELECT `order`.id as order_id, job.id, job.product_id, job.machine_id,job.tentative_date, job.tentative_enddate,
						IF(job.tentative_date > CURDATE() , '1', '') AS futurejob,
						IF(job.tentative_date <= CURDATE() && CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY ) AND job.tentative_enddate, 1, 0 ) AS 10tentative_date,
						customer.name AS customer, product.drawing_number as productdrawing ,product.id as productid , product.description as productdescription, order.customer_id ,order.number as ordernumber
						FROM job
						JOIN `order` ON `order`.id = job.order_id
						JOIN customer ON customer.id = `order`.customer_id
						JOIN product ON product.id = job.product_id
						WHERE job.tentative_enddate >= CURDATE()
						ORDER BY job.tentative_date ASC
					) AS jobtable
					GROUP BY machine_id 
				)AS filtertable
				WHERE ".str_replace("=''", "!=''", "filtertable.customer_id='".$_GET['customer_id']."' && filtertable.order_id='".$_GET['order_id']."' && filtertable.productid='".$_GET['product_id']."' && filtertable.productdescription='".$_GET['description']."'")."
			) t2
			ON t1.machine_id=t2.machine_id";
		}
		return mysqli_query($_SESSION['connection'],$Query);
	}
	function Count_Available_Machines()
	{
		if($_GET['section_id'])
		{
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM `machine_assignment` 
			JOIN location ON location.id = machine_assignment.location_id
			JOIN section ON location.section_id  = section.id WHERE section.id = '".$_GET['section_id']."'");
		}
		else
		{
			return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM `machine_assignment` 
			JOIN location ON location.id = machine_assignment.location_id
			JOIN section ON location.section_id=section.id");
		}
	}
	function Count_Nearing_Machines()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total FROM job WHERE job.tentative_date<=CURDATE() && job.tentative_enddate>=CURDATE() && CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY) AND job.tentative_enddate");
	}
	function Count_Running_Machines()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM job WHERE job.tentative_date<=CURDATE() && job.tentative_enddate>=CURDATE()");
	}
	function Count_Assigned_Machines_Status()
	{
		$Assigned = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM (SELECT machine_assignment.machine_id, machine.machine_number, job.tentative_date, job.tentative_enddate, IF(CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY) AND job.tentative_enddate , 1, 0) AS 10tentative_date FROM location LEFT JOIN location_reference ON location_reference.id = location.location_reference_id LEFT JOIN machine_assignment ON location.id = machine_assignment.location_id LEFT JOIN machine ON machine.id = machine_assignment.machine_id LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id LEFT JOIN job ON job.machine_id = machine.id LEFT JOIN `order` ON `order`.id = job.order_id LEFT JOIN customer ON customer.id = `order`.customer_id LEFT JOIN product ON product.id = job.product_id) as newtable WHERE newtable.tentative_date!='' && newtable.tentative_date<=CURDATE() && newtable.tentative_enddate>=CURDATE() && newtable.10tentative_date=0"));
		return $Assigned['total'];
	}
	function Count_Nearing_Machines_Status()
	{
		$Nearing = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM
		(SELECT machine_assignment.machine_id, machine.machine_number, job.tentative_date, IF(job.tentative_date<=CURDATE() && job.tentative_enddate>=CURDATE(), job.tentative_enddate, '') AS tentative_enddate, IF(CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY) AND job.tentative_enddate , 1, 0) AS 10tentative_date FROM location LEFT JOIN location_reference ON location_reference.id = location.location_reference_id LEFT JOIN machine_assignment ON location.id = machine_assignment.location_id LEFT JOIN machine ON machine.id = machine_assignment.machine_id LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id LEFT JOIN job ON job.machine_id = machine.id LEFT JOIN `order` ON `order`.id = job.order_id LEFT JOIN customer ON customer.id = `order`.customer_id LEFT JOIN product ON product.id = job.product_id)
		as newtable WHERE newtable.tentative_date<=CURDATE() && newtable.tentative_enddate>=CURDATE() && newtable.10tentative_date=1"));
		return $Nearing['total'];
	}
	function Count_NotAssigned_Machines_Status()
	{
		$Nearing = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(machine_id)) as total FROM (SELECT machine_assignment.machine_id, machine.machine_number, IF(CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY) AND job.tentative_enddate , 1, 0) AS 10tentative_date FROM location LEFT JOIN location_reference ON location_reference.id = location.location_reference_id LEFT JOIN machine_assignment ON location.id = machine_assignment.location_id LEFT JOIN machine ON machine.id = machine_assignment.machine_id LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id LEFT JOIN job ON job.machine_id = machine.id LEFT JOIN `order` ON `order`.id = job.order_id LEFT JOIN customer ON customer.id = `order`.customer_id LEFT JOIN product ON product.id = job.product_id) as newtable WHERE newtable.10tentative_date=1"));
		return $Nearing['total'];
	}
	function Machines_Select_NotAllocated()
	{
		return mysqli_query($_SESSION['connection'],"SELECT machine.id, machine.machine_number FROM machine WHERE machine.id NOT IN (SELECT machine_assignment.machine_id FROM machine_assignment)");
	}
	function Masters_Assign_Machines()
	{
		$LocationId = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT id FROM location WHERE section_id='".$_GET['section_id']."' && subsection_id='".$_GET['subsection_id']."' && location_reference_id='".$_GET['location_reference_id']."'"));
		if($_GET['action'] == "assign")
		{
			mysqli_query($_SESSION['connection'],"INSERT INTO machine_assignment VALUES('', '".$_GET['machine_id']."', '".$LocationId['id']."')");
			echo "Machine successfully assigned";
		}
		else
		{
			mysqli_query($_SESSION['connection'],"DELETE FROM machine_assignment WHERE location_id='".$LocationId['id']."'");
			echo "Machine successfully removed";
		}
	}
	function Select_All_Sections()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * from section");
	}
	function Select_All_SubSections()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM subsection");
	}
	function Master_Select_Section_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,name FROM section order by name asc");
	}
	function Master_Select_All_Customers()
	{
		if($_GET['id'])
		{
			return mysqli_query($_SESSION['connection'],"SELECT DISTINCT(customer.id), customer.name
			FROM `order` JOIN job ON order.id = job.order_id
			JOIN customer ON order.customer_id = customer.id
			JOIN product ON product.id = job.product_id
			JOIN machine ON machine.id = job.machine_id
			JOIN machine_assignment ON machine_assignment.machine_id=machine.id
			JOIN location ON location.id=machine_assignment.location_id
			LEFT JOIN section ON section.id=location.section_id
			WHERE location.section_id='".$_GET['id']."'");
		}
		else
		{
			return mysqli_query($_SESSION['connection'],"SELECT DISTINCT(customer.id), customer.name
			FROM `order` JOIN job ON order.id = job.order_id
			JOIN customer ON order.customer_id = customer.id
			JOIN product ON product.id = job.product_id
			JOIN machine ON machine.id = job.machine_id
			JOIN machine_assignment ON machine_assignment.machine_id=machine.id
			JOIN location ON location.id=machine_assignment.location_id
			LEFT JOIN section ON section.id=location.section_id");
		}
		/*return mysqli_query($_SESSION['connection'],"SELECT DISTINCT(customer.id), customer.name FROM customer
		JOIN `order` ON customer.id = `order`.customer_id
		JOIN job ON `order`.id = job.order_id
		JOIN machine ON job.machine_id = machine.id
		JOIN machine_assignment ON machine_assignment.machine_id = machine_assignment.location_id
		JOIN location ON location.id = machine_assignment.location_id
		WHERE location.section_id='".$_GET['id']."'");*/
	}
	function Master_Select_Order_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,number FROM `order` WHERE customer_id=".$_GET['id']);
	}
	function Master_Select_DrawingNo_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,drawing_number FROM product WHERE id IN(SELECT product_id FROM job WHERE order_id='".$_GET['id']."')");
	}
	function Master_Select_Description_ById()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,description FROM product WHERE id IN(SELECT product_id FROM job WHERE order_id='".$_GET['id']."')");
	}
	
	//Report
	function Machine_Status_Report()
	{
		return mysqli_query($_SESSION['connection'],"SELECT * FROM
		(
			SELECT * FROM
			(
				SELECT location.section_id, location.subsection_id, location.location_reference_id, location.name, machine_assignment.machine_id, machine.machine_number, machine_specification.specification, machine_type.type, machine.machine_make_id, machine.machine_type_id, machine.machine_specification_id, machine.machine_turningtools_id
				FROM location
				LEFT JOIN machine_assignment ON  machine_assignment.location_id = location.id
				LEFT JOIN machine ON machine.id = machine_assignment.machine_id
				LEFT JOIN machine_specification ON machine_specification.id = machine.machine_specification_id
				LEFT JOIN machine_type ON machine_type.id = machine.machine_type_id
			) AS newtable2
		) t1
		LEFT JOIN
		(
			SELECT * FROM
			(
				SELECT * FROM
				(
					SELECT `order`.id as order_id, job.id, job.product_id, job.machine_id,job.tentative_date, job.tentative_enddate,
					IF(job.tentative_date > CURDATE() , '1', '') AS futurejob,
					IF(job.tentative_date <= CURDATE() && CURDATE() BETWEEN DATE_SUB(job.tentative_enddate, INTERVAL 10 DAY ) AND job.tentative_enddate, 1, 0 ) AS 10tentative_date,
					customer.name AS customer, product.drawing_number as product
					FROM job
					JOIN `order` ON `order`.id = job.order_id
					JOIN customer ON customer.id = `order`.customer_id
					JOIN product ON product.id = job.product_id
					WHERE job.tentative_enddate >= CURDATE()
					ORDER BY job.tentative_date ASC
				) AS jobtable
				GROUP BY machine_id 
			)AS newtable
		) t2
		ON t1.machine_id=t2.machine_id 
		WHERE ".str_replace("=''", "!=''",
		"t1.machine_make_id='".$_GET['machinemake']."'&&
		t1.machine_type_id='".$_GET['machinetype']."'&&
		t1.machine_specification_id='".$_GET['machinespecification']."'&&
		t1.machine_turningtools_id='".$_GET['machineturningtools']."'"));
	}
	function Machine_Status_Dropdown()
	{
		return mysqli_query($_SESSION['connection'],"select machine_make.id as make_id,machine_make.name,
		machine_specification.id as specid,machine_specification.specification,
		machine_turningtools.id as toolid,machine_turningtools.turningtool,
		machine_type.id as typeid,machine_type.type 
		from machine
		join machine_type on machine.machine_type_id=machine_type.id
		join machine_make on machine.machine_make_id=machine_make.id
		join machine_specification on machine.machine_specification_id=machine_specification.id
		join machine_turningtools on machine.machine_turningtools_id=machine_turningtools.id
		WHERE ".str_replace("=''", "!=''",
		"machine_make.id='".$_GET['machinemake']."'&&
		machine_type.id='".$_GET['machinetype']."'&&
		machine_specification.id='".$_GET['machinespecification']."'&&
		machine_turningtools.id='".$_GET['machineturningtools']."'"));
	}
	function Machine_Make()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,name from machine_make");
	}
	function Machine_Type()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,type from machine_type");
	}
	function Machine_Turningtools()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,turningtool from machine_turningtools");
	}
	function Machine_Specification()
	{
		return mysqli_query($_SESSION['connection'],"SELECT id,specification from machine_specification");
	}
	function Machine_Dropdownvalues_Make()
	{
		return mysqli_query($_SESSION['connection'],"Select distinct machine_make.id,machine_make.name from machine join machine_make on machine_make.id=machine.machine_make_id");
	}
	function Machine_Dropdownvalues_Type()
	{
		return mysqli_query($_SESSION['connection'],"Select distinct machine_type.id,machine_type.type from machine join machine_type on machine_type.id=machine.machine_type_id");
	}
	function Machine_Dropdownvalues_Specification()
	{
		return mysqli_query($_SESSION['connection'],"Select distinct machine_specification.id,machine_specification.specification from machine join machine_specification on machine_specification.id=machine.machine_specification_id");
	}
	function Machine_Dropdownvalues_Turningtool()
	{
		return mysqli_query($_SESSION['connection'],"Select distinct machine_turningtools.id,machine_turningtools.turningtool from machine join machine_turningtools on machine_turningtools.id=machine.machine_turningtools_id");
	}
?>