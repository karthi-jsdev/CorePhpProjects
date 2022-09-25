<?php
ini_set("display_errors","0");
include('Config.php');
include('Quotation_Queries.php');
if($_GET['client_id'])
{
	$Vendor = Vendorno();
	$vendor_value = mysql_fetch_array($Vendor);
	echo '<div><label><strong>Vendor No:</strong>
	<strong style="color:red;">'.$vendor_value["vendor_code"].'<strong></label></div>';
}
else if($_GET['quotation_no'])
{
	$Quotation = Quotationno();
	?>
	<select id="client_id" name="client_id" required="required" onchange="vendorno(this.value);">
		<option value="">Select</option>';
		<?php
		while($Quotation_value = mysql_fetch_assoc($Quotation))
		{
			$Client_name = mysql_fetch_array(mysql_query("SELECT * FROM client where id='".$Quotation_value['id']."'"));
			echo '<option value="'.$Client_name['id'].'">'.$Client_name['client_name'].'</option>';
		}
	echo "</select>";
}
else if($_GET['quotation_nos'])
{
	if(mysql_num_rows(mysql_query("SELECT * FROM quotation where quotation_no='".$_GET['quotation_nos']."'")))
		echo "This Quotation number already exists";
} ?>