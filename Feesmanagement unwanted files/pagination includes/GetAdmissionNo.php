<?php
	include("Config.php");
	if($_GET['AdmissionNo'])
	{
		if(mysql_num_rows(mysql_query("select admission_no from student_admission where admission_no='".$_GET['AdmissionNo']."'")))
			echo '<font color="red">This Admission No Already Exist</font>'.'#'.'1';
		else
			echo '#'.'0';
	}
?>