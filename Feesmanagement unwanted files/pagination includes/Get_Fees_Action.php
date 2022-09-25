<?php
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	include("Config.php");
	$Feescategories = explode(",",$_POST['feescategoryids']);
	$Fineamount = $_POST['fine']/COUNT($Feescategories);
	$scholaramount = $_POST['scholaramount']/COUNT($Feescategories);
	for($i = 0;$i<count($Feescategories);$i++)
	{
		$FeescategoryAmount = mysql_fetch_array(mysql_query("SELECT amount FROM fees_category_assign WHERE fees_category_assign.id='".$Feescategories[$i]."'"));
		mysql_query("INSERT INTO payment_log (student_id,feescategory_id,month_id,amounttobepaid,paidamount,datetime,fineamount,scholarshipamount,finepaid,section_id) values ('".$_POST['Student_id']."','".$Feescategories[$i]."','".$_POST['monthid']."','0' ,'".$FeescategoryAmount['amount']."','".date('y-m-d H:i:s')."','".$Fineamount."','".$scholaramount."','".$_POST['isFinePaid']."','".$_POST['section_id']."')");
	}
?>