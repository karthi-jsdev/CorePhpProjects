<?php
include('Config.php');
include('Stock_Management_Queries.php');
if($_GET['vendorid'])
{ ?>
	<select id="materialcode1" name="materialcode1" onchange="var splitMeterial = this.value.split('$');  document.getElementById('materialcode').value=splitMeterial[0]; document.getElementById('partnumber').innerHTML = 'Part Number:'+splitMeterial[1]+'<br/>Description:'+splitMeterial[2]; GetTax(splitMeterial[0])" required="required">
			<option value="">select</option>
	<?php
	Select_Rawmaterialid_ByVendor(); //document.getElementById('materialcode').value=splitMeterial[0]; alert(splitMeterial[0]); document.getElementById('partnumber').innerHTML = splitMeterial[1];
	echo '</select>';
}
?>