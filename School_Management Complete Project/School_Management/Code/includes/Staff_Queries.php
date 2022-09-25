<?php
	function Staff_Insert()
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		mysql_query("Insert into staff_admission(id,joined_date,name_prefix,first_name,last_name,dob,gender,phone_no,email_id,
		department_id,designation_id,qualification_id,address,father_or_husband_name,mother_or_wife_name,marital_status,blood_group_id,nationality_id,
		religion_id,community,last_institutution_worked,last_institution_address,major_subjects_taught_id,salary,total_experience,user_img,grade_id) values('','".date('Y-m-d',strtotime($_POST['date']))."','".$_POST['nameprefix']."','".$_POST['name']."','".$_POST['lastname']."','".date('Y-m-d',strtotime($_POST['dob']))."','".$_POST['gender']."'
		,'".$_POST['contactnumber']."','".$_POST['email']."','".$_POST['department']."','".$_POST['designation']."','".$_POST['qualification']."','".$_POST['address']."','".$_POST['fname']."','".$_POST['mname']."','".$_POST['mstatus']."'
		,'".$_POST['bloodgroup']."','".$_POST['nationality']."','".$_POST['religion']."','".$_POST['community']."','".$_POST['lastinstitution']."','".$_POST['laddress']."','".$_POST['subject']."','".$_POST['salary']."','".$_POST['year'].' '.$_POST['month']."','".$image."','".$_POST['grade']."')");
		$FetchLastId = mysql_fetch_array(mysql_query("select * from staff_admission order by id desc"));
		$Query = "";$Count = 0;
		if($_POST['partculars'])
		{
			$Count = count($_POST['partculars']);
			foreach($_POST['partculars'] as $pa)
			{
				$Count--;
				$Query .= $pa;
				if($Count)
					$Query .= ",";
			}
		}
		return mysql_query("insert into salary_assignment(id,employee_id,department_id,grade_id,basic_pay,da,hra,cca,ma,lop,datetime) values('','".$FetchLastId['id']."','".$_POST['department']."','".$_POST['grade']."',$Query,'".date('Y-m-d h:i:s')."')");
	}
	function Staff_Update()
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']); //user_img='".$image."',
		mysql_query("UPDATE staff_admission SET joined_date='".date('Y-m-d',strtotime($_POST['date']))."',name_prefix='".$_POST['nameprefix']."',first_name='".$_POST['name']."',last_name='".$_POST['lastname']."',dob='".date('Y-m-d',strtotime($_POST['dob']))."',gender='".$_POST['gender']."',phone_no='".$_POST['contactnumber']."',email_id='".$_POST['email']."',
		department_id='".$_POST['department']."',designation_id='".$_POST['designation']."',qualification_id='".$_POST['qualification']."',address='".$_POST['address']."',father_or_husband_name='".$_POST['fname']."',mother_or_wife_name='".$_POST['mname']."',marital_status='".$_POST['mstatus']."',blood_group_id='".$_POST['bloodgroup']."',nationality_id='".$_POST['nationality']."',
		religion_id='".$_POST['religion']."',community='".$_POST['community']."',last_institutution_worked='".$_POST['lastinstitution']."',last_institution_address='".$_POST['laddress']."',major_subjects_taught_id='".$_POST['subject']."',salary='".$_POST['salary']."',total_experience='".$_POST['year'].' '.$_POST['month']."',grade_id='".$_POST['grade']."' where id='".$_POST['id']."'");
		$Query = "";$Count = 0;$i=1;
		if($_POST['partculars'])
		{
			$Count = count($_POST['partculars']);
			foreach($_POST['partculars'] as $pa)
			{
				if($i==1)
					$Query .= "basic_pay=";
				else if($i==2)
					$Query .= "da=";
				else if($i==3)
					$Query .= "hra=";
				else if($i==4)
					$Query .= "cca=";
				else if($i==5)
					$Query .= "ma=";
				else if($i==6)
					$Query .= "lop=";
				$Count--;
				if($pa)
					$Query .= $pa;
				else
					$Query .= "0";
				if($Count)
					$Query .= ",";
				$i++;
			}
		}
		return mysql_query("UPDATE salary_assignment SET department_id='".$_POST['department']."',grade_id='".$_POST['grade']."',$Query,datetime='".date('Y-m-d h:i:s')."' where employee_id='".$_POST['id']."'");
	}	
	function Select_Blood()
	{
		return mysql_query("Select * From blood_group");
	}
	function Select_Nationality()
	{
		return mysql_query("Select * From nationality");
	}
	function Select_Section()
	{
		return mysql_query("Select * From section");
	}
	function Select_SectionById($Id)
	{
		return mysql_query("Select * From section where id='".$Id."'");
	}
	function Select_Designation()
	{
		return mysql_query("Select * From designation");
	}
	function Select_Qualification()
	{
		return mysql_query("Select * From qualification");
	}
	function Select_Religion()
	{
		return mysql_query("Select * From religion");
	}
	function Select_Department()
	{
		return mysql_query("Select * From department");
	}
	function Select_Subject()
	{
		return mysql_query("Select * From subject");
	}
	function Fetch_LastEmployeeNum()
	{
		return mysql_query("Select * From staff_admission order by id desc");
	}
	function Select_Name()
	{
		return mysql_query("Select * From staff_admission order by first_name asc");
	}
	function Employee_Select_ById()
	{
		return mysql_query("Select * From staff_admission where id='".$_GET['id']."'");
	}
	function Staff_Details_Insert()
	{
		if(!$_POST['cteacher'])
			$_POST['cteacher'] = 0;
		return mysql_query("INSERT INTO staff_details values('','".$_POST['name']."','".$_POST['employeenum']."','".$_POST['section']."','".implode($_POST['subjects'], ",")."','".$_POST['cteacher']."')");
	}
	function Select_Staff_Details()
	{
		return mysql_query("Select * From staff_details Order By id desc");
	}
	function StaffDetails_Select_ById()
	{
		return mysql_query("Select * From staff_details where id='".$_GET['id']."'");
	}
	function Staff_Details_Update()
	{
		if(!$_POST['cteacher'])
			$_POST['cteacher'] = 0;
		return mysql_query("Update staff_details Set name='".$_POST['name']."',emp_no='".$_POST['employeenum']."',section_id='".$_POST['section']."',subject_ids='".implode($_POST['subjects'], ",")."',is_class_teacher='".$_POST['cteacher']."' Where id='".$_POST['id']."'");
	}
	function Select_Grade()
	{
		return mysql_query("Select * From staff_grade");
	}
	function Salary_Details($Grade,$Department)
	{
		return mysql_query("Select * From staff_salary_assignment Where department_id='".$Department."' and grade_id='".$Grade."'");
	}
	function Select_SalaryDetails($Id)
	{
		return mysql_query("Select * From salary_assignment where employee_id='".$Id."'");
	}
	function FetchEmployeeId($Id)
	{
		return mysql_query("Select * From staff_admission where id='".$Id."'");
	}
	function FetchDepartmentById($Id)
	{
		return mysql_query("Select * From department where id='".$Id."'");
	}
	function FetchGradeById($Id)
	{
		return mysql_query("Select * From staff_grade where id='".$Id."'");
	}
	function FetchDesignationById($Id)
	{
		return mysql_query("Select * From designation where id='".$Id."'");
	}
	function SelectParticulars()
	{
		return mysql_query("Select * From salary_particulars");
	}
	
?>