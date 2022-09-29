<?php
	include("Config.php");
	if($_GET['AdmissionNo'])
	{
		if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"select admission_no from student_admission where admission_no='".$_GET['AdmissionNo']."'")))
			echo '<font color="red">This Admission No Already Exist</font>'.'#'.'1';
		else
			echo '#'.'0';
	}
?>