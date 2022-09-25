<?php
	function Select_All_StudentAdmissions()
	{
		return mysql_query("SELECT student_admission.id,student_admission.admission_no, student_admission.first_name, class.name as classname FROM student_admission JOIN section ON section.id=student_admission.section_id JOIN class ON class.id=section.classid");
	}
	function Select_All_PaymentModes()
	{
		return mysql_query("SELECT * FROM payment_mode");
	}
	function Select_All_FeesCategories()
	{
		return mysql_query("SELECT * FROM fees_catagory");
	}
	function Select_All_Discounts()
	{
		return mysql_query("SELECT * FROM discount");
	}
?>