<section role="main" id="main">
<?php

if($_GET['quotation_id'])
{
	$_POST['quotation_id']= $_GET['quotation_id'];
	
	$quotation_number= Quotation_Number();
	while($quotation = mysql_fetch_assoc($quotation_number))
		echo "<br/><h3>QUOTATION NUMBER - ".$quotation['quotation_no']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp CLIENT - ".$quotation['client_name']."</h3><button  onclick='print_quotaion();'>Print Quotation</button><button onclick='print_work();'>Print Work</button><button onclick='print_work_Quotaion();'>Work Quotation</button></h3>";
	
	echo '<table class="paginate sortable full">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">Code</th>
			<th align="left">Description</th>
			<th align="left">Quantity</th>
			<th align="left">Unit</th>
			<th align="left">Rate/Unit</th>
			<th align="left">Amount</th>
		</tr>
	</thead>';
	
	$TotalAmount = 0;
	$quotation_work_details = Quotation_Work_Retrieval();
	$i = $j = 1;
	if(!mysql_num_rows($quotation_work_details))
		echo "<tr><td colspan='7'><center><font color='red'>No work data found!</font></center></td></tr>";
	else while($quotation_work = mysql_fetch_assoc($quotation_work_details))
	{
		$TotalAmount += $quotation_work['amount'];
		echo'<tr>
		<td>'.$i++.'</td>
		<td>'.$quotation_work['code'].'</td>
		<td>'.$quotation_work['description'].'</td>
		<td>'.$quotation_work['quantity'].'</td>
		<td>'.$quotation_work['unit'].'</td>
		<td>'.$quotation_work['rate_per_unit'].'</td>
		<td>'.$quotation_work['amount'].'</td>
	   </tr>
	   
	   <tr>
		<td></td>
		<td colspan="6"><table class="paginate sortable full">
		<thead>
			<tr>
				<th align="left">Sl.No.</th>
				<th align="left">Code</th>
				<th align="left">Sub Work</th>
				<th align="left">Number</th>
				<th align="left">Length</th>
				<th align="left">Breadth</th>
				<th align="left">Depth</th>
				<th align="left">Area</th>
			</tr>
		</thead>';
		$quotation_subwork_details = Quotation_Subwork_Retrieval($quotation_work['work_id']);
		if(!mysql_num_rows($quotation_subwork_details))
			echo '<tr><td colspan="7"><font color="red"><center>No subwork data found!</center></font></td></tr>';
		else while($quotation_subwork = mysql_fetch_assoc($quotation_subwork_details))
		{
			echo'<tr>
			<td>'.$j++.'</td>
			<td>'.$quotation_subwork['code'].'</td>
			<td>'.$quotation_subwork['subworkname'].'</td>
			<td>'.$quotation_subwork['subwork_quantity'].'</td>
			<td>'.$quotation_subwork['length'].'</td>
			<td>'.$quotation_subwork['breath'].'</td>
			<td>'.$quotation_subwork['depth'].'</td>
			<td>'.$quotation_subwork['area'].'</td>
		   </tr>';
		}
		$j = 1;	
		echo'</table>
		</td>
		</tr>';
	}
	$TotalAmount = CustomFloor($TotalAmount, 2);
	echo '<tr><td colspan="6"><b style="float:right;">All Work Amount : '.$TotalAmount.'</b></td></tr>';
	$Work40Percent = CustomFloor(((40*$TotalAmount)/100), 2);
	echo '<tr><td colspan="5"><b style="float:right;">40% Value Of Work : '.$Work40Percent.'</b></td></tr>';
	$Work50Of40Percent = CustomFloor((50*$Work40Percent/100), 2);
	echo '<tr><td colspan="5"><b style="float:right;">50% of 40% : '.$Work50Of40Percent.'</b></td></tr>';
	$ServiceTax12Percent = CustomFloor((12*$Work50Of40Percent/100), 2);
	echo '<tr><td colspan="6"><b style="float:right;">12% Service Tax : '.$ServiceTax12Percent.'</b></td></tr>';
	$AddCess = CustomFloor((2*$ServiceTax12Percent/100), 2);
	echo '<tr><td colspan="6"><b style="float:right;">Add Cess 2% : '.$AddCess.'</b></td></tr>';
	$AddHec = CustomFloor((1*$ServiceTax12Percent/100), 2);
	echo '<tr><td colspan="6"><b style="float:right;">Add Hec 1% : '.$AddHec.'</b></td></tr><tr><td colspan="6"><b style="float:right;">Total : '.CustomFloor($TotalAmount + $ServiceTax12Percent + $AddCess + $AddHec, 2).'</b></td></tr>
	</table>';
	
}
else
	echo '<br/><br/><strong>Please Add Quotation or Select Summary to view Status</strong>';

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
<script>
	function print_quotaion()
	{
		window.location.assign("includes/Print_Quotation.php?quotation_id=<?php echo $_GET['quotation_id'];?>");
		//window.open("includes/Print_Quotation.php?Export=1&quotation_id=<?php echo $_GET['quotation_id'];?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function print_work()
	{
		window.location.assign("includes/Print_Work.php?quotation_id=<?php echo $_GET['quotation_id'];?>");
		//window.open("includes/Print_Work.php?Export=1&quotation_id=<?php echo $_GET['quotation_id'];?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function print_work_Quotaion()
	{
		window.location.assign("includes/Print_WorkQuotation.php?quotation_id=<?php echo $_GET['quotation_id'];?>");
		//window.open("includes/Print_WorkQuotation.php?Export=1&quotation_id=<?php echo $_GET['quotation_id'];?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	
</script>