<?php
include('config.php');
include('Stock_Management_Queries.php');
if($_GET['vendorid'])
{
	$invoice1 = Select_Invoice();
	echo'<select name="number" id="number1">
			<option value="">select</option>';
	while($invoice_list = mysqli_fetch_assoc($invoice1))
	{
		if($_POST['number'] == $invoice_list['id'])
			echo '<option value="'.$invoice_list['id'].'" selected="selected">'.$invoice_list['number'].'</option>';
		else
			echo '<option value="'.$invoice_list['id'].'">'.$invoice_list['number'].'</option>';
	}
	echo '</select>';
}
?>