<?php
	function Select_Employee()
	{
		return mysqli_query($_SESSION['connection'],"Select * From staff_admission");
	}
	function Select_department()
	{
		return mysqli_query($_SESSION['connection'],"Select * From department");
	}
	function Select_designation()
	{
		return mysqli_query($_SESSION['connection'],"Select * From designation");
	}
	function Salary_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"select * from employee_salary_assignment where id='".$_GET['id']."'");
	}
	function SelectParticulars()
	{
		return mysqli_query($_SESSION['connection'],"Select * From salary_particulars");
	}
?>