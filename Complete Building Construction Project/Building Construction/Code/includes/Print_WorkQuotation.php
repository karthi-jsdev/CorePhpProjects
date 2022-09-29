<style>
.table3
{
    border-collapse: collapse;
}

.table3, .tr3, .th3 {
    border: 1px solid black;
	padding-top: 15px;
    padding-bottom: 25px;
    padding-right: 20px;
    padding-left: 20px;
}
.td3
{
	border-left: 1px solid black;
	padding-top: 15px;
    padding-bottom: 10px;
    padding-right: 20px;
    padding-left: 20px;
}
.td2
{
	padding-top: 15px;
    padding-bottom: 10px;
	 padding-right: 10px;
}
</style>
<?php
//if(!$_GET['Export'])
	//{
if (isset($HTTP_REFERER)) {
echo "<a href='$HTTP_REFERER'>BACK</a>";
} else {
echo "<a href='javascript:history.back()' id='back'>BACK</a>";
} ?>
<div style='padding-left:900px;'><button   onclick='printworkquotation();' id='print'>Print</button></div>
<section role="main" id="main">
<?php
//}
/*if($_GET['Export'])
	{
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".date("d_m_Y").".xls");
	}*/
include("Config.php");
ini_set("display_errors",0);
	include("Quotation_Queries.php");
	$_POST['quotation_id']= $_GET['quotation_id'];
