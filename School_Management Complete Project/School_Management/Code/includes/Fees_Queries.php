<?php
	function Select_StudentName()
	{
		return mysql_query("SELECT * FROM student_admission ORDER BY first_name ASC");
	}
	function Class_Select_All()
	{
		return mysql_query("SELECT * FROM section ORDER BY name ASC");
	}
	function Section_Select($Id)
	{
		return mysql_query("SELECT * FROM section where classid='".$Id."' ORDER BY name ASC");
	}
	function Select_Category()
	{
		return mysql_query("SELECT * FROM fees_catagory ORDER BY name ASC");
	}
	
	//Pay Fees
	function Insert_PayFees()
	{
		return mysql_query("INSERT INTO student_fees VALUES('', '".$_POST['student_id']."', '".implode(".", $_POST['terms'])."', '".$_POST['payment_mode']."', '".$_POST['payment_done']."', '".date("Y-m-d", strtotime($_POST['payment_date']))."', '".$_POST['total_amount']."', '".$_POST['amount_pending']."', '".$_POST['fees_category_id']."', '".$_POST['discount_id']."', '".$_POST['fine_id']."')");
	}
	function Select_All_StudentAdmissions()
	{
		return mysql_query("SELECT student_admission.id,student_admission.admission_no, student_admission.first_name, class.name as classname FROM student_admission JOIN section ON section.id=student_admission.section_id JOIN class ON class.id=section.classid");
	}
	function Select_All_Terms()
	{
		return mysql_query("SELECT * FROM term");
	}
	function Select_Terms_ById($Ids)
	{
		return mysql_query("SELECT * FROM term WHERE id=".str_replace(".", " or id=", $Ids));
	}
	function Select_All_PaymentModes()
	{
		return mysql_query("SELECT * FROM payment_mode");
	}
	function Select_All_Discounts()
	{
		return mysql_query("SELECT * FROM discount");
	}
	function Select_All_FeesCategories()
	{
		return mysql_query("SELECT * FROM fees_catagory");
	}
	function Count_AllPayFees()
	{
		return mysql_query("SELECT COUNT(*) as total FROM student_fees");
	}
	function Select_PayFees_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT student_fees.id,student_fees.discount_id, student_admission.admission_no, student_admission.first_name, student_fees.terms, payment_mode.name as payment_mode, student_fees.payment_done, student_fees.payment_date, student_fees.total_amount, student_fees.amount_pending, student_fees.fees_category_id, student_fees.fine, fees_catagory.name as fees_catagory_name FROM student_fees JOIN student_admission ON student_admission.id=student_fees.student_id JOIN payment_mode ON payment_mode.id=student_fees.payment_mode JOIN fees_catagory ON fees_catagory.id=student_fees.fees_category_id LIMIT $Start, $Limit");
	}
	function Update_PayFees()
	{
		return mysql_query("UPDATE student_fees SET student_id='".$_POST['student_id']."', terms='".implode(".", $_POST['terms'])."', payment_mode='".$_POST['payment_mode']."', payment_date='".date("Y-m-d", strtotime($_POST['payment_date']))."', payment_done='".$_POST['payment_done']."', total_amount='".$_POST['total_amount']."', amount_pending='".$_POST['amount_pending']."' , fees_category_id='".$_POST['fees_category_id']."', discount_id='".$_POST['discount_id']."', fine='".$_POST['fine']."' WHERE id=".$_POST['id']);
	}
	function Select_PayFees_ByAddNo()
	{
		return mysql_query("SELECT * FROM student_fees WHERE id=".$_GET['id']);
	}
	function Delete_PayFees_ById()
	{
		return mysql_query("DELETE FROM student_fees WHERE id=".$_GET['id']);
	}
	
	//Fees Details
	function Select_Fees_ByStudentId()
	{
		return mysql_query("SELECT student_fees.student_id, student_fees.terms, student_fees.payment_mode, student_fees.payment_date, student_fees.total_amount, student_fees.amount_pending, student_fees.payment_done, student_fees.fine FROM student_fees JOIN student_admission ON student_admission.id=student_fees.student_id WHERE ".str_replace("=''", "!=''", "student_fees.student_id='".$_POST['student_id']."' && student_admission.section_id='".$_POST['section_id']."' && student_fees.fees_category_id='".$_POST['category_id']."'"));
	}
?>