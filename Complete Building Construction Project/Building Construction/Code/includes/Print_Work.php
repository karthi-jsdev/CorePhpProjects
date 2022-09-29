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
<div style='padding-left:900px;'><button id='print'onclick='printwork();'>Print</button></div>
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
	echo '<table class="table3"  style="width:950px;">
	<thead>
		<tr class="tr3">
			<th valign="middle" class="td3">Sl.No.</th>
			<th valign="middle" class="td3">Description</th>
			<th valign="middle" class="td3">Number</th>
			<th valign="middle" class="td3">Length</th>
			<th valign="middle" class="td3">Breadth</th>
			<th valign="middle" class="td3">Depth</th>
			<th valign="middle" class="td3">Area</th>
		</tr>
	</thead>';
	$quotation_work_details = Quotation_Work_Retrieval();
	$i = 1;
	while($quotation_work = mysqli_fetch_assoc($quotation_work_details))
	{
		$TotalAmount += $quotation_work['amount'];
		echo'<tr>
		<td class="td3">'.$i++.'</td>
		<td class="td3">'.$quotation_work['description'].'</td>
		<td class="td3"></td>
		<td class="td3"></td>
		<td class="td3"></td>
		<td class="td3"></td>
		<td class="td3"></td>
		</tr>';
	   
		$quotation_subwork_details = Quotation_Subwork_Retrieval($quotation_work['work_id']);
		$Totalarea = 0;
		while($quotation_subwork = mysqli_fetch_assoc($quotation_subwork_details))
		{
			$quotation_subwork_count = Quotation_Subwork_Count($quotation_work['work_id']);
			$subwork_count = mysqli_num_rows($quotation_subwork_count);
			if(!$subwork_count)
				echo '<tr><td><font color="red"><center>No data found</center></font></td></tr>';
			else
			{
				$Totalarea +=$quotation_subwork['area'];
				echo'<tr>
				<td></td>
				<td class="td3">'.$quotation_subwork['subworkname'].'</td>
				<td class="td3">'.$quotation_subwork['subwork_quantity'].'</td>
				<td class="td3">'.number_format($quotation_subwork['length'],2,'.','').'</td>
				<td class="td3">'.number_format($quotation_subwork['breath'],2,'.','').'</td>
				<td class="td3">'.number_format($quotation_subwork['depth'],2,'.','').'</td>
				<td class="td3" align="right">'.number_format($quotation_subwork['area'],2,'.','').'</td>
			   </tr>
			   ';
			   
			}
		}
		echo '<tr  class="tr3"><td class="td3" align="right" colspan="6"></td><td align="right" class="td3" colspan="7">'.number_format($Totalarea,2,'.','').'</td></tr>';
		$j = 1;	
		
	}	
	echo'</table>';
	echo'</table>';
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
<script>
	function printwork()
	{
		document.getElementById('back').style.display='none';
		document.getElementById('print').style.display='none';
		window.print();
	}
</script>