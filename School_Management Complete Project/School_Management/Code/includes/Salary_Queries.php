<?php
	function Select_Employee()
	{
		return mysql_query("Select * From staff_admission");
	}
	function Select_department()
	{
		return mysql_query("Select * From department");
	}
	function Select_designation()
	{
		return mysql_query("Select * From designation");
	}
	function Salary_Select_ById()
	{
		return mysql_query("select * from employee_salary_assignment where id='".$_GET['id']."'");
	}
	function SelectParticulars()
	{
		return mysql_query("Select * From salary_particulars");
	}
?>