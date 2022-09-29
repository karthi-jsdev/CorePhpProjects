<?php
	ini_set("display_errors","0");
	include("Config.php");
	$Amount = "";
	$Condition =  "fees_category_assign.id = ".str_replace(",", "|| fees_category_assign.id = ",$_POST['CategoryIds']);
	$Amountvalue = mysqli_query($_SESSION['connection'],"SELECT * FROM fees_category_assign where ".$Condition." order by fees_category_assign.feescategoryid asc");
	while($Totalamount = mysqli_fetch_array($Amountvalue))
		$Amount +=$Totalamount['amount'];
	echo $Amount;
	if($Amountvalue = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT amounttobepaid FROM payment_log where student_id=".$_POST['student_id']." && month_id=".$_POST['monthid']." ORDER BY id DESC LIMIT 1")))
		echo "$".$Amountvalue['amounttobepaid'];
	else
		echo "$".$Amount;
?>