<?php
	ini_set("display_errors","0");
	include("Config.php");
	$Feescategories = explode(",",$_POST['feescategoryids']);
	for($i = 0;$i<count($Feescategories);$i++)
	{
		$FeescategoryAmount = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT amount FROM fees_category_assign WHERE feescategoryid='".$Feescategories[$i]."'"));
		mysqli_query($_SESSION['connection'],"DELETE FROM payment_log  where  student_id = '".$_POST['Student_id']."' and month_id = '".$_POST['monthid']."'");
		//mysqli_query($_SESSION['connection'],"UPDATE payment_log SET student_id = '".$_POST['Student_id']."',feescategory_id = '".$Feescategories[$i]."',month_id = '".$_POST['monthid']."',amounttobepaid = 0,paidamount ='".$FeescategoryAmount['amount']."' ,datetime = '".date('y-m-d H:i:s')."',fineamount = '".$_POST['fine']."',scholarshipamount = '".$_POST['scholaramount']."',finepaid = '".$_POST['isFinePaid']."'");
	}
?>