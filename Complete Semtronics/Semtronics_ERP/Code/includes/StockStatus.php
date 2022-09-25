<?php
include('Config.php');

?>
<br/><br/>
<form action="" method="POST">
	<div style="float:right">
		<input type="text" value="<?php echo $_POST['stock1'];?>" name="stock1" id="contet">
		<a id="check" onclick="Display_Table();" class="button button-orange">Search</a>
	</div>
	<br/><br/>
	<table class="paginate sortable full" id="display1">
		<thead>
			<tr>
				<th align="left">Sl.No.</th>
				<th align="left">RawMaterialCode</th>
				<th align="left">StockQuantity</th>
				<th align="left">Amount</th>
				<th align="left">Description</th>
				<th align="left">PartNumber</th>
				<th align="left">Category Name</th>
			</tr>
		</thead>
	<?php
	$i=1;
	$Stock_status = Stock_SummaryByInspection();
	if(mysql_num_rows($Stock_status)==0)
		echo'<tr><td colspan="7" style="color:red;"><center>No data Found</center></td></tr>';
	else
	{
		while($Stock_quantity = mysql_fetch_assoc($Stock_status))
		{
			$FetchRaw = mysql_num_rows(mysql_query("SELECT * FROM stockinventory JOIN batch ON stockinventory.batchid = batch.id JOIN rawmaterial ON batch.rawmaterialid ='".$Stock_quantity['id']."' WHERE stockinventory.inspection = '' GROUP BY stockinventory.batchid"));
			if($Stock_quantity['quantity']==null)
				$Stock_quantity['quantity']='0';
			if($Stock_quantity['amount']==null)
				$Stock_quantity['amount']='0';
			echo'<tbody>';
				echo 	'<tr ';
			if(($Stock_quantity['minquantity'] < $Stock_quantity['quantity']) && !$FetchRaw)
				echo 'style="color:green;"';
			else if(($Stock_quantity['minquantity'] < $Stock_quantity['quantity']) && $FetchRaw)
				echo 'style="color:red;"';
			else if(!($Stock_quantity['minquantity'] < $Stock_quantity['quantity']) && $FetchRaw)
				echo 'style="color:blue;"';
			/*else if	
				echo 'style="color:violet;"';
			else*/
				echo '>
						<td>'.$i++.'</td>
						<td>'.$Stock_quantity['materialcode'].'</td>
						<td>'.$Stock_quantity['quantity'].'</td>
						<td>'.$Stock_quantity['amount'].'</td>
						<td>'.$Stock_quantity['description'].'</td>
						<td>'.$Stock_quantity['partnumber'].'</td>
						<td>'.$Stock_quantity['name'].'</td>
					</tr>';
		}
	}
	?>
		</tbody>
	
	</table>	<br/>
			<table>
			<tr>
				<td style='background:green;width:20px;'></td><td>Less than minimum quantity</td>
				<td style='background:red;width:20px;'></td><td>Less than minimum quantity and Inspection needed</td></tr>
				<td style='background:blue;width:20px;'></td><td>Inspection needed</td></tr>
			</tr>
		</table>
</form>
<script>
	function Display_Table()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("display1").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Stock_status_ajax.php?stock1="+document.getElementById('contet').value, true);
		xmlhttp.send();
	}
</script>