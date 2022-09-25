<?php
	function Student_Insert($Feesnames)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		return mysql_query("Insert into student_admission(id,admission_no,admission_date,first_name,last_name,gender,dob,birth_place,section_id,
		blood_group_id,mother_tongue,nationality_id,subcast_id,cast_id,region_id,father_name,father_occupation_id,mother_name,mother_occupation_id,
		annual_income,address,contact_no,email_id,contact_person,relation_id,prev_school_name,prev_school_address,prev_school_medium,prev_studied_std,promoted,user_img,busroute_id,fees_catagoryids) values('','".$_POST['number']."','".date('Y-m-d',strtotime($_POST['date']))."','".$_POST['name']."','".$_POST['lastname']."','".$_POST['gender']."','".date('Y-m-d',strtotime($_POST['dob']))."'
		,'".$_POST['birthplace']."','".$_POST['section']."','".$_POST['bloodgroup']."','".$_POST['mothertongue']."','".$_POST['nationality']."','".$_POST['subcast']."','".$_POST['cast']."','".$_POST['religion']."','".$_POST['fname']."'
		,'".$_POST['foccupation']."','".$_POST['mname']."','".$_POST['moccupation']."','".$_POST['annual']."','".$_POST['address']."','".$_POST['contactnumber']."','".$_POST['email']."','".$_POST['contactperson']."','".$_POST['relation']."',
		'".$_POST['sname']."','".$_POST['saddress']."','".$_POST['instruction']."','".$_POST['pstudied']."','".$_POST['promoted']."','".$image."','".$_POST['route']."','".$Feesnames."')");
		//}subcaste_id
	}
	function Student_Update($Feesnames)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		/*return mysql_query("UPDATE student_admission SET user_img='".$image."',admission_date='".date('Y-m-d',strtotime($_POST['date']))."',first_name='".$_POST['name']."',last_name='".$_POST['lastname']."',gender='".$_POST['gender']."',dob='".date('Y-m-d',strtotime($_POST['dob']))."'
		,birth_place='".$_POST['birthplace']."',section_id='".$_POST['section']."',blood_group_id='".$_POST['bloodgroup']."',mother_tongue='".$_POST['mothertongue']."',nationality_id='".$_POST['nationality']."',cast_id='".$_POST['cast']."',subcast_id='".$_POST['subcast']."',region_id='".$_POST['religion']."',father_name='".$_POST['fname']."'
		,father_occupation_id='".$_POST['foccupation']."',mother_name='".$_POST['mname']."',mother_occupation_id='".$_POST['moccupation']."',annual_income='".$_POST['annual']."',address='".$_POST['address']."',contact_no='".$_POST['contactnumber']."',email_id='".$_POST['email']."',contact_person='".$_POST['contactperson']."',relation_id='".$_POST['relation']."',
		prev_school_name='".$_POST['sname']."',prev_school_address='".$_POST['saddress']."',prev_school_medium='".$_POST['instruction']."',prev_studied_std='".$_POST['pstudied']."',promoted='".$_POST['promoted']."',fees_particulars='".implode($_POST['particulars'],'.')."',busroute_id='".$_POST['route']."' where id='".$_POST['id']."'");*/
		return mysql_query("UPDATE student_admission SET admission_no='".$_POST['number']."',admission_date='".date('Y-m-d',strtotime($_POST['date']))."',first_name='".$_POST['name']."',last_name='".$_POST['lastname']."',gender='".$_POST['gender']."',dob='".date('Y-m-d',strtotime($_POST['dob']))."'
		,birth_place='".$_POST['birthplace']."',section_id='".$_POST['section']."',blood_group_id='".$_POST['bloodgroup']."',mother_tongue='".$_POST['mothertongue']."',nationality_id='".$_POST['nationality']."',cast_id='".$_POST['cast']."',subcast_id='".$_POST['subcast']."',region_id='".$_POST['religion']."',father_name='".$_POST['fname']."'
		,father_occupation_id='".$_POST['foccupation']."',mother_name='".$_POST['mname']."',mother_occupation_id='".$_POST['moccupation']."',annual_income='".$_POST['annual']."',address='".$_POST['address']."',contact_no='".$_POST['contactnumber']."',email_id='".$_POST['email']."',contact_person='".$_POST['contactperson']."',relation_id='".$_POST['relation']."',
		prev_school_name='".$_POST['sname']."',prev_school_address='".$_POST['saddress']."',prev_school_medium='".$_POST['instruction']."',prev_studied_std='".$_POST['pstudied']."',promoted='".$_POST['promoted']."',busroute_id='".$_POST['route']."',fees_catagoryids = '".$Feesnames."' where id='".$_POST['id']."'");
	}
	function Select_Section()
	{
		return mysql_query("Select * From section");
	}
	function Select_Blood()
	{
		return mysql_query("Select * From blood_group");
	}
	function Select_Nationality()
	{
		return mysql_query("Select * From nationality");
	}
	function Select_Cast()
	{
		return mysql_query("Select * From community");
	}
	function Select_Religion()
	{
		return mysql_query("Select * From religion");
	}
	function Select_SubCast()
	{
		return mysql_query("Select * From subcast");
	}
	function Select_BusRoute()
	{
		return mysql_query("Select * From busroute");
	}
	function Student_Select_ById()
	{
		return mysql_query("Select * From student_admission where id='".$_GET['id']."'");
	}
	function Select_Occupation()
	{
		return mysql_query("Select * From occupation");
	}
	function Select_Relation()
	{
		return mysql_query("Select * From relation");
	}
	function Select_Name()
	{
		return mysql_query("Select * From student_admission");
	}
	function Fetch_LastAdmissionNum()
	{
		return mysql_query("Select * From student_admission order by id desc");
	}
	/* function Student_Select_ById()
	{
		return mysql_query("Select * From student_admission where id='".$_GET['id']."'");
	} */
	/* function FetchParticulars()
	{
		return mysql_query("Select * From fees_particulars");
	} */
	/* function Student_Insert($Feesnames)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		return mysql_query("Insert into student_admission(id,admission_no,admission_date,first_name,last_name,gender,dob,section_id,
		blood_group_id,mother_tongue,nationality_id,subcast_id,cast_id,religion_id,father_name,father_occupation,mother_name,mother_occupation,
		annual_income,residenceaddress,officeaddress,contact_no,email_id,contact_person,user_img,fees_catagoryids) values('','".$_POST['number']."','".date('Y-m-d',strtotime($_POST['date']))."','".$_POST['name']."','".$_POST['lastname']."','".$_POST['gender']."','".date('Y-m-d',strtotime($_POST['dob']))."'
		,'".$_POST['section']."','".$_POST['bloodgroup']."','".$_POST['mothertongue']."','".$_POST['nationality']."','".$_POST['subcast']."','".$_POST['cast']."','".$_POST['religion']."','".$_POST['fname']."'
		,'".$_POST['foccupation']."','".$_POST['mname']."','".$_POST['moccupation']."','".$_POST['annual']."','".$_POST['residenceaddress']."','".$_POST['officeaddress']."','".$_POST['contactnumber']."','".$_POST['email']."','".$_POST['contactperson']."',
		'".$image."','".$Feesnames."')");
		//}subcaste_id
	}
	function Student_Update($Feesnames)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		return mysql_query("UPDATE student_admission SET admission_no='".$_POST['number']."',admission_date='".date('Y-m-d',strtotime($_POST['date']))."',first_name='".$_POST['name']."',last_name='".$_POST['lastname']."',gender='".$_POST['gender']."',dob='".date('Y-m-d',strtotime($_POST['dob']))."'
		,section_id='".$_POST['section']."',blood_group_id='".$_POST['bloodgroup']."',mother_tongue='".$_POST['mothertongue']."',nationality_id='".$_POST['nationality']."',cast_id='".$_POST['cast']."',subcast_id='".$_POST['subcast']."',religion_id='".$_POST['religion']."',father_name='".$_POST['fname']."'
		,father_occupation='".$_POST['foccupation']."',mother_name='".$_POST['mname']."',mother_occupation='".$_POST['moccupation']."',annual_income='".$_POST['annual']."',residenceaddress='".$_POST['residenceaddress']."',officeaddress='".$_POST['officeaddress']."',contact_no='".$_POST['contactnumber']."',email_id='".$_POST['email']."',contact_person='".$_POST['contactperson']."'
		,fees_catagoryids = '".$Feesnames."'  where id='".$_POST['id']."'");
	} */
?>