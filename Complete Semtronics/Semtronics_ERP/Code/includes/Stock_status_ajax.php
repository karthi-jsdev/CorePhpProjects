<?php
include('Config.php');
include('Stock_Management_Queries.php');
?>
<table class="paginate sortable full" id="display1">
	<thead>
		<tr>
			<th align="left">Sl.No.</th>
			<th align="left">RawMaterialCode</th>
			<th align="left">StockQuantity</th>
			<th align="left">Unitprice</th>
			<th align="left">Amount</th>
			<th align="left">Description</th>
			<th align="left">PartNumber</th>
			<th align="left">Category Name</th>
			<th align="left">Location</th>
		</tr>
	</thead>
<?php
	$i=1;
	$_POST['stock1']=$_GET['stock1'];
	$Stock_status=($_GET['stock1'] == "")?Stock_Summary():Stock_Search_ByAjax();
	
	if(mysql_num_rows($Stock_status)==0)
		echo'<tr><td colspan="7" style="color:red;"><center>No data Found</center></td></tr>';
	else
	{
		while($Stock_quantity = mysql_fetch_assoc($Stock_status))
		{
			if($Stock_quantity['quantity']==null)
				$Stock_quantity['quantity']='0';
			if($Stock_quantity['amount']==null)
				$Stock_quantity['amount']='0';
		$Stock_location = mysql_fetch_assoc(mysql_query("SELECT location.name as locationname FROM category
													INNER JOIN rawmaterial ON categoryid = category.id
													INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
													INNER JOIN stockinventory ON stockinventory.batchid = batch.id
													INNER JOIN location ON location.id = stockinventory.locationid
													INNER JOIN stock ON stock.batchid = batch.id
													WHERE rawmaterial.id='".$Stock_quantity['id']."'"));
		$inspection = mysql_fetch_assoc(mysql_query("select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Stock_quantity['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
		$inspect_color = mysql_fetch_assoc(mysql_query("select * from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='1' || stockinventory.inspection='2' || stockinventory.inspection='3') group by stockinventory.batchid"));
		$inspection_green = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));
		$inspection_blue = mysql_fetch_assoc(mysql_query("select count(green) as total,sum(quantity) as quantity from (select Min(inspection) as green,min(quantity) as quantity from stockinventory join batch on batch.id=stockinventory.batchid join rawmaterial on batch.rawmaterialid='".$Stock_quantity['id']."' where (stockinventory.inspection='0' || stockinventory.inspection='4') group by stockinventory.batchid)a"));

		echo'<tbody>';
			echo '<tr ';
		if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) < $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
			echo 'style="color:green;"';
		else if((($Stock_quantity['quantity']-$inspection['quantity'])< $Stock_quantity['minquantity']) && $inspect_color)
			echo 'style="color:red;"';
		if((($Stock_quantity['quantity']-($inspection_green['quantity'] + $inspection['quantity'])) > $Stock_quantity['minquantity']) && $inspection_green['total'] >=1)
			echo 'style="color:blue;"';
		echo '>
				<td>'.$i++.'</td>
				<form action="" method="POST">
				<td>'.$Stock_quantity['materialcode'].'
					<input type="hidden" id="batches" value="'.$Stock_quantity['id'].'">
				</form><a href="#" onclick="Batchs('.$Stock_quantity['id'].')" ><img src="images/plus1.png" width="20px" height="20px"></a>&nbsp;&nbsp;<img src="images/minus.png" width="20px" height="20px" onclick="batchvalues()"></td>';
				
				echo '<td>'.($Stock_quantity['quantity']-$inspection['quantity']).'</td>
				<td>'.$Stock_quantity['unitprice'].'</td>';
				echo'<td>'.number_format($Stock_quantity['amount']-$inspection['amount'],2).'</td>
				<td>'.$Stock_quantity['description'].'</td>
				<td>'.$Stock_quantity['partnumber'].'</td>
				<td>'.$Stock_quantity['name'].'</td>
				<td>'.$Stock_location['locationname'].'</td>
			</tr>';
		}
	}
?>
	</tbody>
</table>