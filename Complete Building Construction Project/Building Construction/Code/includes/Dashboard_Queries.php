<?php
	function Total_Clients()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from client");
	}
	function New_Client_Added_This_Month()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from client WHERE date_time>='".date("Y-m-1")."'");
	}
	function Active_Clients()
	{ 
		$today = time();
		$twoMonthsLater = strtotime("-2 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from client JOIN quotation ON client.id = quotation.client_id WHERE quotation.quotation_date between '".date('Y-m-d', $twoMonthsLater)."' and CURDATE() group by client.id");
	}
	function This_YearClients()
	{
		return mysqli_query($_SESSION['connection'],"SELECT count(*) as total from client WHERE date_time>='".date("Y-1-1 H:i:s")."'");
	}
	function Top_Quotationrows()
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total from quotation JOIN status_comments ON status_comments.quotation_id=quotation.id  WHERE (quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='1')");
	}
	function Current_Month_Top_Quotation($Start,$Limit)
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT quotation.id,quotation.quotation_no,client.client_name,quotation.quotation_date,SUM(quotation_work.amount)as totalamount from quotation JOIN client ON quotation.client_id = client.id  JOIN quotation_work ON quotation_work.quotation_id=quotation.id  JOIN status_comments ON status_comments.quotation_id=quotation.id  JOIN status ON status.id=status_comments.quotation_id  WHERE (quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='1') GROUP BY(quotation.id) ORDER BY SUM(quotation_work.amount) DESC LIMIT $Start,$Limit");
	}
	function Select_Status_By_Quotation_Id($Quotation_Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT status_id from status_comments WHERE quotation_id=$Quotation_Id ORDER BY id DESC LIMIT 1");
	}
	function pendingrows()
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total from quotation JOIN status_comments ON status_comments.quotation_id=quotation.id  WHERE (quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='3')");
	}
	function Current_Month_Pending_Quotation($Start,$Limit)
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT quotation.id,quotation.quotation_no,client.client_name,quotation.quotation_date,SUM(quotation_work.amount)as totalamount from quotation  JOIN client ON quotation.client_id = client.id  JOIN quotation_work ON quotation_work.quotation_id=quotation.id  JOIN status_comments ON status_comments.quotation_id=quotation.id  JOIN status ON status.id=status_comments.quotation_id  WHERE (quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='3') GROUP BY(quotation.id) ORDER BY SUM(quotation_work.amount) DESC LIMIT $Start,$Limit");
	}
	function Select_Pending_Status_Quotation_Id($Quotation_Id)
	{
		return mysqli_query($_SESSION['connection'],"SELECT status_id from status_comments WHERE quotation_id=$Quotation_Id ORDER BY id DESC LIMIT 1");
	}
	function QuotationStatusrows()
	{
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total from quotation LEFT JOIN status_comments ON status_comments.quotation_id=quotation.id LEFT JOIN status ON status.id=status_comments.status_id WHERE (quotation.quotation_date >= '".date("Y-m-1")."')");
	}
	function Current_Quotation_Status($Start,$Limit)
	{
		return mysqli_query($_SESSION['connection'],"SELECT quotation.quotation_no,client.client_name,quotation.quotation_date,SUM(quotation_work.amount)as totalamount,status.name from quotation JOIN client ON quotation.client_id = client.id JOIN quotation_work ON quotation_work.quotation_id=quotation.id LEFT JOIN status_comments ON status_comments.quotation_id=quotation.id LEFT JOIN status ON status.id=status_comments.quotation_id  WHERE (quotation.quotation_date >= '".date("Y-m-1")."') GROUP BY(quotation.id) ORDER BY SUM(quotation_work.amount) DESC LIMIT $Start,$Limit");
	}
	function Numberofquotationrows()
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(*) as total from quotation JOIN status_comments ON status_comments.quotation_id=quotation.id  WHERE (quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='3')");
	}
	function Numberofquotations($Start,$Limit)
	{
		$today = time();
		$threeMonthsLater = strtotime("-3 months", $today);
		return mysqli_query($_SESSION['connection'],"SELECT COUNT(DISTINCT(quotation.id)) as total,client.client_name, SUM(quotation_work.amount) as totalamount,status_comments.status_id,quotation.quotation_date FROM quotation
		JOIN client ON client.id = quotation.client_id
		JOIN quotation_work ON quotation_work.quotation_id=quotation.id
		LEFT JOIN status_comments ON status_comments.quotation_id = quotation.id
		WHERE ((quotation.quotation_date between '".date('Y-m-d', $threeMonthsLater)."' and CURDATE()) AND (status_comments.status_id='3'))
		group by client.id LIMIT $Start,$Limit");
	}
	
?>