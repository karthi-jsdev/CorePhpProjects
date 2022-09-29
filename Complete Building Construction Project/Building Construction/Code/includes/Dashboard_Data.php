<?php
	include("Config.php");
	include("Dashboard_Queries.php");
	ini_set("display_errors","0");
	if($_GET['PaginationFor'] == 'TopQuotation')
	{
		$Top_Quotationtotalrows = mysqli_fetch_assoc(Top_Quotationrows());
		$Limit = 5;
		$_GET['total_pages'] = ceil($Top_Quotationtotalrows['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$Top_Quotation = Current_Month_Top_Quotation($Start,$Limit);
		while($Current_MonthQuotation = mysqli_fetch_assoc($Top_Quotation))
		{
			$Status = mysqli_fetch_assoc(Select_Status_By_Quotation_Id($Current_MonthQuotation['id']));
			if($Status['status_id'] == 1)
				echo '<tr><td>'.(++$i).'</td><td>'.$Current_MonthQuotation['quotation_no'].'</td><td>'.$Current_MonthQuotation['client_name'].'</td><td>'.$Current_MonthQuotation['quotation_date'].'</td><td>'.$Current_MonthQuotation['totalamount'].'</td></tr>';
		}
		if(!$i)
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
	}
	else if($_GET['PaginationFor']=='PendingQuotation')
	{
		$Quotationpendingrows = mysqli_fetch_assoc(pendingrows());
		$Limit = 5;
		$_GET['total_pages'] = ceil($Quotationpendingrows['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$Pending_Quotation = Current_Month_Pending_Quotation($Start,$Limit);
		while($Current_MonthPending = mysqli_fetch_assoc($Pending_Quotation))
		{
			$Pending_Status = mysqli_fetch_assoc(Select_Pending_Status_Quotation_Id($Current_MonthPending['id']));
			if($Pending_Status['status_id'] == 3)
				echo '<tr><td>'.(++$i).'</td><td>'.$Current_MonthPending['quotation_no'].'</td><td>'.$Current_MonthPending['client_name'].'</td><td>'.$Current_MonthPending['quotation_date'].'</td><td>'.$Current_MonthPending['totalamount'].'</td></tr>';
		}
		if(!$i)
			echo '<tr><td colspan="6"><font color="red"><center>No data found</center></font></td></tr>';
	}
	else if($_GET['PaginationFor']=='MonthQuotation')
	{
		$QuotationStatus = mysqli_fetch_assoc(QuotationStatusrows());
		if(!$QuotationStatus['total'])
			echo '<tr><td colspan="6"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 5;
		$_GET['total_pages'] = ceil($QuotationStatus['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$CurrentmonthQuotationStatus = Current_Quotation_Status($Start,$Limit);
		while($Current_MonthStatus = mysqli_fetch_assoc($CurrentmonthQuotationStatus))
			echo '<tr><td>'.(++$i).'</td><td>'.$Current_MonthStatus['quotation_no'].'</td><td>'.$Current_MonthStatus['client_name'].'</td><td>'.$Current_MonthStatus['quotation_date'].'</td><td>'.$Current_MonthStatus['totalamount'].'</td><td>'.$Current_MonthStatus['name'].'</td></tr>';
		
	}
	else if($_GET['PaginationFor']=='NumberQuotation')
	{
		$Numberofquotation = mysqli_fetch_assoc(Numberofquotationrows());
		if(!$Numberofquotation['total'])
			echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
		$Limit = 5;
		$_GET['total_pages'] = ceil($Numberofquotation['total'] / $Limit);
		if(!$_GET['CurrentPageNo'])
			$_GET['CurrentPageNo'] = 1;
		$i = $Start = ($_GET['CurrentPageNo']-1)*$Limit;
		$NumberofquotationStatus = Numberofquotations($Start,$Limit);
		while($NumberOfQuotation_Month = mysqli_fetch_assoc($NumberofquotationStatus))
			echo '<tr><td>'.(++$i).'</td><td>'.$NumberOfQuotation_Month['client_name'].'</td><td>'.$NumberOfQuotation_Month['totalamount'].'</td><td align="center">'.$NumberOfQuotation_Month['total'].'</td>';
	}
	echo "$";
	if($_GET['total_pages'] > 5)
		include("Ajax_Pagination.php");
?>