if($_GET['quotation_id'])
{
	$_POST['quotation_id']= $_GET['quotation_id'];
	$Vendor_No = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM quotation JOIN client ON  quotation.client_id =client.id WHERE quotation.id='".$_POST['quotation_id']."'"));
	$Company_Information = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM company_information"));
	$quotation= mysqli_fetch_assoc(Quotation_Number());
	echo "<table align='center'><tr><td><h2>".$Company_Information['company_name']."</h2></td></tr>
	<tr><td align='center'><h3>".$Company_Information['company_slogan']."</h3></td></tr></table>";
	echo "<table><tr><td style='width:800px;'><strong>".$Company_Information['contact_name']."</strong></td><td><strong>".$Company_Information['address']."</strong></td></tr>
	<tr><td><strong>".$Company_Information['designation']."</strong></td><td><strong>Mobile:".$Company_Information['phone']."</strong></td></tr>
	<td></td><td><strong>Email:".$Company_Information['email']."</strong></td></table>
	<table><tr><td style='width:200px;'><i><b>VENDOR CODE:</b>".$Vendor_No['vendor_code']."</i></td><td><i><b>SERVICE TAX NO:</b>".$Company_Information['service_taxno']."</i></td><td style='width:100px;'></td><td  style='width:200px;'><i><b>PAN NO:</b>".$Company_Information['pan_no']."</i></td><td><i><b>TIN NO:</b>".$Company_Information['tin_no']."</i></td></tr>
	</table>";
	echo "<table align='right'><tr><td>Date:".$quotation['quotation_date']."</td></tr></table>";
	echo '<table><tr><td><b>TO:</b></td></tr><tr><td>'.$quotation["client_name"].'</td></tr><tr><td>'.$quotation["address"].'</td></tr></table>';
	echo '<table><tr><td>'.$quotation["subject"].'</td></tr><tr><td>Quotation No:'.$quotation["quotation_no"].'</td></tr></table>';
	echo '<table  class="table3"  border="1" style="width:950px;">
	<thead>
		<tr>
			<th class="th3" align="left">Sl.No.</th>
			<th class="th3" align="left">Description</th>
			<th class="th3" align="left">Quantity</th>
			<th class="th3" align="left">Unit</th>
			<th class="th3" align="left">Rate/Unit</th>
			<th class="th3" align="left">Amount</th>
		</tr>
	</thead>';
	
	$TotalAmount = 0;
	$quotation_work_details = Quotation_Work_Retrieval();
	$i = $j = 1;
	while($quotation_work = mysqli_fetch_assoc($quotation_work_details))
	{
		$TotalAmount += $quotation_work['amount'];
		echo'<tr class="tr3">
		<td class="td3">'.$i++.'</td>
		<td class="td3">'.$quotation_work['description'].'</td>
		<td class="td3">'.$quotation_work['quantity'].'</td>
		<td class="td3">'.$quotation_work['unit'].'</td>
		<td class="td3">'.$quotation_work['rate_per_unit'].'</td>
		<td class="td3">'.number_format($quotation_work['amount'],2,'.','').'</td>
	   </tr>
	   
	   <tr>
		<td></td>
		<td><table class="table3" style="width:650px;">
		<thead>
			<tr>
				<th class="th3" align="left">Sl.No.</th>
				<th class="th3" align="left">Sub Work</th>
				<th class="th3" align="left">Number</th>
				<th class="th3" align="left">Length</th>
				<th class="th3" align="left">Breadth</th>
				<th class="th3" align="left">Depth</th>
				<th class="th3" align="center">Area</th>
			</tr>
		</thead>';
		$quotation_subwork_details = Quotation_Subwork_Retrieval($quotation_work['work_id']);
		while($quotation_subwork = mysqli_fetch_assoc($quotation_subwork_details))
		{
			$quotation_subwork_count = Quotation_Subwork_Count($quotation_work['work_id']);
			$subwork_count = mysqli_num_rows($quotation_subwork_count);
			if(!$subwork_count)
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			else
			{
				$Totalarea +=$quotation_subwork['area'];
				echo'<tr>
				<td class="td3">'.$j++.'</td>
				<td class="td3">'.$quotation_subwork['subworkname'].'</td>
				<td class="td3">'.$quotation_subwork['subwork_quantity'].'</td>
				<td class="td3">'.number_format($quotation_subwork['length'],2,'.','').'</td>
				<td class="td3">'.number_format($quotation_subwork['breath'],2,'.','').'</td>
				<td class="td3">'.number_format($quotation_subwork['depth'],2,'.','').'</td>
				<td class="td3"  align="right">'.number_format($quotation_subwork['area'],2,'.','').'</td>
			   </tr >';
			}
		}
		echo '<tr  class="tr3"><td class="td3" align="right" colspan="6">Total Area</td><td align="right" class="td3" colspan="7">'.number_format($Totalarea,2,'.','').'</td></tr>';
		$j = 1;	
		echo'</table>
		</td>
		</tr>';
	}
	$TotalAmount = CustomFloor($TotalAmount, 2);
	echo '<tr class="tr3"><td align="right" colspan="5" >All Work Amount</td><td align="right" class="td3" colspan="6"><b>'.number_format($TotalAmount,2,'.','').'</b></td></tr>';
	$Work40Percent = CustomFloor(((40*$TotalAmount)/100), 2);
	echo '<tr class="tr3"><td align="right" class="td2" colspan="5">40% Value Of Work </td> <td class="td3" align="right"><b>'.number_format($Work40Percent,2,'.','').'</b></td></tr>';
	$Work50Of40Percent = CustomFloor((50*$Work40Percent/100), 2);
	echo '<tr class="tr3"><td align="right" class="td2" colspan="5">50% of 40% </td> <td class="td3" align="right"><b> '.number_format($Work50Of40Percent,2,'.','').'</b></td></tr>';
	$ServiceTax12Percent = CustomFloor((12*$Work50Of40Percent/100), 2);
	echo '<tr class="tr3"><td align="right" class="td2" colspan="5">12% Service Tax </td> <td class="td3" align="right"><b> '.number_format($ServiceTax12Percent,2,'.','').'</b></td></tr>';
	$AddCess = CustomFloor((2*$ServiceTax12Percent/100), 2);
	echo '<tr class="tr3"><td align="right" class="td2" colspan="5">Add Cess 2% </td> <td class="td3" align="right"><b>'.number_format($AddCess,2,'.','').'</b></td></tr>';
	$AddHec = CustomFloor((1*$ServiceTax12Percent/100), 2);
	echo '<tr class="tr3"><td align="right" class="td2" colspan="5">Add Hec 1% </td> <td class="td3" align="right"><b>'.number_format($AddHec,2,'.','').'</b></td></tr>
	<tr class="tr3"><td align="right" class="td2" colspan="5">Total  </td> <td class="td3" align="right"><b>'.number_format($TotalAmount + $ServiceTax12Percent + $AddCess + $AddHec, 2,'.','').'</b></td></tr>';
	
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
	function printworkquotation()
	{
		document.getElementById('back').style.display='none';
		document.getElementById('print').style.display='none';
		window.print();
	}
</script>
