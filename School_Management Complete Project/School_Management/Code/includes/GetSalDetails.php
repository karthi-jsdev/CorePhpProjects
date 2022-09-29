<?php
	include("Config.php");
	include("Staff_Queries.php");
	if(!isset($_GET['EmpId']))
	{
		if($_GET['Grade'] && $_GET['Department'])
		{
			$FetchSalaryDetails = mysqli_fetch_array(Salary_Details($_GET['Grade'],$_GET['Department']));
			if(mysqli_num_rows(Salary_Details($_GET['Grade'],$_GET['Department'])))
			{
				echo "#".($FetchSalaryDetails['basic_pay'].'#'.$FetchSalaryDetails['da'].'#'.$FetchSalaryDetails['hra'].'#'.$FetchSalaryDetails['cca'].'#'.$FetchSalaryDetails['ma'].'#'.$FetchSalaryDetails['lop']);
			}
		}
		else if($_GET['Grade'] && !$_GET['Department'])
		{
			$FetchSalaryDetails = mysqli_fetch_array(Select_SalaryDetails($_GET['Grade']));
			echo "#".$FetchSalaryDetails['basic_pay'].'#'.$FetchSalaryDetails['da'].'#'.$FetchSalaryDetails['hra'].'#'.$FetchSalaryDetails['cca'].'#'.$FetchSalaryDetails['ma'].'#'.$FetchSalaryDetails['lop'];
		}
	}
	else if(isset($_GET['EmpId']))
	{
		$FetchSalaryDetails = mysqli_fetch_array(Select_SalaryDetails($_GET['EmpId']));
		$FetchEmployeeId = mysqli_fetch_array(FetchEmployeeId($FetchSalaryDetails['employee_id']));
		$FetchDepartment = mysqli_fetch_array(FetchDepartmentById($FetchEmployeeId['department_id']));
		$FetchGrade = mysqli_fetch_array(FetchGradeById($FetchEmployeeId['grade_id']));
		$FetchDesignation = mysqli_fetch_array(FetchDesignationById($FetchEmployeeId['designation_id']));
		echo $FetchEmployeeId['employee_no'].'#'.$FetchDepartment['name'].'#'.$FetchDesignation['name'].'#'.$FetchSalaryDetails['basic_pay'].'#'.$FetchSalaryDetails['da'].'#'.$FetchSalaryDetails['hra'].'#'.$FetchSalaryDetails['cca'].'#'.$FetchSalaryDetails['ma'].'#'.$FetchSalaryDetails['lop'].'#'.$FetchGrade['name'].'#'.$FetchEmployeeId['department_id'].'#'.$FetchGrade['id'];
	}
?>