<?php
	ini_set("display_errors","0");
	include("Config.php");
	$Feescategories = explode(",",$_POST['feescategoryids']);
	for($i = 0;$i<count($Feescategories);$i++)
	{
		$FeescategoryAmount = mysql_fetch_array(mysql_query("SELECT amount FROM fees_category_assign WHERE fees_category_assign.id='".$Feescategories[$i]."'"));
		mysql_query("INSERT INTO payment_log (student_id,feescategory_id,month_id,amounttobepaid,paidamount,datetime,fineamount,scholarshipamount,finepaid) values ('".$_POST['Student_id']."','".$Feescategories[$i]."','".$_POST['monthid']."','0' ,'".$FeescategoryAmount['amount']."','".date('y-m-d H:i:s')."','".$_POST['fine']."','".$_POST['scholaramount']."','".$_POST['isFinePaid']."')");
	}
?>