<?php
	function Student_Name()
	{
		/* return mysqli_query($_SESSION['connection'],"SELECT section.name as sectionname,class.name as classname,
		blood_group.name as bloodgroupname,religion.name as religionname,community.name as communityname,subcast.name as subcastname,
		student_admission.* FROM student_admission 
		JOIN section ON section.id = student_admission.section_id 
		JOIN class ON section.classid = class.id JOIN blood_group ON blood_group.id = student_admission.blood_group_id 
		JOIN religion ON religion.id = student_admission.religion_id 
		JOIN community ON community.id = student_admission.cast_id 
		JOIN subcast ON subcast.id = student_admission.subcast_id  
		WHERE student_admission.id='".$_GET['Student_id']."' "); */
		return mysqli_query($_SESSION['connection'],"SELECT student_admission.*,section.name as sectionname,class.name as classname
		FROM student_admission 
		JOIN section ON section.id = student_admission.section_id 
		JOIN class ON section.classid = class.id 
		WHERE student_admission.id='".$_GET['Student_id']."' ");
	}
?>