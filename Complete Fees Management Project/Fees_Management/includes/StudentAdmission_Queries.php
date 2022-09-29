<?php
	function Select_Section()
	{
		return mysqli_query($_SESSION['connection'],"Select * From section");
	}
	function Select_Blood()
	{
		return mysqli_query($_SESSION['connection'],"Select * From blood_group order by name asc");
	}
	function Select_Nationality()
	{
		return mysqli_query($_SESSION['connection'],"Select * From nationality order by name asc");
	}
	function Select_Cast()
	{
		return mysqli_query($_SESSION['connection'],"Select * From community order by name asc");
	}
	function Select_Religion()
	{
		return mysqli_query($_SESSION['connection'],"Select * From religion order by name asc");
	}
	function Select_SubCast()
	{
		return mysqli_query($_SESSION['connection'],"Select * From subcast order by name asc");
	}
	function Student_Select_ById()
	{
		return mysqli_query($_SESSION['connection'],"Select * From student_admission where id='".$_GET['id']."'");
	}
	function Fetch_LastAdmissionNum()
	{
		return mysqli_query($_SESSION['connection'],"Select * From student_admission order by id desc");
	}
	function Student_Insert($Feesnames)
	{
		$file = $_FILES['photo']['tmp_name'];
		$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$imagename = addslashes($_FILES['photo']['name']);
		$imagesize = getimagesize($_FILES['photo']['tmp_name']);
		return mysqli_query($_SESSION['connection'],"Insert into student_admission(id,admission_no,admission_date,first_name,last_name,gender,dob,section_id,
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
		return mysqli_query($_SESSION['connection'],"UPDATE student_admission SET admission_no='".$_POST['number']."',admission_date='".date('Y-m-d',strtotime($_POST['date']))."',first_name='".$_POST['name']."',last_name='".$_POST['lastname']."',gender='".$_POST['gender']."',dob='".date('Y-m-d',strtotime($_POST['dob']))."'
		,section_id='".$_POST['section']."',blood_group_id='".$_POST['bloodgroup']."',mother_tongue='".$_POST['mothertongue']."',nationality_id='".$_POST['nationality']."',cast_id='".$_POST['cast']."',subcast_id='".$_POST['subcast']."',religion_id='".$_POST['religion']."',father_name='".$_POST['fname']."'
		,father_occupation='".$_POST['foccupation']."',mother_name='".$_POST['mname']."',mother_occupation='".$_POST['moccupation']."',annual_income='".$_POST['annual']."',residenceaddress='".$_POST['residenceaddress']."',officeaddress='".$_POST['officeaddress']."',contact_no='".$_POST['contactnumber']."',email_id='".$_POST['email']."',contact_person='".$_POST['contactperson']."'
		,user_img = '".$image."',fees_catagoryids = '".$Feesnames."'  where id='".$_POST['id']."'");
	}
?>