<section role="main" id="main">
<?php
$TotalRows = mysql_fetch_assoc(Quotation_Summary_Count());
echo "<br/><h3>Quotation SUMMARY: Total Number of Quotations - ".$TotalRows["total"]."</h3>";
?>
<table class="paginate sortable full">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Quotation Number</th>
			<th align="left">Client</th>
			<th align="left">Subject</th>
			<th align="left">Total Amount</th>
			<th align="left">Quotation Date</th>
		</tr>
	</thead>
<?php
	$Limit = 10;
	$total_pages = ceil($TotalRows['total'] / $Limit);
	if(!$_GET['pageno'])
		$_GET['pageno'] = 1;
	$i = $Start = ($_GET['pageno']-1)*$Limit;
	$i++;
	$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	$summary = Quotation_Summary($Start,$Limit);
	while($quotation_summary = mysql_fetch_assoc($summary))
	{
		$quotation_work = mysql_fetch_assoc(Quotation_Work_Retrieval_Amount($quotation_summary['id']));
		echo'<tbody><tr>
				<td>'.$i++.'</td>
				<td><a href="?page=Quotation&subpage=Quotation Retrieval&quotation_id='.$quotation_summary['id'].'">'.$quotation_summary['quotation_no'].'</a></td>
				<td>'.$quotation_summary['client_name'].'</td>
				<td>'.$quotation_summary['subject'].'</td>
				<!--td>'.Total_Quotation_Amount($quotation_summary['amount']).'</td-->
				<td>'.Total_Quotation_Amount($quotation_work['total']).'</td>
				<td>'.date('d-m-Y',strtotime($quotation_summary['quotation_date'])).'</td>
			</tr>
		</tbody>';
	}
?>
</table>
<?php
	$GETParameters = "page=Quotation&subpage->Quotation Summary&quotation_id->'1'";
	if($total_pages > 1)
		include("includes/Pagination.php");
	function Total_Quotation_Amount($All_Works_Total_Amount)
	{
		$TotalAmount = CustomFloor($All_Works_Total_Amount, 2);
		$Work40Percent = CustomFloor(((40*$TotalAmount)/100), 2);
		$Work50Of40Percent = CustomFloor((50*$Work40Percent/100), 2);
		$ServiceTax12Percent = CustomFloor((12*$Work50Of40Percent/100), 2);
		$AddCess = CustomFloor((2*$ServiceTax12Percent/100), 2);
		$AddHec = CustomFloor((1*$ServiceTax12Percent/100), 2);
		return CustomFloor($TotalAmount + $ServiceTax12Percent + $AddCess + $AddHec, 2);
	}
	
	function CustomFloor($Float, $Decimals)
	{
		$Zeros = array("","0","00","000", "0000", "00000");
		$SplittedFloat = explode(".", $Float);
		if($SplittedFloat[1])
		{
			$Value = $SplittedFloat[0].".".substr($SplittedFloat[1], 0, $Decimals);
			$SplittedFloor = explode(".", $Value);
			if(strlen($SplittedFloor[1]) == $Decimals)
				return $Value;
			else
				return $Value.$Zeros[$Decimals-strlen($SplittedFloor[1])];
		}
		else
			return $SplittedFloat[0].".".$Zeros[$Decimals];
	}
?>
</section>	