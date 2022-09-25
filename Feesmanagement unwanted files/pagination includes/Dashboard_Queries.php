<?php
	function  Class_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(distinct(section_id)) as total FROM section JOIN payment_log ON payment_log.section_id = section.id");
	}
	function Thisyearcollected_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT section.name as sname,class.name as classname,SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount,finepaid,section_id 
		FROM payment_log JOIN section on section.id = payment_log.section_id 
		JOIN class on section.classid = class.id WHERE  
		EXTRACT(YEAR FROM payment_log.datetime) = EXTRACT(YEAR FROM CURDATE()) group by section_id order by datetime desc");
	}
	function Thismonthcollected_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT section.name as sname,class.name as classname,SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount,finepaid,section_id 
		FROM payment_log JOIN section on section.id = payment_log.section_id 
		JOIN class on section.classid = class.id WHERE  
		EXTRACT(month FROM payment_log.datetime) = EXTRACT(month FROM CURDATE()) group by section_id order by datetime desc");
	}
	function Class_Select_Based_Section()
	{
		return mysql_query("SELECT *,fees_catagory.name as fname FROM fees_category_assign JOIN fees_catagory on fees_catagory.id=fees_category_assign.feescategoryid");
	}
	function Class_Select_Based_Section_Count()
	{
		return mysql_query("SELECT count(*)as total FROM payment_log");
	}
	function Thismonthpending_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT section.name as sname,class.name as classname,SUM(paidamount) as paidamount,SUM(scholarshipamount) as scholarshipamount,SUM(fineamount) as fineamount,finepaid,section_id 
		FROM payment_log JOIN section on section.id = payment_log.section_id 
		JOIN class on section.classid = class.id WHERE  
		EXTRACT(month FROM payment_log.datetime) = EXTRACT(month FROM CURDATE()) group by section_id order by datetime desc");
	}
?>